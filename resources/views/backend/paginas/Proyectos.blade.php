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
                  <th style="width: 20%;">Opciones</th>                           
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
                  <a class="btn btn-warning btn-xs" href="{{ url('/admin/ver_proyecto/'.$datos->id ) }}" target="frameprincipal">
                  <i class="fa fa-eye" title="Editar"></i>&nbsp; Ver </a>
                  <button type="button" class="btn btn-info btn-xs" onclick="abrirModalEditar({{ $datos->id }})">
                    <i class="fas fa-pencil-alt" title="Editar"></i>&nbsp; Editar
                    </button>
                    <button type="button" class="btn btn-success btn-xs" onclick="abrirModalEliminar({{ $datos->id }})">
                    <i class="fas fa-trash-alt" title="Imprimir"></i>&nbsp; Imprimir
                    </button>
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

   <!-- modal editar Proyecto -->
   <div class="modal fade" id="modalEditar">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Editar Informaci&oacute;n del Proyecto</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="formularioU">
                <div class="card card-info">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>C&oacute;digo:</label>
                          <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Codigo de proyecto" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Nombre:</label>
                          <input type="hidden" id="idU"  name="idU"/> <!-- id del tipo-->   
                          <input type="text" name="nombre" id="nombre" class="form-control" required placeholder="nombre del proyecto" value="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Ubicaci&oacute;n:</label>
                          <input type="text" name="ubicacion" id="ubicacion" required placeholder="Direccion" class="form-control" value="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Naturaleza:</label>
                          <select name="naturaleza" id="naturaleza" class="form-control">
                            <option value="privativo">Privativo</option>
                            <option value="desarrollosocial">Desarrollo Social</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>&Aacute;rea de Gesti&oacute;n:</label>   
                          <select class="form-control areagestion" name="areagestion" id="areagestion">
                            @foreach($areasgestion as $sel1)
                            <option value="{{ $sel1->id }}">{{ $sel1->codigo.' '.$sel1->nombre}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Linea de Trabajo:</label>   
                          <select class="form-control linea" name="linea" id="linea" >
                            @foreach($lineas as $sel2)
                            <option value="{{ $sel2->id }}">{{ $sel2->codigo.' '.$sel2->nombre}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Fuente de Financiamiento:</label>
                          <select name="fuentef" id="fuentef" class="form-control fuentef">
                            @foreach($fuentesf as $sel3)
                            <option value="{{ $sel3->id }}">{{ $sel3->codigo.' '.$sel3->nombre}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Fuente de Recursos:</label>
                          <select name="fuenter" id="fuenter" class="form-control fuenter">
                            @foreach($fuentesr as $sel4)
                            <option value="{{ $sel4->id }}">{{ $sel4->codigo.' '.$sel4->nombre}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Contraparte:</label>
                          <input type="text" name="contraparte" id="contraparte" placeholder="Contraparte" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>C&oacute;digo Contable:</label>
                          <input type="text" name="codcontable" id="codcontable" class="form-control" value="">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label>Fecha de Inicio:</label>
                          <input type="date" name="fechaini" id="fechaini" class="form-control" value="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Acuerdo Apertura:</label>
                          <input type="file" name="acuerdoapertura" id="acuerdoapertura"  class="form-control" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Ejecutor:</label>
                          <input type="text" name="ejecutor" id="ejecutor" placeholder="Nombre de Ejecutor de la Obra" class="form-control" value="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Formulador:</label>
                          <input type="text" name="formulador" id="formulador"  placeholder="Nombre de formulador" class="form-control" value="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Supervisor:</label>
                          <input type="text" name="supervisor" id="supervisor" placeholder="Nombre de Supervisor" class="form-control" value="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Encargado:</label>
                          <input type="text" name="encargado" id="encargado"  placeholder="Nombre de Encargado" class="form-control" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <hr>
                          <label>Secci&oacute;n de Prespuesto:</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Cuenta Bols&oacute;n:</label>
                          <select name="bolson_id" id="bolson_id" class="form-control bolson_id">
                            @foreach($bolsones as $bol1)
                            <option value="{{ $bol1->id }}">{{ $bol1->nombre}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Monto de proyecto $:</label>
                          <input type="number" name="monto" id="monto"  class="form-control" step="any" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <hr>
                          <label>Secci&oacute;n de UACI:</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                        <label>Estado del Proyecto:</label>
                          <select name="estado" id="estado" class="form-control">
                            <option value="1">Priorizado</option>
                            <option value="2">Iniciado</option>
                            <option value="3">En Pausa</option>
                            <option value="4">Finalizado</option>
                          </select>
                        </div>
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

     <!-- modal eliminar Proyecto (Solo si no hay bitacoras, presupuestos, cuentasproy, movibolson, movicuentasproy)-->
  <div class="modal fade" id="modalEliminar">
      <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Eliminar Proyecto</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
                  <div class="modal-body">
                    <input type="hidden" id="idD" name="idD"/> <!-- id del Proyecto para borrarlo-->                           
                  </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>             
              <button class="btn btn-danger" id="btnBorrar" type="button" onclick="borrarproyecto()">Eliminar</button>
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

// abre el modal para editar el proyecto
function abrirModalEditar(id){
  document.getElementById("formularioU").reset();   
  spinHandle = loadingOverlay().activate();
  axios.post('get_proyecto',{'id': id })
      .then((response) => {	
        loadingOverlay().cancel(spinHandle); // cerrar loading
        if(response.data.success = 1){
          $('#modalEditar').modal('show');
          $('#idU').val(response.data.proyecto.id);
          $('#nombre').val(response.data.proyecto.nombre);   
          $('#ubicacion').val(response.data.proyecto.ubicacion);   
          $('#naturaleza').val(response.data.proyecto.naturaleza);   
          $('#areagestion').val(response.data.proyecto.areagestion);   
          $('#linea').val(response.data.proyecto.linea);   
          $('#fuentef').val(response.data.proyecto.fuentef);    
          $('#fuenter').val(response.data.proyecto.fuenter);   
          $('#contraparte').val(response.data.proyecto.contraparte);   
          $('#codcontable').val(response.data.proyecto.codcontable);   
          $('#fechaini').val(response.data.proyecto.fechaini);   
          $('#ejecutor').val(response.data.proyecto.ejecutor);   
          $('#formulador').val(response.data.proyecto.formulador);   
          $('#supervisor').val(response.data.proyecto.supervisor);   
          $('#encargado').val(response.data.proyecto.encargado);   
          $('#bolson_id').val(response.data.proyecto.bolson_id);   
          $('#monto').val(response.data.proyecto.monto); 
          $('#estado').val(response.data.proyecto.estado);   
        }else{ 
          toastr.error('Error', 'Proyecto no encontrado'); 
        }
      })
      .catch((error) => {
        loadingOverlay().cancel(spinHandle); // cerrar loading
        toastr.error('Error');    
  });
}


    // guardar cambios en la informacion del proyecto
function enviarModalEditar(){
            var id = document.getElementById('idU').value;
            var codigo = document.getElementById('codigo').value;
            var nombre = document.getElementById('nombre').value;
            var ubicacion = document.getElementById('ubicacion').value;
            var naturaleza = document.getElementById('naturaleza').value;
            var areagestion = document.getElementById('areagestion').value;
            var linea = document.getElementById('linea').value;
            var fuentef = document.getElementById('fuentef').value;
            var fuenter = document.getElementById('fuenter').value;
            var contraparte = document.getElementById('contraparte').value;
            var codcontable = document.getElementById('codcontable').value;
            var fechaini = document.getElementById('fechaini').value;
            var ejecutor = document.getElementById('ejecutor').value;
            var formulador = document.getElementById('formulador').value;
            var supervisor = document.getElementById('supervisor').value;
            var encargado = document.getElementById('encargado').value;
            var bolson_id = document.getElementById('bolson_id').value;
            var monto = document.getElementById('monto').value;
            

   
      var spinHandle = loadingOverlay().activate(); // activar loading
      //document.getElementById("btnGuardar").disabled = true;
            
      let formData = new FormData();
      formData.append('codigo', codigo);
      formData.append('nombre', nombre);
      formData.append('ubicacion', ubicacion);
      formData.append('naturaleza', naturaleza);
      formData.append('areagestion', areagestion);
      formData.append('linea', linea);
      formData.append('fuentef', fuentef);
      formData.append('fuenter', fuenter);
      formData.append('contraparte', contraparte);
      formData.append('codcontable', codcontable);
      formData.append('fechaini', fechaini);
      formData.append('ejecutor', ejecutor);
      formData.append('formulador', formulador);
      formData.append('supervisor', supervisor);
      formData.append('encargado', encargado);
      formData.append('bolson_id', bolson_id);
      formData.append('monto', monto);
      formData.append('id', id);
      

      axios.post('update_proyecto', formData, {  
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

  
// mensaje cuando se guardan los cambios en Proyecto
function mensajeResponse2(valor){
  if(valor.data.success == 1){
    toastr.success('Guardado', 'Se han guardado los cambios!');
    $('#modalEditar').modal('hide'); 
  }else if(valor.data.success == 2){
    toastr.error('Error', 'Cambios no guardados, no se encontro proyecto!');
  }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!!!');
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

  axios.post('/admin/deleteservicio',{
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