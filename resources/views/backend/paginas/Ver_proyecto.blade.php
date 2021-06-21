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
            <div class="col-sm-6" style="margin-right: 10px;">
              <h1>Control Individual de Proyecto</h1>
            </div>
            <!--<div class="col-sm-1">
              <button type="button" onclick="imprimirPresupuesto()" class="btn btn-info btn-sm">
                <i class="fas fa-print"></i>
                Imprimir
              </button>
            </div>-->
            <div class="col-sm-2">
              <button type="button" onclick="abrirModalAgregarReq()" class="btn btn-success btn-sm">
                <i class="fas fa-pencil-alt"></i>
                Requisici&oacute;n
              </button>
            </div>
          </div>
        </div>
  </section>
    <!------------------ INFORMACION DE UN PROYECTO ESPECIFICO ---------------->
  <section class="content">
    <div class="col-sm-6 float-left">
      <div class="container-fluid">
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Datos del Proyecto</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          
          <div class="card-body">
            <div class="row">
              <div class="col-md-10">
              <table>
                <tr>
                  <td>Código: </td>
                  <td>{{ $proyecto-> codigo }}</td>
                </tr>
                <tr>
                  <td>Nombre: </td>
                  <td>{{ $proyecto-> nombre }}</td>
                </tr>
                <tr>
                  <td>Direcci&oacute;n: </td>
                  <td>{{ $proyecto-> ubicacion }}</td>
                </tr>
              </table>  
              </div>
            </div>          
          </div>
       </div>
      </div>
    </div>
    <!------------------ Requisiciones DEL PROYECTO INDIVIDUAL ---------------->
    <div class="col-sm-6 float-right">
      <div class="container-fluid">
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Requerimientos de Proyecto</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
            
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
              <table id="example1" class="table table-bordered table-hover">
                <thead>             
                  <tr>
                    <th style="width: 10%;">Num.</th>   
                    <th style="width: 15%;">Fecha</th>                            
                    <th style="width: 40%;">Opciones</th>                           
                  </tr>
                </thead>
                <tbody>
              
              @foreach($requisiciones as $req)  
                <tr>
                  <td>{{ $req-> id }}</td>
                  <td>{{ $req-> fecha }}</td> 
                  <td>
                  <center>
                  <a class="btn btn-warning btn-xs" href="{{ url('/admin/crear_cotizacion_vista/'.$req->id ) }}" target="frameprincipal">
                  <i class="fa fa-laptop" title="Editar"></i>&nbsp; Cotizar </a>
                    <button type="button" class="btn btn-info btn-xs" onclick="abrirModalEditar({{ $req->id }})">
                      <i class="fas fa-pencil-alt" title="Editar"></i>&nbsp; Editar
                    </button>
                    <!--<button type="button" class="btn btn-danger btn-xs" onclick="EliminarRequisicion({{ $req->id }})">
                      <i class="fas fa-trash" title="Editar"></i>&nbsp; Borrar
                    </button>-->
                  </center>                                                                                                   
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
    </div>
      <!-- Modal Agregar Requisicion -->
    <div class="modal fade" id="modalAgregar" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Agregar Requisicion de Proyecto</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formularion2">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">  
                        <label>Fecha:</label>   
                        <input style="width:50%;" type="date" class="form-control" id="fechan" name="fechan">
                    </div>
                  </div>
                </div>  
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                        <label>Item:</label>   
                        <input  type="text" class="form-control" id="itemn" name="itemn" value="{{ count($requisiciones) + 1 }}" readonly>
                        <input type="hidden" class="form-control" id="proyecto_idn" name="proyecto_idn" value="{{ $proyecto-> id }}">
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                        <label>Destino:</label>   
                        <input  type="text" class="form-control" id="destinon" name="destinon">
                    </div>
                  </div>
                </div>  
                <div class="row">
                  <div class="col-md-10">
                    <div class="form-group">
                      <label>Necesidad:</label>   
                      <textarea class="form-control" id="necesidadn" name="necesidadn" rows="2"></textarea>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <br>
                      <button type="button" onclick="abrirModalAgregarDet_Req(1)" class="btn btn-primary btn-sm float-right" style="margin-top:10px;">
                      <i class="fas fa-plus" title="Add"></i>&nbsp; Agregar</button>
                    </div>
                  </div> 
                </div>
                <div class="row">
                  <table  class="table" id="matriz"  data-toggle="table">
                    <thead>
                      <tr>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Descripci&oacute;n</th>
                        <th scope="col">Unidad Medida</th>
                        <th scope="col">Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                          
                    </tbody>
                  </table>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnGuardarU" onclick="enviarModalAgregarReq()">Guardar</button>
          </div>          
        </div>        
      </div>      
    </div>
     <!-- Modal Editar Requisicion -->
   <div class="modal fade" id="modalEditar">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Editar Requisicion</h4>
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
                          <label>Fecha:</label>   
                          <input style="width:50%;" type="date" class="form-control" id="fechap" name="fechap">
                      </div>
                    </div>
                  </div>  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <label>Num. Req.:</label>   
                          <input  type="text" class="form-control" id="nump" name="nump" readonly>
                          <input type="hidden" class="form-control" id="idU2" name="idU2">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <label>Destino:</label>   
                          <input style="width:50%;" type="text" class="form-control" id="destinop" name="destinop">
                      </div>
                    </div>
                  </div>  
                  <div class="row">
                    <div class="col-md-10">
                      <div class="form-group">
                        <label>Necesidad:</label>   
                        <textarea class="form-control" id="necesidadp" name="necesidadp" rows="2"></textarea>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <br><br>
                        <button type="button" onclick="abrirModalAgregarDet_Req(2)" class="btn btn-primary btn-xs float-right">
                        <i class="fas fa-plus" title="Add"></i>&nbsp; Agregar</button>
                      </div>
                    </div> 
                  </div>
                  <div class="row">
                    <table  class="table" id="matrizpar"  data-toggle="table">
                      <thead>
                        <tr>
                          <th scope="col">Cantidad</th>
                          <th scope="col">Descripci&oacute;n</th>
                          <th scope="col">Unidad Medida</th>
                          <th scope="col">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>   
                      </tbody>
                    </table>
                  </div>
                </div>
              </form>
            </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnGuardarU" onclick="enviarModalEditarReq()">Guardar</button>
          </div>          
        </div>        
      </div>      
    </div>
    <!-- Modal agregar detalle de Req -->
    <div class="modal fade" id="modalAgregarReq" style="margin-top:3%;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Agregar Detalle de Requisicion</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formularion3">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                        <label>Cantidad:</label>   
                        <input type="number" step="any" class="form-control" id="mcantidad" name="mcantidad">
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label>Unidad de Medida:</label> 
                      <select class="form-control" id="munidadmedida" name="munidadmedida">
                        <option value="" >Seleccione una opción</option>
                        <option value="unidad" >C/U</option>
                        <option value="mts." >mts.</option>
                      </select>
                    </div>
                  </div>
                </div>  
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label>Descripci&oacute;n:</label>   
                        <input type="text" class="form-control" id="mdescripcion" name="mdescripcion" >
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="add" value="" >Agregar</button>
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
// variable para borrar las filas de una requisicion
var todelete = [];

