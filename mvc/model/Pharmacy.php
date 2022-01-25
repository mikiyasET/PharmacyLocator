<?php

class Pharmacy extends Database
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $mapLink;
    public $location;

    protected function add() {
        $this->id = uniqid();
        if (!$this->checkNameEmail()) {
            $result = $this->c()->prepare("INSERT INTO pharmacy (pid, name, email, password,mapLink, lid) VALUES (?,?,?,?,?,?)");
            return $result->execute([$this->id,$this->name,$this->email,password_hash($this->password, PASSWORD_BCRYPT),$this->mapLink,$this->location]);
        }
        return false;
    }
    protected function edit() {
        if ($this->checkID()) {
            $result = $this->c()->prepare("UPDATE pharmacy SET name = ?,email = ?,lid = ?,mapLink = ? WHERE pid = ?");
            return $result->execute([$this->name,$this->email,$this->location,$this->mapLink,$this->id]);
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
    protected function checkNameEmailExceptThis() {
        $result = $this->c()->prepare("SELECT * FROM pharmacy WHERE (name = ? or email = ?) and pid != ?");
        $result->execute([$this->name,$this->email,$this->id]);
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
    protected function showAll() {
        $result = $this->c()->query("SELECT * FROM pharmacy");
        $result->execute();
        if ($result->rowCount() > 0) {
            return $result->fetchAll();
        }
        return [];
    }
    protected function show() {
        $result = $this->c()->prepare("SELECT * FROM pharmacy WHERE pid = ?");
        $result->execute([$this->id]);
        if ($result->rowCount() > 0) {
            return new ArrayObject($result->fetch(), ArrayObject::ARRAY_AS_PROPS);
        }
        return [];
    }
}