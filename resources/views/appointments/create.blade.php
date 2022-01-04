@extends('layouts.panel')

@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Registrar Nuevas citas</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('patients')}}" class="btn btn-sm btn-default">Cancelar y volver</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{url('appointments')}}" method="post">
                @csrf

                <div class="form-group">
                    <label for="description">Descripcíon</label>
                    <input type="text" class="form-control" value="{{old('description')}}" name="description"
                           id="description" required placeholder="describe brevemente la consulta">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="specialty">Especialidad</label>
                        <select class="form-control" required name="specialty_id" id="specialty">
                            <option value="">-- seleccione especialidad--</option>
                            @foreach($specialties as $specialty)
                                <option value="{{$specialty->id}}"
                                        @if(old('specialty_id') == $specialty->id) selected @endif>{{$specialty->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="doctor">Médico</label>
                        <select class="form-control" required name="doctor_id" id="doctor">
                            @foreach($doctors as $doctor)
                                <option value="{{$doctor->id}}"
                                        @if(old('doctor_id') == $doctor->id) selected @endif>{{$doctor->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label for="email">Fecha</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input class="form-control datepicker" placeholder="Selecionar fecha" type="text"
                               data-date-format="yyyy-mm-dd"
                               data-date-start-date="{{date('Y-m-d')}}"
                               data-date-end-date="+6d"
                               name="scheduled_date"
                               id="date"
                               value="{{ old('scheduled_date',date('Y-m-d'))}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="hours">horas de atencion</label>
                    <div id="hours">
                        @if($intervals)
                            @foreach($intervals['MorningIntervals'] as $key => $interval)
                                <div class="custom-control custom-radio mb-3">
                                    <input type="radio" id="intervalMorning-{{$key}}" value="{{$interval['start']}}" name="scheduled_time" required class="custom-control-input">
                                    <label class="custom-control-label" For="intervalMorning-{{$key}}">{{$interval['start']}} - {{$interval['end']}}</label>
                                </div>
                            @endforeach
                            @foreach($intervals['AfternoonIntervals'] as $key => $interval)
                                    <div class="custom-control custom-radio mb-3">
                                        <input type="radio" id="intervalAfternoon-{{$key}}" value="{{$interval['start']}}" name="scheduled_time" required class="custom-control-input">
                                        <label class="custom-control-label" For="intervalAfternoon-{{$key}}">{{$interval['start']}} - {{$interval['end']}}</label>
                                    </div>
                            @endforeach
                        @else
                            <div class="alert alert-info" role="alert">
                                selecciona un medico y una fecha para ver sus horarios disponibles
                            </div>
                        @endif

                    </div>
                </div>

                <div class="form-group">
                    <label for="type">tipo de consulta</label>
                    <div class="custom-control custom-radio mb-3">
                        <input type="radio" id="type1" name="type" value="consulta" class="custom-control-input"
                               @if(old('type','consulta')== "consulta") checked @endif>
                        <label class="custom-control-label" for="type1">consulta</label>
                    </div>
                    <div class="custom-control custom-radio mb-3">
                        <input type="radio" id="type2" name="type" value="examen" class="custom-control-input"
                               @if(old('type')=="examen") checked @endif>
                        <label class="custom-control-label" for="type2">examen</label>
                    </div>
                    <div class="custom-control custom-radio mb-3">
                        <input type="radio" id="type3" name="type" value="Operacion" class="custom-control-input"
                               @if(old('type')=="Operacion") checked @endif>
                        <label class="custom-control-label" for="type3">Operacion</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-outline-success">
                    Guardar
                </button>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script async src="{{asset('/js/appointments/create.js')}}"></script>
@endsection
