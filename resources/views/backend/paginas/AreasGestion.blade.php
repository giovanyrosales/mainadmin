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
              <h1>Creaci&oacute;n de &Aacute;reas de Gesti&oacute;n</h1>
            </div>
            <div class="col-sm-2">
              <button type="button" onclick="abrirModalAgregar()" class="btn btn-info btn-sm">
              <i class="fas fa-pencil-alt"></i>
              Nueva &Aacute;rea de gesti&oacute;n
            </button>
          </div>
          </div>
        </div>
  </section>
    <!-- seccion frame -->
  <section class="content">
    <div class="container-fluid">
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">&Aacute;reas de Gesti&oacute;n</h3>

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
                  <th style="width: 20%;">C&oacute;digo</th>
                  <th style="width: 55%;">nombre</th>                      
                  <th style="width: 25%;">Opciones</th>                           
                </tr>
                </thead>
                <tbody>
                @foreach($areasgestion as $dato)
                <tr>
                  <td>{{ $dato->codigo }}</td>
                  <td>{{ $dato->nombre }}</td>      
                  <td>
                  <button type="button" class="btn btn-info btn-xs" onclick="abrirModalEditar({{ $dato->id }})">
                    <i class="fas fa-pencil-alt" title="Editar"></i>&nbsp; Editar
                    </button>

                    <button type="button" class="btn btn-danger btn-xs" onclick="abrirModalEliminar({{ $dato->id }})">
                    <i class="fas fa-trash-alt" title="Eliminar"></i>&nbsp; Eliminar
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
	
<!-- modal Agregar area de gestion -->
<div class="modal fade" id="modalAgregar">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Agregar nueva &Aacute;rea de Gesti&oacute;n</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formularion">
              <div class="card-body">
                <div class="row">  
                  <div class="col-md-6"> 
                    <div class="form-group">
                        <label>Linea de Trabajo:</label>   
                        <select class="form-control linea_idn" id="linea_idn" name="linea_idn">
                          @foreach($lineas as $sel)
                          <option value="{{ $sel->id }}">{{ $sel->codigo.' '.$sel->nombre}}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>C&oacute;digo:</label>   
                        <input type="text" class="form-control" id="codigon" name="codigon" placeholder="Codigo">
                    </div>
                    <div class="form-group">
                        <label>Nombre:</label>   
                        <input type="text" class="form-control" id="nombren" name="nombren" placeholder="Nombre">
                    </div>                   
                  </div>
                </div> 
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnGuardarU" onclick="enviarModalAgregar()">Guardar</button>
          </div>          
        </div>        
      </div>      
    </div>

   <!-- modal editar area de gestion -->
   <div class="modal fade" id="modalEditar">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Editar &Aacute;rea de Gesti&oacute;n</h4>
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
                        <label>Linea de Trabajo:</label>   
                        <select class="form-control linea_id" id="linea_id" name="linea_id">
                        @foreach($lineas as $sel)
                          <option value="{{ $sel->id }}">{{ $sel->codigo.' '.$sel->nombre}}</option>
                          @endforeach
                        </select>
                    </div>
                  <div class="form-group">
                      <label>C&oacute;digo:</label>   
                      <input type="text" class="form-control" id="codigo" name="codigo" >
                    </div>
                    <div class="form-group">
                      <label>Nombre del &Aacute;rea de Gesti&oacute;n:</label>
                      <input type="hidden" id="idU"  name="idU"/>   
                      <input type="text" class="form-control" id="nombre" name="nombre" >
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

     <!-- modal eliminar -->
  <div class="modal fade" id="modalEliminar">
      <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Eliminar &Aacute;rea de gesti&oacute;n</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
                  <div class="modal-body">
                    <input type="hidden" id="idD" name="idD"/> <!-- id del area de gestion para borrarlo -->                           
                  </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>             
              <button class="btn btn-danger" id="btnBorrar" type="button" onclick="borrarareagestion()">Borrar</button>
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

