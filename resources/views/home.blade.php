@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modulo de Sanciones') }}</div>

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
                                </div>
                            </div>

                        </div>
                    </div>
                    
                  
                </div>
            </div>
            
            {{--  <!-- Buscador -->
               
            <div class="card my-3"> 
                <div class="card-header">{{ __('Buscar Estudiante') }}</div>   
                <div class="carda-body">
                    <div class="row d-flex justify-content-center mt-3">
                        <div class="col-md-12">
                            <div class="card-body shadow bg-white rounded">
                                @livewire("buscador-estudiantes")
                            </div>
                        </div>
                    </div>    
                </div>
            </div>   --}}
        </div>
    </div>
</div>
@endsection
