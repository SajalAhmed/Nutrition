<?php

namespace App\Repository;

interface RegisterUserInterface
{
    public function activeUser($email,$code);
    public function login($data);
    public function passwordChange($data,$id);
    public function getDivision();
    public function getAffiliteds();
    public function getDesignation();
    public function getAllDesignation();
    public function datatableViewRegisterUser($data);
}
