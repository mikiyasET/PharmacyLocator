<?php

class Admin extends Database
{
    public $id;
    public $username;
    public $password;

    protected function add() {
        $this->id = uniqid();
        if (!$this->checkUsername()) {
            $result = $this->c()->prepare("INSERT INTO admin (aid, username, password) VALUES (?,?,?)");
            return $result->execute([$this->id,$this->username,password_hash($this->password, PASSWORD_BCRYPT)]);
        }
        return false;
    }
    protected function edit() {
        if ($this->checkID()) {
            $result = $this->c()->prepare("UPDATE admin SET username = ? WHERE aid = ?");
            return $result->execute([$this->username,$this->id]);
        }
        return false;
    }
    protected function changePassword() {
        if ($this->checkID()) {
            $result = $this->c()->prepare("UPDATE admin SET password = ? WHERE aid = ?");
            return $result->execute([password_hash($this->password, PASSWORD_BCRYPT),$this->id]);
        }
        return false;
    }
    protected function remove() {
        if ($this->checkID()) {
            $result = $this->c()->prepare("DELETE FROM admin WHERE aid = ?");
            return $result->execute([$this->id]);
        }
        return false;
    }
    protected function checkUsername() {
        $result = $this->c()->prepare("SELECT * FROM admin WHERE username = ?");
        $result->execute([$this->username]);
        if ($result->rowCount() > 0) {
            return true;
        }
        return false;
    }

    protected function checkID() {
        $result = $this->c()->prepare("SELECT * FROM admin WHERE aid = ?");
        $result->execute([$this->id]);
        if ($result->rowCount() > 0) {
            return true;
        }
        return false;
    }
}