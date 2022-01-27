<?php

class Medicine extends Database {
    public $id;
    public $name;
    public $description;
    public $admin;
    public $img;

    protected function add() {
        $this->id = uniqid();
        if (!$this->checkName()) {
            $result = $this->c()->prepare("INSERT INTO medicine (mid, name, description,img,aid) VALUES (?,?,?,?,?)");
            return $result->execute([$this->id,$this->name,$this->description,$this->img,$this->admin]);
        }
        return false;
    }
    protected function edit() {
        if ($this->checkID()) {
            if ($this->img == '') {
                $result = $this->c()->prepare("UPDATE medicine SET name = ?,description = ? WHERE mid = ?");
                return $result->execute([$this->name,$this->description,$this->id]);
            }else {
                $pre_img = $this->show()->img;
                $result = $this->c()->prepare("UPDATE medicine SET name = ?,description = ?,img = ? WHERE mid = ?");
                if($result->execute([$this->name,$this->description,$this->img,$this->id])){
                    @unlink(APP_ROOT."/assets/images/medicines/$pre_img");
                    return true;
                }
            }
        }
        return false;
    }
    protected function remove() {
        if ($this->checkID()) {
            $img = $this->show()->img;
            $result = $this->c()->prepare("DELETE FROM medicine WHERE mid = ?");
            if ($result->execute([$this->id])) {
                @unlink(APP_ROOT."/assets/images/medicines/$img");
                return true;
            }
        }
        return false;
    }
    protected function checkName() {
        $result = $this->c()->prepare("SELECT * FROM medicine WHERE name = ?");
        $result->execute([$this->name]);
        if ($result->rowCount() > 0) {
            return true;
        }
        return false;
    }
    protected function checkNameExceptThis() {
        $result = $this->c()->prepare("SELECT * FROM medicine WHERE name = ? and mid != ?");
        $result->execute([$this->name,$this->id]);
        if ($result->rowCount() > 0) {
            return true;
        }
        return false;
    }

    protected function checkID() {
        $result = $this->c()->prepare("SELECT * FROM medicine WHERE mid = ?");
        $result->execute([$this->id]);
        if ($result->rowCount() > 0) {
            return true;
        }
        return false;
    }
    protected function showAll() {
        $result = $this->c()->query("SELECT * FROM medicine");
        $result->execute();
        if ($result->rowCount() > 0) {
            return $result->fetchAll();
        }
        return [];
    }
    protected function search() {
        $result = $this->c()->query("SELECT * FROM medicine WHERE name LIKE '%{$this->name}%' ");
        $result->execute();
        if ($result->rowCount() > 0) {
            return $result->fetchAll();
        }
        return [];
    }
    protected function show() {
        $result = $this->c()->prepare("SELECT * FROM medicine WHERE mid = ?");
        $result->execute([$this->id]);
        if ($result->rowCount() > 0) {
            return new ArrayObject($result->fetch(), ArrayObject::ARRAY_AS_PROPS);
        }
        return [];
    }
}