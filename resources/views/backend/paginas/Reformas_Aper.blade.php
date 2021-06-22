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
              <h1>Proyectos Registrados</h1>
            </div>

          </div>
        </div>
  </section>
    <!-- seccion frame -->
  <section class="content">
    <div class="container-fluid">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Proyectos</h3>

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
                    <th style="width: 10%;">C&oacute;digo</th>
                    <th style="width: 45%;">Nombre</th>
                    <th style="width: 10%;">Fecha Inicio</th>    
                    <th style="width: 15%;">Encargado</th>                           
                    <th style="width: 20%;"><center>Opciones</center></th>                           
                  </tr>
                </thead>
                <tbody>
              @foreach($proyectos as $datos)  
                @if($datos->estado == 2)  
                  <tr class="table-success">
                    @elseif($datos->estado == 1)  
                    <tr class="table-info">
                    @elseif($datos->estado == 3)  
                    <tr class="table-warning">
                    @elseif($datos->estado == 4)  
                    <tr class="table-secondary">
                    @elseif($datos->estado == NULL)
                    <tr>
                  @endif
                  <td>{{ $datos-> codigo }}</td>
                  <td>{{ $datos-> nombre }}</td>
                  <td>{{ $datos-> fechaini }}</td>
                  <td>{{ $datos-> encargado }}</td>          
                  <td>
                  @if( $datos->estado == "2" )
                    <a class="btn btn-warning btn-xs" href="{{ url('pdf_rep_comprasal/'.$datos->id ) }}" target="_blank">
                    <i class="fa fa-eye" title="Generar"></i>&nbsp; Comprasal </a>
                   @else
                    <a class="btn btn-success btn-xs" href="{{ url('pdf_reforma_apertura/'.$datos->id ) }}" target="_blank">
                    <i class="fa fa-eye" title="Generar"></i>&nbsp; Generar Reforma </a>
                  @endif
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

   <!-- modal editar servicio -->
   <div class="modal fade" id="modalEditar">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Editar Informaci&oacute;n de Proyecto</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formularioU">
              <div class="card-body">
                <div class="row">  
                  <div class="col-md-6"> 
                    <div class="form-group">
                      <label>Nombre:</label>
                      <input type="hidden" id="idU"  name="idU"/><!-- id del tipo-->      
                      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del Tipo Servicio">
                    </div>
                    <div class="form-group">
                      <label>Descripción:</label>   
                      <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion">
                    </div>
                    <div class="form-group">
                      <label>Precio:</label>   
                      <input type="number" step="any" class="form-control" id="precio" name="precio" placeholder="$">
                    </div>
                  </div>
                </div> 
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnGuardarU" onclick="enviarModalEditar()">Guardar</button>
          </div>          
        </div>        
      </div>      
    </div>
     <!-- Modal Generar Reportes de Comprasal -->
     <div class="modal fade" id="modalGen">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Generar Reportes</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="formularioU2">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6"> 
                      <div class="form-group">
                        <label>Tipo de Reporte:</label>   
                        <textarea class="form-control" id="tipo" name="tipo" rows="2"></textarea>
                      </div> 
                    </div>  
                    <div class="col-md-2">
                      <div class="form-group">
                        <br><br>
                        <button type="button" onclick="abrirModalAgregarMate(2)" class="btn btn-primary btn-xs float-right">
                        <i class="fas fa-plus" title="Add"></i>&nbsp; Agregar</button>
                      </div>
                    </div> 
                  </div>
                </div>
              </form>
            </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnGuardarU" onclick="enviarModalEditarPar()">Guardar</button>
          </div>          
        </div>        
      </div>      
    </div>
     <!-- modal eliminar -->
  <div class="modal fade" id="modalEliminar">
      <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Eliminar Servicio</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
                  <div class="modal-body">
                    <input type="hidden" id="idD" name="idD"/> <!-- id del servicio para borrarlo-->                           
                  </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>             
              <button class="btn btn-danger" id="btnBorrar" type="button" onclick="borrarServicio()">Borrar</button>
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

  // abre el modal para editar el servicio
  function abrirModalEditar(id){
    document.getElementById("formularioU").reset();   
    spinHandle = loadingOverlay().activate();
    axios.post(url+'infoservicios',{'id': id })
        .then((response) => {	
          loadingOverlay().cancel(spinHandle); // cerrar loading
          if(response.data.success = 1){
            $('#modalEditar').modal('show');
            $('#idU').val(response.data.servicio.id);
            $('#nombre').val(response.data.servicio.nombreservicio);    
            $('#descripcion').val(response.data.servicio.descripcion);  
            $('#precio').val(response.data.servicio.precio);
            $('#tiposervicio').val(response.data.servicio.tiposervicio_id);    
          }else{ 
            toastr.error('Error', 'Servicio no encontrado'); 
          }
        })
        .catch((error) => {
          loadingOverlay().cancel(spinHandle); // cerrar loading
          toastr.error('Error');    
    });
  }


    // guardar resultados de orina
    function enviarModalEditar(){
          var tiposervicio = document.getElementById('tiposervicio').value;
            var nombre = document.getElementById('nombre').value;
            var descripcion = document.getElementById('descripcion').value;
            var precio = document.getElementById('precio').value;
            var id = document.getElementById('idU').value;

   
      var spinHandle = loadingOverlay().activate(); // activar loading
      //document.getElementById("btnGuardar").disabled = true;
            
      let formData = new FormData();
      formData.append('tiposervicio', tiposervicio);
      formData.append('nombre', nombre);
      formData.append('descripcion', descripcion);
      formData.append('precio', precio);
      formData.append('id', id);
      

      axios.post(url+'update_servicios', formData, {  
       })
       .then((response) => {	
         loadingOverlay().cancel(spinHandle); // cerrar loading            
        mensajeResponse2(response);
       })
       .catch((error) => {  
          loadingOverlay().cancel(spinHandle); // cerrar loading   
          toastr.error('Error', 'Datos incorrectos!');               
      }); 
}

  
  // mensaje cuando se guardan los resultados de orina
  function mensajeResponse2(valor){
    if(valor.data.success == 1){
      toastr.success('Guardado', 'Se han guardado los cambios!');
      $('#modalEditar').modal('hide'); 
    }else if(valor.data.success == 2){
      toastr.error('Error', 'Cambios no guardados!');
    }else{
      // error en validacion en servidor
      toastr.error('Error', 'Datos incorrectos!');
    }
  }

  // abre el modal para eliminar slider
  function abrirModalEliminar(id){     
    $('#modalEliminar').modal('show');
    $('#idD').val(id);    
  }

  // enviar peticion para borrar el servicio
  function borrarServicio(){
    id = document.getElementById("idD").value;
    spinHandle = loadingOverlay().activate(); // mostrar loading

    axios.post(url+'deleteservicio',{
      'id': id  
        })
        .then((response) => {	
          loadingOverlay().cancel(spinHandle); // cerrar loading

          if(response.data.success == 1){
            toastr.success('Servicio Eliminado!')
            $('#modalEliminar').modal('hide');   
          }else{
            toastr.error('Error', 'No se pudo eliminar el Servicio');  
          }           
        })
        .catch((error) => {
          loadingOverlay().cancel(spinHandle); // cerrar loading   
          toastr.error('Error');               
    });
  }
  </script>

  <script type="text/javascript">
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