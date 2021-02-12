@extends('layouts.app')
@section('content')
<div class="container">
    @if ($actualizado= Session::get('actualizado'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Lo sentimos!</strong> {{ $actualizado }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Buscar Estudiante') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('') }}
                    <table id="tablaBuscar" class="table table-striped" cellspacing="0" width="100%">
                        <thead >
                            <tr>
                                <th>Nº Registro</th>
                                <th>Nombre Completo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listarEstudiantes as $row)
                                <tr>
                                    <td class="scope">{{$row->numero_registro_asignado}}</td>
                                    <td class="scope">{{$row->nombre_completo}}</td>
                                    <td class="scope">  <a class="btn btn-cancelar w-50 align-self-center text-light" href="{!! url("/historial-faltas/buscar/$row->numero_registro_asignado") !!}">
                                        <i class="icon ion-md-share-alt"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class=" text-center h-100  d-flex justify-content-center align-items-center">
                        <div class="text-center">
                            <a class="btn btn-cancelar mt-2 w-100 align-self-center text-light" href="{!! url("/dde") !!}">Cancelar</a>
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
    $(document).ready(function() {
       $('#tablaBuscar').DataTable({
           columnDefs: [ { goals: [4]  }],
           responsive: true,
           "paging":   true,
           "info": false,
           autoWidth:  true,
           scrollY:     400,
           "scrollX": true,
           deferRender: true,
           scroller: {
               loadingIndicator: true
           },  
          
           language: {
               "lengthMenu": "Mostrar _MENU_ registros",
               "zeroRecords": "Nada encontrado",
               "info": "_PAGE_ de _PAGES_",
               "infoEmpty": "No records available",
               "infoFiltered": "(filtrando de _MAX_ registros totales)",
               "search":"Buscar:",
               "paginate": {
                   "next": "Siguiente",
                   "previous": "Anterior"
               }
           },
            
     
       });
       
       
   });
</script>
@endsection
