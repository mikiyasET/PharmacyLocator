<?php

class Location extends Database
{
    protected $id;
    protected $name;
    protected $mapLink;

    protected function add() {
        $this->id = uniqid();
        if (!$this->checkName()) {
            $result = $this->c()->prepare("INSERT INTO location (lid, name, mapLink) VALUES (?,?,?)");
            return $result->execute([$this->id,$this->name,$this->mapLink]);
        }
        return false;
    }
    protected function edit() {
        if ($this->checkID()) {
            $result = $this->c()->prepare("UPDATE location SET name = ?,mapLink = ? WHERE lid = ?");
            return $result->execute([$this->name,$this->mapLink,$this->id]);
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

    protected function checkID() {
        $result = $this->c()->prepare("SELECT * FROM location WHERE lid = ?");
        $result->execute([$this->id]);
        if ($result->rowCount() > 0) {
            return true;
        }
        return false;
    }
}