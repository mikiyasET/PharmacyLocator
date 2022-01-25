<?php

class Location extends Database
{
    public $id;
    public $name;

    protected function add() {
        $this->id = uniqid();
        if (!$this->checkName()) {
            $result = $this->c()->prepare("INSERT INTO location (lid, name) VALUES (?,?)");
            return $result->execute([$this->id,$this->name]);
        }
        return false;
    }
    protected function edit() {
        if ($this->checkID()) {
            if (!$this->checkNameExceptThis()) {
                $result = $this->c()->prepare("UPDATE location SET name = ? WHERE lid = ?");
                return $result->execute([$this->name,$this->id]);
            }
        }
        return false;
    }
    protected function remove() {
        if ($this->checkID()) {
            $result = $this->c()->prepare("DELETE FROM location WHERE lid = ?");
            return $result->execute([$this->id]);
        }
        return false;
    }
    protected function checkName() {
        $result = $this->c()->prepare("SELECT * FROM location WHERE name = ?");
        $result->execute([$this->name]);
        if ($result->rowCount() > 0) {
            return true;
        }
        return false;
    }
    protected function checkNameExceptThis() {
        $result = $this->c()->prepare("SELECT * FROM location WHERE name = ? and lid != ?");
        $result->execute([$this->name, $this->id]);
        if ($result->rowCount() > 0) {
            return true;
        }
        return false;
    }

    protected function checkID() {
        $result = $this->c()->prepare("SELECT * FROM location WHERE lid = ?");
        $result->execute([$this->id]);
        if ($result->rowCount() > 0) {
            return true;
        }
        return false;
    }

    protected function showAll() {
        $result = $this->c()->query("SELECT * FROM location");
        $result->execute();
        if ($result->rowCount() > 0) {
            return $result->fetchAll();
        }
        return [];
    }
    protected function show() {
        $result = $this->c()->prepare("SELECT * FROM location WHERE lid = ?");
        $result->execute([$this->id]);
        if ($result->rowCount() > 0) {
            return new ArrayObject($result->fetch(), ArrayObject::ARRAY_AS_PROPS);
        }
        return [];
    }
}