//*********************** Para darle tiempo al toaster al recargar la pagina */
    toastr.options.timeOut = 750;
    toastr.options.fadeOut = 750;
    toastr.options.onHidden = function(){
    // this will be executed after fadeout, i.e. 2secs after notification has been show
     window.location.reload();
    }; 
//****************************************************************************/
//Abrir modal Agregar Req
function abrirModalAgregarReq(){
    document.getElementById("formularion2").reset();   
    $('#matriz tbody').empty();
    $('#modalAgregar').css('overflow-y', 'auto');
    $('#modalAgregar').modal('show');   
}
//Guardar Req
function enviarModalAgregarReq(){
            var proyecto_id = document.getElementById('proyecto_idn').value;
            var destino = document.getElementById('destinon').value;
            var fecha = document.getElementById('fechan').value;
            var necesidad = document.getElementById('necesidadn').value;

            var cantidades = $("input[name='cantidad[]']").map(function(){return $(this).val();}).get();
            var unidades = $("input[name='unidadmedida[]']").map(function(){return $(this).val();}).get();
            var descripciones = $("input[name='descripcion[]']").map(function(){return $(this).val();}).get();

   
      var spinHandle = loadingOverlay().activate(); // activar loading
            
      let formData = new FormData();
      formData.append('proyecto_id', proyecto_id);
      formData.append('destino', destino);
      formData.append('fecha', fecha);
      formData.append('necesidad', necesidad);  
      for(var a = 0; a< descripciones.length; a++){
        formData.append('cantidad[]', cantidades[a]);
        formData.append('unidadmedida[]', unidades[a]);
        formData.append('descripcion[]', descripciones[a]);
      }    

      axios.post('/admin/add_requisicion', formData, {  
       })
       .then((response) => {	
         loadingOverlay().cancel(spinHandle); // cerrar loading            
        mensajeResponse3(response);
       })
       .catch((error) => {  
          loadingOverlay().cancel(spinHandle); // cerrar loading   
          toastr.error('Error', 'Datos incorrectos!');               
      }); 
}
//Abrir modal Agregar detalle Requisicion
function abrirModalAgregarDet_Req(m){
    document.getElementById("formularion3").reset();   
    if(m == 2){
      document.getElementById("add").value = 2;   
    } else {
      document.getElementById("add").value = 1;   
    }   
    $('#modalAgregarReq').modal('show');   
}
// abre el modal para editar una Requisicion
function abrirModalEditar(id){
  document.getElementById("formularioU2").reset();   
  $('#matrizpar tbody').empty();
  spinHandle = loadingOverlay().activate();
  axios.post('/admin/get_requisicion',{'id': id })
      .then((response) => {	
        loadingOverlay().cancel(spinHandle); // cerrar loading
        if(response.data.success = 1){
          $('#modalEditar').css('overflow-y', 'auto');
          $('#modalEditar').modal('show');
          $('#nump').val(response.data.requisicion.id);
          $('#idU2').val(response.data.requisicion.id);
          $('#destinop').val(response.data.requisicion.destino);    
          $('#fechap').val(response.data.requisicion.fecha);    
          $('#necesidadp').val(response.data.requisicion.necesidad);             
          
          var detrequisicion = response.data.datosdetalle;
          for (var i = 0; i < detrequisicion.length; i++) {
              var data = '<tr id="'+i+'"><td><input id="cantidad'+i+'" name="cantidad[]" class="form-control" type="number" step="any" value="'+detrequisicion[i].cantidad+'"></td>\n\
                              <td><input id="descripcion'+i+'" name="descripcion[]" class="form-control" type="text" value="'+detrequisicion[i].descripcion+'" ></td>\n\
                              <td><input id="unidadmedida'+i+'" name="unidadmedida[]" type="text" class="form-control" value="'+detrequisicion[i].unidadmedida+'"  ></td>\n\
                              <td><input id="id'+i+'" name="id[]" type="hidden" class="form-control" value="'+detrequisicion[i].id+'">\n\
                              <button class="btn btn-block btn-danger btn-xs" id="delete"">Borrar</button></td></tr>';    
                $("#matrizpar tbody").append(data);
                  }
                $("#matrizpar tbody").on("click", "#delete", function (ev) {
                  var $currentTableRow = $(ev.currentTarget).parents('tr')[0];
                  //agrego id eliminado a array
                  var trid = $(this).closest('tr').attr('id');
                    todelete.push(document.getElementById('id'+trid).value);
                    //elimino la fila
                    $currentTableRow.remove();
                });
        }else{ 
          toastr.error('Error', 'Requerimiento no encontrado'); 
        }
      })
        .catch((error) => {
          loadingOverlay().cancel(spinHandle); // cerrar loading
          toastr.error('Error');    
    });
  }
    //*********** guardar edicion de Requisicion con detalle de Req *****/ 
    function enviarModalEditarReq(){
            var destinop = document.getElementById('destinop').value;
            var fechap = document.getElementById('fechap').value;
            var necesidadp = document.getElementById('necesidadp').value;
            var id = document.getElementById('idU2').value;

            var cantidades = $("input[name='cantidad[]']").map(function(){return $(this).val();}).get();
            var descripciones = $("input[name='descripcion[]']").map(function(){return $(this).val();}).get();
            var unidadmedidas = $("input[name='unidadmedida[]']").map(function(){return $(this).val();}).get();
            var iddet = $("input[name='id[]']").map(function(){return $(this).val();}).get();

          var spinHandle = loadingOverlay().activate(); // activar loading
          //document.getElementById("btnGuardar").disabled = true;
                
          let formData = new FormData();
            formData.append('destinop', destinop);
            formData.append('fechap', fechap);
            formData.append('necesidadp', necesidadp);
            formData.append('id', id);
            formData.append('todelete[]', todelete);

          for(var a = 0; a< cantidades.length; a++){
            formData.append('cantidad[]', cantidades[a]);
            formData.append('descripcion[]', descripciones[a]);
            formData.append('unidadmedida[]', unidadmedidas[a]);
            formData.append('iddet[]', iddet[a]);
            }

          axios.post('/admin/update_requisicion', formData, {  
          })
          .then((response) => {	
            loadingOverlay().cancel(spinHandle); // cerrar loading            
            mensajeResponse4(response);
            //console.log(response);
          })
          .catch((error) => {  
              loadingOverlay().cancel(spinHandle); // cerrar loading   
              toastr.error('Error', 'Datos incorrectos!');               
          }); 
    }

