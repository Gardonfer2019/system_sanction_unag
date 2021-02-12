@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Solicitud Falta') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 my-2">
                                <div class="text-center">
                                    <h6 class="">Nombre del Estudiante</h6>
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

@section('script')
<script>
    
    $(document).ready(function ()
    {
     
        

        $.ajaxSetup(
        {
            headers:
            {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax(
        {
            url:'{{ url("/datos/{numero_registro_asignado}")}}',
            type:'get',
            data: $("#formBuscar").serialize(),
            success: function(data)
            {
                console.log(data[0].numero_registro_asignado);
                     
            }
        });
    });
</script>
@endsection

