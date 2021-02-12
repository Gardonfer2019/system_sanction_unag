@extends('layouts.app')

@section('content')
<div class="container">
    @if ($error= Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Lo sentimos!</strong> {{ $error }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    @if ($apelacion= Session::get('apelacion'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Excelente!</strong> {{ $apelacion }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Apelaciones') }}</div>

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
                                    <a class="btn btn-primary w-100 align-self-center text-light" href="{!! url("/apelacion") !!}">Apelaciones
                                    <span class="text-right badge badge-pill badge-light ml-1">{{$contarFaltas}}</span></a>
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