// mensaje cuando se agrega una nueva requisicion
function mensajeResponse3(valor){
    if(valor.data.success == 1){
      toastr.success('Guardado', 'Requisicion Agregada exitosamente!');
      $('#modalAgregarReq').modal('hide'); 
    }else if(valor.data.success == 2){
      toastr.error('Error', 'Requisicion NO guardada!');
    }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
    }
}
// mensaje por edicion de partida
function mensajeResponse4(valor){
    if(valor.data.success == 1){
      toastr.success('Guardado', 'Requisicion actualizada exitosamente!');
      $('#modalEditar').modal('hide'); 
    }else if(valor.data.success == 2){
      toastr.error('Error', 'Requisicion NO guardada!');
    }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
    }
}
</script>

<script type="text/javascript">
//Script para Organizar la tabla de datos
    $(document).ready(function() {
      $('#example1').DataTable({
        "paging": true,
        "lengthChange": false,
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

<script type="text/javascript">
            $(document).ready(function () {
                $("#add").on("click", function () {
                  var quemodal = $(this).val();
                  if (quemodal == 2){  
                    var nFilas = $('#matrizpar >tbody >tr').length;
                  }else{
                    var nFilas = $('#matriz >tbody >tr').length;
                  }
                    nFilas = nFilas - 1;
                    //agrega las filas dinamicamente
                    var data = '<tr id="'+(nFilas+1)+'"><td><input id="cantidad'+(nFilas+1)+'" name="cantidad[]" class="form-control" type="number" step="any" value="'+$('#mcantidad').val()+'"></td>\n\
                                                        <td><input id="descripcion'+(nFilas+1)+'" name="descripcion[]" type="text" class="form-control" value="'+$('#mdescripcion').val()+'"></td>\n\
                                                        <td><input id="unidadmedida'+(nFilas+1)+'" name="unidadmedida[]" class="form-control" type="text" value="'+$('#munidadmedida').val()+'"></td>\n\
                                                        <td><button class="btn btn-block btn-danger btn-xs" id="delete">Borrar</button></td></tr>';    
                    if (quemodal == 2){
                      $("#matrizpar tbody").append(data); 
                    }else{
                      $("#matriz tbody").append(data);
                    }
                    $('#modalAgregarReq').modal('hide');
                });                

                $("#matriz tbody").on("click", "#delete", function (ev) {  
                      var $currentTableRow = $(ev.currentTarget).parents('tr')[0];
                      //elimino la fila
                      $currentTableRow.remove();
                    });
                  });
      </script>
@stop