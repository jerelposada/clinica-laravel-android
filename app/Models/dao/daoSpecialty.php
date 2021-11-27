<?php

namespace App\Models\dao;

use App\Models\Specialty;

class daoSpecialty
{
    private $modelSpecialty;
    public function __construct()
    {
        $this->modelSpecialty = new Specialty();
    }

    public  function  getAllSpecialty(){
       return  $this->modelSpecialty::all();
    }

    public function store($name,$description){

        $this->modelSpecialty->name = $name;
        $this->modelSpecialty->description = $description;
        $this->modelSpecialty->save();

    }
}
