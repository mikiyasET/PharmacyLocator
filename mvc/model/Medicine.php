<?php

class Medicine extends Database {
    public $id;
    public $name;
    public $description;
    public $admin;

    protected function add() {
        $this->id = uniqid();
        if (!$this->checkName()) {
            $result = $this->c()->prepare("INSERT INTO medicine (mid, name, description,aid) VALUES (?,?,?,?)");
            return $result->execute([$this->id,$this->name,$this->description,$this->admin]);
        }
        return false;
    }
    protected function edit() {
        if ($this->checkID()) {
            $result = $this->c()->prepare("UPDATE medicine SET name = ?,description = ? WHERE mid = ?");
            return $result->execute([$this->name,$this->description,$this->id]);
        }
        return false;
    }
    protected function remove() {
        if ($this->checkID()) {
            $result = $this->c()->prepare("DELETE FROM medicine WHERE mid = ?");
            return $result->execute([$this->id]);
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

    protected function checkID() {
        $result = $this->c()->prepare("SELECT * FROM medicine WHERE mid = ?");
        $result->execute([$this->id]);
        if ($result->rowCount() > 0) {
            return true;
        }
        return false;
    }
}