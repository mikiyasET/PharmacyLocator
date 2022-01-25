<?php

class StoreView extends Store
{
    public function checkID()
    {
        return parent::checkID();
    }
    public function checkMed()
    {
        return parent::checkMed();
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