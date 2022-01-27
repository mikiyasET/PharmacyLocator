<?php

class MedicineView extends Medicine
{
    public function checkName()
    {
        return parent::checkName();
    }
    public function checkNameExceptThis()
    {
        return parent::checkNameExceptThis();
    }

    public function checkID()
    {
        return parent::checkID();
    }
    public function all()
    {
        return $this->showAll();
    }
    public function search()
    {
        return parent::search();
    }

    public function one()
    {
        return $this->show();
    }
    public function getID()
    {
        return parent::getID();
    }
}