@extends('layouts.panel')

@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Mis citas</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if(session('notification'))
                <div class="alert alert-success" role="alert">
                    <strong>Success!</strong>{{session('notification')}}
                </div>
            @endif

                <div class="nav-wrapper">
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#confirmed-appointments" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">Mis proximas citas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#pending-appointments" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">citas por confirmar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#old-appointments" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">historial de citas atendidas </a>
                        </li>
                    </ul>
                </div>


        </div>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="confirmed-appointments" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
               @include('appointments.confirmed-appointments');
            </div>
            <div class="tab-pane fade" id="pending-appointments" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                @include('appointments.pending-appointments')
            </div>
            <div class="tab-pane fade" id="old-appointments" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                @include('appointments.pending-appointments')
            </div>

        </div>




    </div>
@endsection

