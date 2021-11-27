<?php

namespace App\Http\Controllers\logicBussines;

use App\Http\Requests\validateSpecialty;
use App\Models\dao\daoSpecialty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecialtyController extends Controller
{
    private $daoSpecialty;
    public  function __construct()
    {
        $this->middleware('auth');
        $this->daoSpecialty = new daoSpecialty();
    }


    public  function index(){

       $specialties =  $this->daoSpecialty->getAllSpecialty();
        return view('specialties.index',compact('specialties'));

    }


    public  function create(){
        return view('specialties.create');
    }


    public  function edit(){

    }

    public  function store(validateSpecialty $request){

     $this->daoSpecialty->store($request['name'],$request['description']);
     return redirect('/specialties');
    }
}
