<?php

class UsersView extends Users {
    public function checkUsername()
    {
        return parent::checkUsername();
    }
    public function checkID()
    {
        return parent::checkID();
    }
    public function getID()
    {
        return parent::getID();
    }

    public function validate() {
        return $this->check();
    }
    public function one() {
        return $this->show();
    }
    public function all() {
        return $this->showAll();
    }
    public function isPassword()
    {
        return parent::isPassword();
    }
}