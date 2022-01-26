<?php

class PharmacyView extends Pharmacy {
    public function checkNameEmail()
    {
        return parent::checkNameEmail();
    }
    public function checkNameEmailExceptThis()
    {
        return parent::checkNameEmailExceptThis();
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
    public function checkEmail()
    {
        return parent::checkEmail();
    }

    public function verify() {
        return $this->check();
    }
    public function getID()
    {
        return parent::getID();
    }
    public function isPassword()
    {
        return parent::isPassword();
    }
}