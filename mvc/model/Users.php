<?php

class Users extends Database
{
    protected $id;
    protected $username;
    protected $password;

    protected function add() {
        $this->id = uniqid();
        if (!$this->checkUsername()) {
            $result = $this->c()->prepare("INSERT INTO users (uid, username, password) VALUES (?,?,?)");
            return $result->execute([$this->id,$this->username,password_hash($this->password, PASSWORD_BCRYPT)]);
        }
        return false;
    }
    protected function edit() {
        if ($this->checkID()) {
            $result = $this->c()->prepare("UPDATE users SET username = ? WHERE uid = ?");
            return $result->execute([$this->username,$this->id]);
        }
        return false;
    }
    protected function changePassword() {
        if ($this->checkID()) {
            $result = $this->c()->prepare("UPDATE users SET password = ? WHERE uid = ?");
            return $result->execute([password_hash($this->password, PASSWORD_BCRYPT),$this->id]);
        }
        return false;
    }
    protected function remove() {
        if ($this->checkID()) {
            $result = $this->c()->prepare("DELETE FROM users WHERE uid = ?");
            return $result->execute([$this->id]);
        }
        return false;
    }
    protected function checkUsername() {
        $result = $this->c()->prepare("SELECT * FROM users WHERE username = ?");
        $result->execute([$this->username]);
        if ($result->rowCount() > 0) {
            return true;
        }
        return false;
    }

    protected function checkID() {
        $result = $this->c()->prepare("SELECT * FROM users WHERE uid = ?");
        $result->execute([$this->id]);
        if ($result->rowCount() > 0) {
            return true;
        }
        return false;
    }
}
