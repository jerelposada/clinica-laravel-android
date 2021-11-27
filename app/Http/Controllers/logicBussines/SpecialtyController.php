<?php

namespace App\Http\Controllers\logicBussines;

use App\Http\Requests\validateSpecialty;
use App\Models\dao\daoSpecialty;
use App\Models\Specialty;
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


    public  function edit(Specialty $specialty){
        return view('specialties.edit',compact('specialty'));
    }

    public  function store(validateSpecialty $request){

     $this->daoSpecialty->store($request['name'],$request['description']);
     $notification = "la especialidad se creado correctamente.";
     return redirect('/specialties')->with(compact('notification'));
    }

    public function update(validateSpecialty $request, Specialty $specialty){
        $UpdateSpecialty= $specialty->name;
       $specialty->name = $request->input('name');
       $specialty->description = $request->input('description');
       $specialty->save();

        $notification = "la especialidad'$UpdateSpecialty' se ha actualizado correctamente.";
        return redirect('/specialties')->with(compact('notification'));
    }


    public function destroy(Specialty $specialty){
        $deleteSpecialty= $specialty->name;
        $specialty->delete();
        $notification = "la especialidad'$deleteSpecialty ' se ha Eliminado correctamente.";
        return redirect('/specialties')->with(compact('notification'));
    }
}
