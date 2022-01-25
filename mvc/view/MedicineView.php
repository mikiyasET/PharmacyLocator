<?php

class MedicineView extends Medicine
{
    public function checkName()
    {
        return parent::checkName();
    }
    public function checkID()
    {
        return parent::checkID();
    }
    public function all()
    {
        return $this->showAll();
    }

    public function one()
    {
        return $this->show();
    }
}