// abre el modal para editar una area de gestion
function abrirModalEditar(id){
  document.getElementById("formularioU").reset();   
  spinHandle = loadingOverlay().activate();
  axios.post(url+'get_areagestion',{'id': id })
      .then((response) => {	
        loadingOverlay().cancel(spinHandle); // cerrar loading
        if(response.data.success = 1){
          $('#modalEditar').modal('show');
          $('#idU').val(response.data.areagestion.id);
          $('#linea_id').val(response.data.areagestion.linea_id);    
          $('#nombre').val(response.data.areagestion.nombre);    
          $('#codigo').val(response.data.areagestion.codigo);   
        }else{ 
          toastr.error('Error', 'Area de gestion no encontrada'); 
        }
      })
      .catch((error) => {
        loadingOverlay().cancel(spinHandle); // cerrar loading
        toastr.error('Error');    
  });
}

function abrirModalAgregar(){
    document.getElementById("formularion").reset();   
    $('#modalAgregar').modal('show');   
}

    // editar areas de gestion
function enviarModalEditar(){
  var linea_id = document.getElementById('linea_id').value;
          var nombre = document.getElementById('nombre').value;
            var codigo = document.getElementById('codigo').value;
            var id = document.getElementById('idU').value;

   
      var spinHandle = loadingOverlay().activate(); // activar loading
            
      let formData = new FormData();
      formData.append('linea_id', linea_id);
      formData.append('nombre', nombre);
      formData.append('codigo', codigo);
      formData.append('id', id);
      

      axios.post(url+'update_areagestion', formData, {  
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

    // guardar nueva area de gestion
    function enviarModalAgregar(){
            var linea_id = document.getElementById('linea_idn').value;
            var nombre = document.getElementById('nombren').value;
            var codigo = document.getElementById('codigon').value;

   
      var spinHandle = loadingOverlay().activate(); // activar loading
            
      let formData = new FormData();
      formData.append('linea_id', linea_id);
      formData.append('nombre', nombre);
      formData.append('codigo', codigo);

      axios.post(url+'add_areagestion', formData, {  
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

// mensaje cuando se guardan las areas de gestion
function mensajeResponse2(valor){
  if(valor.data.success == 1){
    toastr.success('Guardado', 'Se han guardado los cambios en el area de gestion!');
    $('#modalEditar').modal('hide'); 
  }else if(valor.data.success == 2){
    toastr.error('Error', 'Cambios no guardados!');
  }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
  }
}
// mensaje cuando se guardan las areas de gestion
function mensajeResponse1(valor){
  if(valor.data.success == 1){
    toastr.success('Guardado', 'Se ha guardado la nueva area de gestion!');
    $('#modalAgregar').modal('hide'); 
  }else if(valor.data.success == 2){
    toastr.error('Error', 'Cuenta NO guardada!');
  }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
  }
}

// abre el modal para eliminar una area de gestion
function abrirModalEliminar(id){     
  $('#modalEliminar').modal('show');
  $('#idD').val(id);    
}

// enviar peticion para borrar  una ara de gestion
function borrarareagestion(){
  id = document.getElementById("idD").value;
  spinHandle = loadingOverlay().activate(); // mostrar loading

  axios.post(url+'delete_areagestion',{
    'id': id  
      })
      .then((response) => {	
        loadingOverlay().cancel(spinHandle); // cerrar loading

        if(response.data.success == 1){
          toastr.success('Area de gestion Eliminado!')
          $('#modalEliminar').modal('hide');   
        }else{
          toastr.error('Error', 'No se pudo eliminar el area de gestion');  
        }           
      })
      .catch((error) => {
        loadingOverlay().cancel(spinHandle); // cerrar loading   
        toastr.error('Error');               
  });
}

//Select con buscardor (select2)
jQuery(document).ready(function($){
    $(document).ready(function() {
        $('.linea_id').select2();
        $('.linea_idn').select2();
    });
});
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