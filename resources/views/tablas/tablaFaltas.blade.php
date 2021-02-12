@extends('layouts.app')
@section('tabla')
    @section('content')
    <div class="demo-container card">
        <div class="card-body">
            <table id="tablaFaltas" class="table table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descripcion</th>
                        <th>Tipo de Falta</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listarFaltas as $row)
                    <tr>
                        <td class="scope">{!! $row->id_sancion_falta !!}</td>
                        <td class="scope">{!! $row->descripcion !!}</td>
                        <td class="scope">{!! $row->nombre_tipo !!}</td>
                        <td><input type="checkbox" class="form-check-input align-items-center" id="checkFalta" ></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
    @endsection
    @section('script')
    
    <script>
        $(document).ready(function() {
            $('#tablaFaltas').DataTable({
                columnDefs: [ { goals: [4]  }],
                responsive: true  
            });
            
            
        });
    </script>
    
    @endsection
    
@endsection




