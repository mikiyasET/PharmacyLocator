<?php

class Pharmacy extends Database
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $mapLink;
    public $location;
    public $description;
    public $image;

    protected function add() {
        $this->id = uniqid();
        if (!$this->checkNameEmail()) {
            $result = $this->c()->prepare("INSERT INTO pharmacy (pid, name, email, password,description,img,mapLink, lid) VALUES (?,?,?,?,?,?,?,?)");
            return $result->execute([$this->id,$this->name,$this->email,password_hash($this->password, PASSWORD_BCRYPT),$this->description,$this->image,$this->mapLink,$this->location]);
        }
        return false;
    }
    protected function edit() {
        if ($this->checkID()) {
            if ($this->image == '') {
                $result = $this->c()->prepare("UPDATE pharmacy SET name = ?,email = ?,lid = ?,mapLink = ?,description = ? WHERE pid = ?");
                return $result->execute([$this->name,$this->email,$this->location,$this->mapLink,$this->description,$this->id]);
            }
            else {
                $pre_img = $this->show()->img;
                $result = $this->c()->prepare("UPDATE pharmacy SET name = ?,email = ?,lid = ?,mapLink = ?,description = ?,img = ? WHERE pid = ?");
                if($result->execute([$this->name,$this->email,$this->location,$this->mapLink,$this->description,$this->image,$this->id])){
                    @unlink(APP_ROOT."/assets/images/pharmacies/$pre_img");
                    return true;
                }
            }
        }
        return false;
    }
    protected function remove() {
        if ($this->checkID()) {
            $pre_img = $this->show()->img;
            $result = $this->c()->prepare("DELETE FROM pharmacy WHERE pid = ?");
            if ($result->execute([$this->id])) {
                @unlink(APP_ROOT."/assets/images/pharmacies/$pre_img");
                return true;
            }
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
    protected function checkEmail() {
        $result = $this->c()->prepare("SELECT * FROM pharmacy WHERE email = ?");
        $result->execute([$this->email]);
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
    protected function getID() {
        $result = $this->c()->prepare("SELECT * FROM pharmacy where email = ?");
        $result->execute([$this->email]);
        if ($result->rowCount() > 0) {
            $x = new ArrayObject($result->fetch(), ArrayObject::ARRAY_AS_PROPS);
            return $x->pid;
        }
        return 0;
    }
    protected function check() {
        if ($this->checkEmail()) {
            $this->id = $this->getID();
            if ($this->isPassword()) {
                return true;
            }
        }
        return false;
    }
    protected function isPassword() {
        $sql = "SELECT * FROM pharmacy WHERE pid = ?";
        $stmt = $this->c()->prepare($sql);
        $stmt->execute([$this->id]);
        $exe = $stmt->fetch();
        if(password_verify(trim($this->password), $exe['password'])) {
            return true;
        }else {
            return false;
        }
    }
}