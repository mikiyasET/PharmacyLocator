<?php

class AdminView extends Admin {
    public function checkID()
    {
        return parent::checkID();
    }
    public function verify() {
        return $this->check();
    }
    public function getID()
    {
        return parent::getID();
    }
    public function one() {
        return $this->show();
    }
    public function isPassword()
    {
        return parent::isPassword(); // TODO: Change the autogenerated stub
    }
}