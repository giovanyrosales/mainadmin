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
                  <!--@hasrole('uaci')-->
                  <button type="button"  class="btn btn-info btn-xs " onclick="abrirModalGenerarOrden({{ $datos->id }})">
                      Generar Orden
                  </button>
                  <!-- @endhasrole-->
                  </td>                    
                </tr>
              @endforeach  
                </tbody>            
              </table>
             </div>
            </div>          
          </div>

        <!-- Modal  Generar Orden -->
        <div class="modal fade" id="modalGenerarOrden" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Detalles de Orden</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="formulariocrearorden">
                    <div class="card-body">    
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="form-group col-md-6">
                              <label for="" >Administrador de Contrato</label>
                              <select class="custom-select" id="admin_contrato_idn" name="admin_contrato_idn">
                              @foreach( $admins_contrato as $admins)
                                <option value="{{ $admins->id }}">{{ $admins->nombre }}</option>
                              @endforeach
                              </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Fecha de Orden</label>
                                <input type="date" name="fechaordenn" id="fechaordenn" class="form-control" value="<?php echo date("Y-m-d");?>">
                                <input type="hidden" name="cotizacion_idn" id="cotizacion_idn" class="form-control">
                                <input type="hidden" name="requisicion_idn" id="requisicion_idn" class="form-control">
                                <input type="hidden" name="proveedor_idn" id="proveedor_idn" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="" >Lugar</label>
                            <textarea type="textbox" class="form-control" id="lugarn" name="lugarn" rows="3" ></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnGuardarU" onclick="enviarModalGenerarOrden()">Guardar</button>
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
  //carga el modal para ingresar los datos de la orden
  
function abrirModalGenerarOrden(id){
  document.getElementById("formulariocrearorden").reset();   
  spinHandle = loadingOverlay().activate();
  axios.post(url+'get_cotizacion',{'id': id })
      .then((response) => {	
        loadingOverlay().cancel(spinHandle); // cerrar loading
        if(response.data.success = 1){
          $('#modalGenerarOrden').css('overflow-y', 'auto');
          $('#modalGenerarOrden').modal('show');
          $('#cotizacion_idn').val(response.data.cotizacion.id);
          $('#requisicion_idn').val(response.data.cotizacion.requisicion_id);
          $('#proveedor_idn').val(response.data.cotizacion.proveedor_id);
        }else{ 
          toastr.error('Error', 'Cotizacion no encontrada'); 
        }
      })
      .catch((error) => {
        loadingOverlay().cancel(spinHandle); // cerrar loading
        toastr.error('Error');    
  });
}

//Guardar Orden
function enviarModalGenerarOrden(){
            var requisicion_idn = document.getElementById('requisicion_idn').value;
            var fechaordenn = document.getElementById('fechaordenn').value;
            var lugarn = document.getElementById('lugarn').value;
            var cotizacion_idn = document.getElementById('cotizacion_idn').value;
            var proveedor_idn = document.getElementById('proveedor_idn').value;
            var admin_contrato_idn = document.getElementById('admin_contrato_idn').value;

      var spinHandle = loadingOverlay().activate(); // activar loading
            
      let formData = new FormData();
      formData.append('requisicion_id', requisicion_idn);
      formData.append('fechaorden', fechaordenn);
      formData.append('lugar', lugarn);
      formData.append('cotizacion_id', cotizacion_idn);
      formData.append('proveedor_id', proveedor_idn);
      formData.append('admin_contrato_id', admin_contrato_idn);
      
      axios.post(url+'add_orden', formData, {  
       })
       .then((response) => {	
         loadingOverlay().cancel(spinHandle); // cerrar loading            
        mensajeResponse1(response);
       })
       .catch((error) => {  
          loadingOverlay().cancel(spinHandle); // cerrar loading   
          toastr.error('Error', 'Datos incorrectos!');               
      }); 
}

  // mensaje cuando se crea una nueva orden
function mensajeResponse1(valor){
    if(valor.data.success == 1){
      toastr.success('Guardado', 'Orden creada exitosamente!');
      $('#modalGenerarReporte').modal('hide'); 
      window.open("{{ URL::to('admin/pdf_orden') }}/" + valor.data.orden_id);
    }else if(valor.data.success == 2){
      toastr.error('Error', 'Orden NO guardada!');
    }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
    }
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