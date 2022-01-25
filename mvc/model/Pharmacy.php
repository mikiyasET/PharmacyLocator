<?php

class Pharmacy extends Database
{
    protected $id;
    protected $name;
    protected $email;
    protected $password;
    protected $location;

    protected function add() {
        $this->id = uniqid();
        if (!$this->checkNameEmail()) {
            $result = $this->c()->prepare("INSERT INTO pharmacy (pid, name, email, password, lid) VALUES (?,?,?,?,?)");
            return $result->execute([$this->id,$this->name,$this->email,password_hash($this->password, PASSWORD_BCRYPT),$this->location]);
        }
        return false;
    }
    protected function edit() {
        if ($this->checkID()) {
            $result = $this->c()->prepare("UPDATE pharmacy SET name = ?,email = ?,lid = ? WHERE pid = ?");
            return $result->execute([$this->name,$this->email,$this->location]);
        }
        return false;
    }
    protected function remove() {
        if ($this->checkID()) {
            $result = $this->c()->prepare("DELETE FROM pharmacy WHERE pid = ?");
            return $result->execute([$this->id]);
        }
        return false;
    }
    protected function changePassword() {
        if ($this->checkID()) {
            $result = $this->c()->prepare("UPDATE pharmacy SET password = ? WHERE pid = ?");
            return $result->execute([password_hash($this->password, PASSWORD_BCRYPT),$this->id]);
        }
        return false;
    }
    protected function checkNameEmail() {
        $result = $this->c()->prepare("SELECT * FROM pharmacy WHERE name = ? or email = ?");
        $result->execute([$this->name,$this->email]);
        if ($result->rowCount() > 0) {
            return true;
        }
        return false;
    }
    protected function checkID() {
        $result = $this->c()->prepare("SELECT * FROM pharmacy WHERE pid = ?");
        $result->execute([$this->id]);
        if ($result->rowCount() > 0) {
            return true;
        }
        return false;
    }
}