@extends('backend.menus.indexSuperior')
 
@section('content-admin-css')
    <link href="{{ asset('css/backend/adminlte3/adminlte.min.css') }}" type="text/css" rel="stylesheet" /> 
    <!-- data table -->
    <link href="{{ asset('css/backend/adminlte3/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" /> 
    <!-- mensaje toast -->
    <link href="{{ asset('plugins/toastr/toastr.min.css') }}" type="text/css" rel="stylesheet" />

@stop

  <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Cotizaciones Procesadas</h1>
            </div>

          </div>
        </div>
  </section>
    <!-- seccion frame -->
  <section class="content">
    <div class="container-fluid">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Cotizaciones Procesadas</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
      
              <table id="example2" class="table table-bordered table-hover">
                <thead>             
                <tr>
                  <th style="width: 5%;">C&oacute;digo</th>
                  <th style="width: 15%;">Destino</th>
                  <th style="width: 10%;">Fecha</th>    
                  <th style="width: 20%;">Necesidad</th>                           
                  <th style="width: 20%;">Proveedor</th>                            
                  <th style="width: 10%;">Cod Proyecto</th>                        
                  <th style="width: 20%;">Opciones</th>

                </tr>
                </thead>
                <tbody>
              @foreach($cotizaciones_procesadas as $datos)
              @if($datos->estado == 1)
              <tr class="table-success">
              @elseif($datos->estado == 2)
              <tr class="table-danger">
              @endif()
                
                  <td>{{ $datos-> id }}</td>
                  <td>{{ $datos-> destino }}</td>
                  <td>{{ $datos-> fecha }}</td>
                  <td>{{ $datos-> necesidad }}</td> 
                  <td>{{ $datos-> proveedor_nombre }}</td> 
                  <td>{{ $datos-> proyecto_cod }}</td>          
                  <td>
                  <a class="btn btn-warning btn-xs" href="{{ url('/admin/ver_cotizacion/'.$datos->id ) }}" target="frameprincipal">
                  <i class="fa fa-eye" title="Editar"></i>&nbsp; Ver </a>

                    <button type="button"  class="btn btn-info btn-xs "onclick="abrirModalGenerarReporte()">
                      Generar Reporte
                    </button>

                  </td>                    
                </tr>
              @endforeach  
                </tbody>            
              </table>
             </div>
            </div>          
          </div>


        <!-- Modal  Generar Reporte -->
        <div class="modal fade" id="modalGenerarReporte" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Detalles de Orden</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="formulariocrearreporte">
                    <div class="card-body">    
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="form-group col-md-6">
                              <label for="" >Administrador de Contrato</label>
                              <select class="custom-select" id="proveedor">
                              {{--@foreach($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                              @endforeach--}}
                              </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Fecha de Orden</label>
                                <input type="date" name="fechareporte" id="fechareporte" class="form-control" value="<?php echo date("Y-m-d");?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="" >Lugar</label>
                            <textarea type="textbox" class="form-control" id="lugar" rows="3" ></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  <a {{-- href="{{route('pdf.misc.create', ['id' => $dato->ans] )}}" --}} target="_blank"> <button type="button"  class="btn btn-info btn-s">
                    <i class="fas fa-print" title="Imprimir"></i>&nbsp; Generar
                  </button></a>
                </div>          
              </div>        
            </div>      
        </div>
          



       </div>
      </div>
  </section>
  
@extends('backend.menus.indexInferior')

@section('content-admin-js')	

  <!-- data table -->
  <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/loading/loadingOverlay.js') }}" type="text/javascript"></script> 
  <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>

  <script>
//*********************** Para darle tiempo al toaster al recargar la pagina */
toastr.options.timeOut = 750;
    toastr.options.fadeOut = 750;
    toastr.options.onHidden = function(){
      // this will be executed after fadeout, i.e. 2secs after notification has been show
     window.location.reload();
    }; 
//************************************************************************** */
  function abrirModalGenerarReporte(){
    $('#modalGenerarReporte').css('overflow-y', 'auto');
    $('#modalGenerarReporte').modal('show');
  }
//Script para Organizar la tabla de datos
    $(document).ready(function() {
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "order": [[ 2, "desc" ]],
        "info": true,
        "autoWidth": false,
        "language": {
        "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas"            
        }
      });
    });
</script>

@stop