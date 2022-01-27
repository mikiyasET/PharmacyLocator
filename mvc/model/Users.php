<?php

class Users extends Database
{
    public $id;
    public $username;
    public $password;

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
    protected function getID() {
        $result = $this->c()->prepare("SELECT * FROM users where username = ?");
        $result->execute([$this->username]);
        if ($result->rowCount() > 0) {
            $x = new ArrayObject($result->fetch(), ArrayObject::ARRAY_AS_PROPS);
            return $x->uid;
        }
        return 0;
    }
    protected function check() {
        if ($this->checkUsername()) {
            $this->id = $this->getID();
            if ($this->isPassword()) {
                return true;
            }
        }
        return false;
    }
    protected function isPassword() {
        $sql = "SELECT * FROM users WHERE uid = ?";
        $stmt = $this->c()->prepare($sql);
        $stmt->execute([$this->id]);
        $exe = $stmt->fetch();
        if(password_verify(trim($this->password), $exe['password'])) {
            return true;
        }else {
            return false;
        }
    }
    protected function show() {
        $result = $this->c()->prepare("SELECT * FROM users WHERE uid = ?");
        $result->execute([$this->id]);
        if ($result->rowCount() > 0) {
            return new ArrayObject($result->fetch(), ArrayObject::ARRAY_AS_PROPS);
        }
        return [];
    }
    protected function showAll() {
        $result = $this->c()->query("SELECT * FROM users");
        $result->execute();
        if ($result->rowCount() > 0) {
            return $result->fetchAll();
        }
        return [];
    }
}
