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
            <div class="col-sm-5">
              <h1>Ordenes de Compra Procesadas</h1>
            </div>
          <!--<div class="col-sm-2">
                <button type="button" onclick="abrirModalAgregar()" class="btn btn-info btn-sm">
                <i class="fas fa-pencil-alt"></i>
                Nueva Linea
                </button>
              </div>-->
          </div>
        </div>
  </section>
    <!-- seccion frame -->
  <section class="content">
    <div class="container-fluid">
        <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Ordenes de Compra</h3>

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
                  <th style="width: 20%;">Proyecto</th>
                  <th style="width: 20%;">Num. de Orden</th>
                  <th style="width: 20%;">Requisici&oacute;n</th>                      
                  <th style="width: 20%;">Cotizaci&oacute;n</th>                                                           
                  <th style="width: 20%;">Opciones</th>                           
                </tr>
                </thead>
                <tbody>
               @foreach($ordenes as $dato)
                @if($dato->estado == 2)
                <tr class="table-danger">
                @else                
                <tr>
                @endif()
                  <td>{{ $dato->proyecto_cod }}</td>
                  <td>{{ $dato->id }}</td>
                  <td>{{ $dato->requisicion_id }}</td> 
                  <td>{{ $dato->cotizacion_id }}</td>     
                  <td>
                    <a href="{{route('pdf.orden.create', ['id' => $dato->id] )}}" target="_blank"><button type="button"  class="btn btn-info btn-xs">
                      <i class="fas fa-print" title="Imprimir"></i>&nbsp; Imprimir
                    </button></a>
                     <!--@hasrole('uaci')-->
                     <button type="button" class="btn btn-danger btn-xs" onclick="abrirModalAnular({{ $dato->id }})">
                    <i class="fas fa-trash-alt" title="Eliminar"></i>&nbsp; Anular
                    </button>
                    @if($dato->acta == 0)
                      <button type="button" class="btn btn-warning btn-xs" onclick="abrirModalActa({{ $dato->id }})">
                      <i class="fa fa-laptop" title="GenerarOrden"></i>&nbsp; Generar Acta
                      </button>
                    @endif()
                    @if($dato->acta != 0)
                    <button type="button" class="btn btn-info btn-xs" onclick="imprimirActa({{ $dato->acta}})">
                    <i class="fas fa-print" title="ImprimirOrden"></i>&nbsp; Imprimir Acta
                    </button>
                    @endif()
                  <!-- @endhasrole-->
                  </td>                    
                </tr>
                @endforeach         
                </tbody>            
              </table>
             </div>
            </div>          
          </div>
       </div>
      </div>
    </section>

	 <!-- modal anular orden (Pendiente de configurar porque cambia el estado de la orden)-->
   <div class="modal fade" id="modalAnular">
      <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Anular Orden de Compra</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
                  <div class="modal-body">
                    <input type="hidden" id="idD" name="idD"/> <!-- id de la orden para Anularla -->                           
                  </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>             
              <button class="btn btn-danger" id="btnBorrar" type="button" onclick="anularOrden()">Si, Anular</button>
          </div>
        </div>      
      </div>        
  </div>
    <!-- Modal  Generar Acta -->
    <div class="modal fade" id="modalGenerarActa" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Detalles de Acta</h4>
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
                            <label class="col-md-12" for="appt">Hora de la acta</label>
                              <input class="col-md-6" type="time" id="horaacta" name="appt" min="09:00" max="18:00" value="<?php echo date('h:i'); ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Fecha de la Acta</label>
                                <input type="date" name="fechaacta" id="fechaacta" class="form-control" value="<?php echo date("Y-m-d");?>">
                                <input type="hidden" name="orden_id" id="orden_id" class="form-control" >
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnGuardarU" onclick="enviarModalGenerarActa()">Guardar</button>
                </div>          
              </div>        
            </div>      
        </div>
       </div>
  </div>
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

// abre el modal para Anular una orden
function abrirModalAnular(id){     
  $('#modalAnular').modal('show');
  $('#idD').val(id);    
}

function abrirModalActa(id){     
  $('#modalGenerarActa').modal('show');
  $('#orden_id').val(id);    
}

// enviar peticion para Anular la orden
function anularOrden(){
  id = document.getElementById("idD").value;
  spinHandle = loadingOverlay().activate(); // mostrar loading

  axios.post(url+'anular_orden',{
    'id': id  
      })
      .then((response) => {	
        loadingOverlay().cancel(spinHandle); // cerrar loading

        if(response.data.success == 1){
          toastr.success('Orden Anulada!')
          $('#modalAnular').modal('hide');   
        }else{
          toastr.error('Error', 'No se pudo anular la Orden');  
        }           
      })
      .catch((error) => {
        loadingOverlay().cancel(spinHandle); // cerrar loading   
        toastr.error('Error');               
  });
}
//Guardar Acta
function enviarModalGenerarActa(){
      var orden_id = document.getElementById('orden_id').value;
      var horaacta = document.getElementById('horaacta').value;
      var fechaacta = document.getElementById('fechaacta').value;

      var spinHandle = loadingOverlay().activate(); // activar loading
            
      let formData = new FormData();
      formData.append('orden_id', orden_id);
      formData.append('horaacta', horaacta);
      formData.append('fechaacta', fechaacta);
      
      axios.post(url+'add_acta', formData, {  
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
// mensaje cuando se crea una nueva acta
function mensajeResponse1(valor){
    if(valor.data.success == 1){
      toastr.success('Guardado', 'Acta creada exitosamente!');
      $('#modalGenerarActa').modal('hide'); 
      window.open("{{ URL::to('admin/pdf_acta') }}/" + valor.data.acta_id);
    }else if(valor.data.success == 2){
      toastr.error('Error', 'Orden NO guardada!');
    }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
    }
}
function imprimirActa(valor){
    console.log(valor);
    window.open("{{ URL::to('admin/pdf_acta') }}/" + valor);
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