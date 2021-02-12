@extends('layouts.app')
@section('content')
<div class="container">
    @if ($actualizado= Session::get('actualizado'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Excelente!</strong> {{ $actualizado }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><strong>{{ __('Historial de Faltas') }}</strong></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 ">
                                <div class="text-center">
                                    <a class="btn btn-cancelar w-50 align-self-center text-light" href="/historial-faltas/buscar">
                                        <i class="icon ion-md-arrow-round-back"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-8 my-1"></div>
                            <div class="col-md-2 ">
                                <div class="text-center">
                                    <a class="btn btn-cancelar w-50 align-self-center text-light" href="/reporte/ficha-disciplinaria/{{$numero_registro_asignado}}" target="_blank">
                                        <i class="icon ion-md-download"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 my-1">
                                <div class="card border-0">
                                    <div class="card-header"><strong>{{ __('Estudiante') }}</strong></div>
                                    <div class="card-body">
                                        <div class="author text-center"> 
                                            <img src="{{ asset('/img/usuario.png') }}" alt="image" class="img-fluid rounded-circle avatar mr-2 align-items-center text-center" width="200" height="200">
                                            <h5 class="title text-center mt-3">{{$numero_registro_asignado}}</h5>
                                            <h4 class="title text-center mt-3">{{$nombre_completo}}</h4>
                                            <h5 class="title text-center mt-3">{{$nombre_carrera}}</h5>
                                            <h5 class="title text-center mt-3">{{$ubicacion}}</h5>
                                            <h6 class="title text-center mt-3">Edificio: {{$descripcion_edificio ?? ''}}</h6>
                                            <h6 class="title text-center mt-3">Habitación: {{$aula ?? ''}}</h6>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                                Editar
                                            </button>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Editar Ubicación</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                 {{-- Formulario --}}
                                                <form action="/historial-faltas/buscar/{numero_registro_asignado}" method="post">
                                                    {{-- _TOKEN --}}
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="selectUbicacion">Elige la Ubicación</label>
                                                        <select class="form-control" id="selectUbicacion" name="selectUbicacion">
                                                          <option value="I">Interno</option>
                                                          <option value="E">Externo</option>
                                                          
                                                        </select>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="selectEdificio">Edificio</label>
                                                        <select  class="form-control" id="selectEdificio" name="selectEdificio">
                                                            @foreach ($listarEdificio as $opc)
                                                                <option value="{{$opc->id_edificio}}">{{$opc->descripcion}}</option>
                                                            @endforeach
                                                            
                                                        </select>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="inputHabitacion">Habitación</label>
                                                        <input type="number" class="form-control" id="inputHabitacion" name="inputHabitacion" placeholder="1" required>
                                                      </div>
                                                      <div class="form-group">
                                                        <input type="hidden" class="form-control" id="inputNumeroRegistro" name="inputNumeroRegistro" value="{{$numero_registro_asignado}}">
                                                      </div>
                                                      <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cancelar</button>
                                                      <button type="submit" class="btn btn-primary">Guardar</button>
                                                </form>
                                                </div>
                                                <div class="modal-footer">
                                               
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                            <div class="col-lg-6 my-1">
                                <div class="card border-0">
                                    <div class="card-header"><strong>{{ __('Gráfico - Número de faltas sancionadas') }}</strong></div>
                                    <div class="card-body">
                                        <div class="author"> 
                                            <canvas id="myChart" width="600" height="400"></canvas>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div> 
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 my-2">
                                <div class="card border-0">
                                    <div class="card-header"><strong>{{ __('Faltas') }}</strong> </div>
                                    <div class="card-body">
                                        <table id="tablaFaltas" class="table table-striped" cellspacing="0" width="100%">
                                            <thead >
                                                <tr>
                                                    <th>Fecha</th>
                                                    <th>Sanción</th>
                                                    <th>Descripción</th>
                                                    <th>Reportó</th>
                                                    <th>Fecha Sanción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($listaFaltasSancionadas as $row)
                                                <tr>
                                                    <td class="scope">{!! $row->fecha_falta_cometida !!}</td>
                                                    <td class="scope">{!! $row->nombre_tipo !!}</td>
                                                    <td class="scope">{!! $row->descripcion !!}</td>
                                                    <td class="scope">{!! $row->responsable !!}</td>
                                                    <td class="scope">{!! $row->fecha_sancion !!}</td>
                                                    
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>
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

    var faltas=[];
    var cantidad=[];
    $(document).ready(function(){
        
        var form_data= {
                numero_registro_asignado: '{{$numero_registro_asignado ?? ''}}'

            }; 
            console.log(form_data);
        $.ajax({
                url: '{{url("/grafica/{numero_registro_asignado}")}}',
                type: 'get',
                data: form_data,
                success: function (data) {  
                    console.log(data);
                    
                    for(var i = 0; i < data.length; i++)
                    {
                        faltas.push(data[i].nombre_tipo);
                        cantidad.push(data[i].faltas);
                    }

                    var ctx = document.getElementById('myChart');
                    var myChart = new Chart(ctx, {
                        type: 'horizontalBar',
                        data: {
                            labels: faltas,
                            datasets: [{
                                label: 'Número de Faltas',
                                data: cantidad,
                                backgroundColor: [
                                    'rgba(25, 118, 210,  0.7)',
                                    'rgba(56, 142, 60, 0.7)',
                                    'rgba(255, 235, 59, 0.7)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(25, 118, 210, 1)',
                                    'rgba(56, 142, 60, 1)',
                                    'rgba(255, 235, 59, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    },
                                    stacked: true
                                }],
                                xAxes: [{
                                    stacked: true
                                }],
                            }
                        }
                    });
            }
           
        });
        
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

    <script>
        $(document).ready(function(){
            
            $("#selectUbicacion").change( function() 
            {
                if ($(this).val() == "E") {
                    
                    $("#selectEdificio").prop("disabled", true);
                    $("#inputHabitacion").prop("disabled", true);
                    $("#selectEdificio").val("NO");
                    $("#inputHabitacion").val("0");
                } else {
                    $("#selectEdificio").prop("disabled", false);
                    $("#inputHabitacion").prop("disabled", false);
                }
            });
        });
    </script>
   
    
@endsection