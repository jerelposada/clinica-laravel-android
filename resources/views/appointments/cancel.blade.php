@extends('layouts.panel')

@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Cancelar cita</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if(session('notification'))
                <div class="alert alert-success" role="alert">
                    <strong>Success!</strong>{{session('notification')}}
                </div>
            @endif

            <p> Estas a punto de cancelar tu cita reservada con el medico <span>{{$appointment->doctor->name}}</span>
                para el día: {{$appointment->scheduled_date}}</p>
                <form  action="{{url('appointments/'.$appointment->id.'/cancel')}}"  method="post">
                   @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="justification">Por favor cuentanos el motivo de la cancelación: </label>
                        <textarea required name="justification" id="justification" class="form-control" rows="3"></textarea>

                    </div>
                    <button class="btn btn-danger" type="submit">Cancelar cita</button>
                    <a href=" {{url('/appointments')}}" class="btn btn-default">
                        Volver al listado de citas sin cancelar
                    </a>
                </form>
        </div>
    </div>
@endsection

