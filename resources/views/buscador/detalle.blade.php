@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Estudiante') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <div class="card-text text-center h-100  d-flex justify-content-center align-items-center">
                      <div class="author text-center">
                        
                          <img src="{{ asset('/img/usuario.png') }}" alt="image" class="img-fluid rounded-circle avatar mr-2 align-items-center">
                          <h4 class="title text-center mt-5">{{$ubicacion}}</h4>
                          <h4 class="title text-center mt-3">{{$numero_registro_asignado}}</h4>
                          <h3 class="title text-center mt-3">{{$nombre_completo}}</h3>
                        
                        <h5 class="description">
                            {{$nombre_carrera}} <br>
                        
                        </h5>
                      </div>
                     
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 my-2">
                                <div class="text-center">
                                    {{-- <a class="btn btn-primary w-100 align-self-center text-light" href="{!! route('solicitud-falta.index') !!}">Faltar</a> --}}
                                    <button type="button" class="btn btn-primary w-100 align-self-center text-light" data-toggle="modal" data-target="#exampleModal">
                                        Faltar
                                      </button>
                                      
                                      <!-- Modal -->
                                      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: scroll;">
                                        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Solicitud Falta</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                                
                                                <form class="text-left" action="/detalle/{numero_registro_asignado}" method="POST" >
                                                    
                                                    {{-- TOKEN --}}
                                                    @csrf

                                                    {{-- Datos del Estudiante --}}
                                                    
                                                    <div class="form-group">
                                                      <label for="InputNumeroRegistroAsignado">Número de Registro</label>
                                                      <input type="text" class="form-control" id="InputNumeroRegistroAsignado" name="inputNumeroRegistroAsignado" placeholder="" value="{{$numero_registro_asignado}}" readonly>
                                                      
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="InputNombreCompleto">Nombre Compelto</label>
                                                      <input type="text" class="form-control" id="InputNombreCompleto" name="inputNombreCompleto" placeholder="Nombre Completo" value="{{$nombre_completo}}" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="InputNombreCarrera">Carrera</label>
                                                        <input type="text" class="form-control" id="InputNombreCarrera" name="inputNombreCarrera" placeholder="Carrera" value="{{$nombre_carrera}}" readonly>
                                                      </div>
                                                    

                                                    {{-- Faltas --}}

                                                    <div class="form-group">
                                                        
                                                        <label for="InputIdFalta">Falta Cometida</label>
                                                        {{-- <input type="text" class="form-control" id="InputIdFalta"  placeholder="Falta" value=""> --}}
                                                        <div class=" card">
                                                            <div class="card-body">
                                                                <table id="tablaFaltas" class="table table-striped" cellspacing="0" width="100%">
                                                                    <thead >
                                                                        <tr cellspacing="0" width="100%">
                                                                            <th>ID</th>
                                                                            <th>Descripción</th>
                                                                            <th>Tipo de Falta</th>
                                                                            <th>Acción</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($listarFaltas as $row)
                                                                        <tr>
                                                                            <td class="scope">{!! $row->id_sancion_falta !!}</td>
                                                                            <td class="scope">{!! $row->descripcion !!}</td>
                                                                            <td class="scope">{!! $row->nombre_tipo !!}</td>
                                                                            <td  class="text-center"><input type="checkbox" class="form-check-input" id="checkboxFalta" name="checkBoxFalta[]" value="{{$row->id_sancion_falta}}"></td>
                                                                        </tr>
                                                                        @endforeach
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                       
                                                        
                                                    </div>
                                                    {{-- <div class="form-group">
                                                        <label for="InputSancion">Sanción</label>
                                                        <input type="text" class="form-control" id="InputSancion" name="inputSancion" placeholder="Sanción" disabled>
                                                    </div> --}}
                                                    <div class="form-group">
                                                        <label for="InputFechaFalta">Fecha</label>
                                                        
                                                        
                                                        <input type="date" class="form-control" id="InputFechaFalta" name="inputFechaFalta" placeholder="2021-01-07"  required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="InputAnioFalta">Año</label>
                                                        <input type="number" class="form-control" id="InputAnioFalta" name="inputAnioFalta" placeholder="2021" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="InputPeriodo">Periodo</label>
                                                        <input type="number" class="form-control" id="InputPeriodo" name="inputPeriodo" placeholder="1" required>
                                                    </div>
                                                    
                                                    
                                                    {{-- Otro --}}

                                                    <div class="form-group">
                                                        <label for="FormControlObservaciones">Observaciones</label>
                                                        <textarea class="form-control" id="FormControlObservaciones" name="inputObservaciones" rows="3" required></textarea>
                                                      </div>
                                                    <div class="form-group">
                                                        <label for="InputResponsable">Responsable</label>
                                                        <input type="text" class="form-control" id="InputResponsable" name="inputResponsable" placeholder="Nombre del Responsable" required>
                                                        <input type="hidden" class="form-control" id="InputIdUsuario" name="inputUsuario" value=" {{ Auth::user()->id }}">
                                                        <input type="hidden" class="form-control" id="InputBorrado" name="inputBorrado" value="false">
                                                        <input type="hidden" class="form-control" id="InputApelada" name="inputApelada" value="false">
                                                        <input type="hidden" class="form-control" id="InputSancionada" name="inputSancionada" value="false">  
                                                    </div>
                                                   <div class="form-group text-right">
                                                        <button type="button" class="btn btn-cancelar text-light" data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                                   </div>
                                                    
                                                  </form>
                                            </div>
                                            <div class="modal-footer">
                                              
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                               
                            </div>
                            <div class="col-lg-6 my-2">
                                <div class="text-center">
                                    <a class="btn btn-cancelar w-100 align-self-center text-light" href="{!! url("/buscar") !!}">Cancelar</a>
                                    
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
        var form_data= {
                numero_registro_asignado: '{{$numero_registro_asignado}}',
                nombre_completo: '{{$nombre_completo}}',
                nombre_carrera: '{{$nombre_carrera}}'
            };
        
        console.log(JSON.stringify(form_data));
        

        
    
       
    });
</script>
<script>
      $(document).ready(function() {
            $('#tablaFaltas').DataTable({
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
