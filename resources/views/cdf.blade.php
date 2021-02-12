@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 my-2">
                                <div class="text-center">
                                    {{ __('Bienvenido') }}  {{ Auth::user()->name }}
                                </div>
                            </div>
                            <div class="col-lg-6 my-2">
                                <div class="text-center">
                                    <a class="btn btn-primary w-100 align-self-center text-light" href="{!! url("/buscar") !!}">Faltar</a>
                                    <a class="btn btn-cancelar mt-2 w-100 align-self-center text-light" href="{!! url("/sanciones") !!}">Sanciones
                                        <span class="text-right badge badge-pill badge-light ml-1">{{$contador}}</span></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
