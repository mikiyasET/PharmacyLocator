<?php

class Store extends Database
{
    protected $id;
    protected $medicine;
    protected $pharmacy;

    protected function add() {
        $this->id = uniqid();
        if (!$this->checkMed()) {
            $result = $this->c()->prepare("INSERT INTO store (sid, mid, pid) VALUES (?,?,?)");
            return $result->execute([$this->id,$this->medicine,$this->pharmacy]);
        }
        return false;
    }
    protected function edit() {
        if ($this->checkID()) {
            $result = $this->c()->prepare("UPDATE store SET mid = ?,pid = ? WHERE sid = ?");
            return $result->execute([$this->medicine,$this->pharmacy,$this->id]);
        }
        return false;
    }
    protected function remove() {
        if ($this->checkID()) {
            $result = $this->c()->prepare("DELETE FROM store WHERE sid = ?");
            return $result->execute([$this->id]);
        }
        return false;
    }
    protected function checkMed() {
        $result = $this->c()->prepare("SELECT * FROM store WHERE mid = ? and pid = ?");
        $result->execute([$this->medicine,$this->pharmacy]);
        if ($result->rowCount() > 0) {
            return true;
        }
        return false;
    }

    protected function checkID() {
        $result = $this->c()->prepare("SELECT * FROM store WHERE sid = ?");
        $result->execute([$this->id]);
        if ($result->rowCount() > 0) {
            return true;
        }
        return false;
    }
}