@extends('layouts.panel')

@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Nuevo  paciente</h3>
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
            <form action="{{url('patients/'.$patient->id)}}" method="post">
                @csrf
                @method('PUT')
                <div  class="form-group">
                    <label for="name">Nombre del paciente</label>
                    <input type="text" name="name" value="{{old('name',$patient->name)}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" value="{{old('email',$patient->email)}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Documento</label>
                    <input type="number" name="identity_card" value="{{old('identity_card',$patient->identity_card)}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Direccion</label>
                    <input type="text" name="address" value="{{old('address',$patient->address)}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Telefono / movil</label>
                    <input type="number" name="phone" value="{{old('phone',$patient->phone)}}" class="form-control">
                </div>


                <div class="form-group">
                    <label for="email">Contraseña</label>
                    <input type="password" name="password" class="form-control">
                    <p>Ingrese un valor sólo si desea modificar la contraseña</p>
                </div>

                <button type="submit" class="btn btn-outline-success">
                    Guardar
                </button>
            </form>
        </div>
    </div>

@endsection
