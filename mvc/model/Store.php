<?php

class Store extends Database
{
    public $id;
    public $medicine;
    public $pharmacy;

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
    protected function showAll() {
        $result = $this->c()->query("SELECT * FROM store");
        $result->execute();
        if ($result->rowCount() > 0) {
            return $result->fetchAll();
        }
        return [];
    }
    protected function show() {
        $result = $this->c()->prepare("SELECT * FROM store WHERE sid = ?");
        $result->execute([$this->id]);
        if ($result->rowCount() > 0) {
            return new ArrayObject($result->fetch(), ArrayObject::ARRAY_AS_PROPS);
        }
        return [];
    }
    protected function search() {
        $result = $this->c()->prepare("SELECT m.mid as mid,m.name as medicine,p.name as pharmacy,p.mapLink as mapLink,p.img as pImage,p.description as pDesc,l.name as location FROM medicine as m join store as s on s.mid = m.mid join pharmacy p on s.pid = p.pid join location l on l.lid = p.lid where m.name = ? ");
        $result->execute([$this->medicine]);
        if ($result->rowCount() > 0) {
            return $result->fetchAll();
        }
        return [];
    }
}