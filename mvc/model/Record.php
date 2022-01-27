<?php

class Record extends Database
{
    public $id;
    public $user;
    public $medicine;
    public $counter;

    protected function add() {
        if (!$this->checkMed()) {
            $this->id = uniqid();
            $result = $this->c()->prepare("INSERT INTO record (rid, uid, mid, counter) VALUES (?,?,?,?)");
            return $result->execute([$this->id,$this->user,$this->medicine,1]);
        }else {
            return $this->edit();
        }
    }
    protected function edit() {
        if ($this->checkMed()) {
            $this->counter = $this->counter() + 1;
            $result = $this->c()->prepare("UPDATE record SET counter = ? WHERE mid = ? and uid = ?");
            return $result->execute([$this->counter,$this->medicine,$this->user]);
        }
        return false;
    }
    protected function remove() {
        if ($this->checkID()) {
            $result = $this->c()->prepare("DELETE FROM record WHERE rid = ?");
            return $result->execute([$this->id]);
        }
        return false;
    }
    protected function checkMed() {
        $result = $this->c()->prepare("SELECT * FROM record WHERE mid = ? and uid = ?");
        $result->execute([$this->medicine,$this->user]);
        if ($result->rowCount() > 0) {
            return true;
        }
        return false;
    }

    protected function checkID() {
        $result = $this->c()->prepare("SELECT * FROM record WHERE rid = ?");
        $result->execute([$this->id]);
        if ($result->rowCount() > 0) {
            return true;
        }
        return false;
    }
    protected function counter() {
        $stmt = $this->c()->prepare("SELECT * FROM record WHERE mid = ? and uid = ?");
        $stmt->execute([$this->medicine,$this->user]);
        $exe = $stmt->fetch();
        return intval($exe['counter']);
    }

    protected function showAll() {
        $result = $this->c()->query("SELECT sum(counter) as searched, name FROM record join medicine m on m.mid = record.mid group by name order by searched desc limit 10");
        $result->execute();
        if ($result->rowCount() > 0) {
            return $result->fetchAll();
        }
        return [];
    }
}