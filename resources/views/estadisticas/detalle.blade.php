@extends('layouts.app')
@section('content')
<div class="container">
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
                            <div class="col-lg-12 ">
                                <p>
                                   
                                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                      Info
                                    </button>
                                  </p>
                                  <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                      Se aplicaron {{$contarSanciones}} sanciones entre las fechas {{$fechaInicio}} a {{$fechaFinal}}
                                    </div>
                                  </div>
                            </div>
                             
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 my-1">
                                <div class="card border-0">
                                    <div class="card-header"><strong>{{ __('Sancionados') }}</strong></div>
                                    <div class="card-body">
                                        <div class="author text-center"> 
                                            <table id="tablaSanciones" class="table table-striped" cellspacing="0" width="100%">
                                                <thead >
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Numero Registro</th>
                                                        <th>Nombre Completo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($listarSancionados as $row)
                                                    <tr>
                                                        <td class="scope">{!! $row->fecha_sancion !!}</td>
                                                        <td class="scope">{!! $row->numero_registro_asignado !!}</td>
                                                        <td class="scope">{!! $row->nombre_completo !!}</td>    
                                                    </tr>
                                                    @endforeach
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                            <div class="col-lg-6 my-1">
                                <div class="card border-0">
                                    <div class="card-header"><strong>{{ __('En Espera') }}</strong></div>
                                    <div class="card-body">
                                        <div class="author"> 
                                            <table id="tablaEnEspera" class="table table-striped" cellspacing="0" width="100%">
                                                <thead >
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Numero Registro</th>
                                                        <th>Nombre Completo</th>
                                                        <th>Tipo de Falta</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($listarEnEspera as $row)
                                                    <tr>
                                                        <td class="scope">{!! $row->fecha_falta_cometida!!}</td>
                                                        <td class="scope">{!! $row->numero_registro_asignado !!}</td>
                                                        <td class="scope">{!! $row->nombre_completo !!}</td>
                                                        <td class="scope">{!! $row->nombre_tipo !!}</td>
                                                        <td class="scope"><a class="btn btn-cancelar mt-2 w-100 align-self-center text-light" href="{!! url("/sanciones") !!}">Ir<a></td>     
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
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 my-2">
                                <div class="card border-0">
                                    <div class="card-header"><strong>{{ __('Grafico - Cantidad de Sanciones por Fecha') }}</strong> </div>
                                    <div class="card-body">
                                        <canvas id="myChart" width="600" height="400"></canvas>
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

    var fecha=[];
    var cantidad=[];
    $(document).ready(function(){
        
        var form_data= {
                fecha_inicio: '{{$fechaInicio ?? ''}}',
                fecha_final: '{{$fechaFinal ?? ''}}'

            };
        console.log(form_data); 
            
        $.ajax({
            
                url: '{{url("/estadisticas/grafico/{fecha_inicio}/{fecha_final}")}}',
                type: 'get',
                data: form_data,
                success: function (data) {  
                    console.log(data);
                    
                    for(var i = 0; i < data.length; i++)
                    {
                        fecha.push(data[i].fecha_sancion);
                        cantidad.push(data[i].cantidad_sanciones);
                    }

                    var ctx = document.getElementById('myChart');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: fecha,
                            datasets: [{
                                label: 'Número de Sanciones',
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
            $('#tablaSanciones').DataTable({
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
            $(document).ready(function() {
               $('#tablaEnEspera').DataTable({
                   columnDefs: [ { goals: [4]  }],
                   responsive: true,
                   "paging":   false,
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