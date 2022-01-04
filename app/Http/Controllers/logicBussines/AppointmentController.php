<?php

namespace App\Http\Controllers\LogicBussines;

use App\Http\Controllers\Controller;
use App\interfaces\ScheduleServicesInterface;
use App\Models\Appointment;
use App\Models\Specialty;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;


class AppointmentController extends Controller
{
    public function  create(ScheduleServicesInterface $scheduleServices){
        $specialties = Specialty::all();
        $specialtyId = old('specialty_id');
        if($specialtyId){
            $specialty = Specialty::find($specialtyId);
            $doctors = $specialty->users;
        }else{
            $doctors = collect();
        }

        $scheduleDate = old('scheduled_date');
        $doctorId = old('doctor_id');

        if ($scheduleDate && $doctorId){
            $intervals = $scheduleServices->getAvailableIntervals($scheduleDate,$doctorId);
        }else{
            $intervals = null;
        }

        return view('appointments.create',compact('specialties','doctors','intervals'));
    }

    public function store(Request $request, ScheduleServicesInterface $scheduleServices){

        $rules = [
            'description'=>'required',
            'specialty_id'=>'exists:specialties,id',
            'doctor_id'=>'exists:users,id',
            'scheduled_time'=>'required',
        ];

        $messages = [
            'scheduled_time.required'=> 'Por favor selecione una hora valida para su cita .'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        $validator->after(function ($validator) use ($scheduleServices,$request) {
            $date = $request->input('scheduled_date');
            $doctorId = $request->input('doctor_id');
            $scheduled_time = $request->input('scheduled_time');

            if ($date && $doctorId && $scheduled_time){
                $start = new Carbon($scheduled_time);
            }else{
                return;
            }
            if (!$scheduleServices->isAvailableInterval($date,$doctorId,$start)) {
                $validator->errors()->add('available_time', 'la hora reservada ya se encuentra reservada por otro paciente.');
            }
        });

        if($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }
      $data = $request->only([
            'description' ,
            'specialty_id',
            'doctor_id',
            'scheduled_date',
            'scheduled_time',
            'type'
      ]);

        $CarbonTime = Carbon::createFromFormat('g:i A',$data['scheduled_time']);
        $data['scheduled_time'] = $CarbonTime->format('H:i:s');
        $data['patient_id']= auth()->id();
        Appointment::create($data);

        $notification = ' La cita se ha creado correctamente!';
        return back()->with(compact('notification'));
    }
}
