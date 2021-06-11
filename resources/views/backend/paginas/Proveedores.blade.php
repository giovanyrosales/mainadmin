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
              <h1>Base de Proveedores</h1>
            </div>
            <div class="col-sm-2">
              <button type="button" onclick="abrirModalAgregar()" class="btn btn-info btn-sm">
              <i class="fas fa-pencil-alt"></i>
             Agregar
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
            <h3 class="card-title">Proveedores</h3>

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
                  <th style="width: 35%;">Nombre</th>
                  <th style="width: 20%;">Telefono</th>   
                  <th style="width: 20%;">NRC</th>                      
                  <th style="width: 25%;">Opciones</th>                           
                </tr>
                </thead>
                <tbody>
                @foreach($proveedores as $dato)
                <tr>
                  <td>{{ $dato->nombre }}</td>
                  <td>{{ $dato->telefono }}</td>
                  <td>{{ $dato->nrc }}</td>      
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
	
<!-- modal Agregar Proveedor -->
<div class="modal fade" id="modalAgregar">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Agregar nuevo Proveedor</h4>
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
                      <label>Nombre:</label>   
                      <input type="text" class="form-control" id="nombren" name="nombren" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                      <label>Tel&eacute;fono:</label>   
                      <input type="text" class="form-control" id="telefonon" name="telefonon" placeholder="Telefono">
                    </div>   
                    <div class="form-group">
                      <label>NIT:</label>   
                      <input type="text" class="form-control" id="nitn" name="nitn" placeholder="Nit">
                    </div>
                    <div class="form-group">
                      <label>NRC:</label>   
                      <input type="text" class="form-control" id="nrcn" name="nrcn" placeholder="NRC">
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

   <!-- modal editar proveedor-->
   <div class="modal fade" id="modalEditar">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Editar Proveedor</h4>
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
                      <input type="text" class="form-control" id="nombre" name="nombre" >
                    </div>
                    <div class="form-group">
                      <label>Tel&eacute;fono:</label>
                      <input type="hidden" id="idU"  name="idU"/>   
                      <input type="text" class="form-control" id="telefono" name="telefono" >
                    </div>
                    <div class="form-group">
                      <label>NIT:</label>   
                      <input type="text" class="form-control" id="nit" name="nit" >
                    </div>
                    <div class="form-group">
                      <label>NRC:</label>   
                      <input type="text" class="form-control" id="nrc" name="nrc" >
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
              <h4 class="modal-title">Eliminar Proveedor</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
                  <div class="modal-body">
                    <input type="hidden" id="idD" name="idD"/> <!-- id del codigo para borrarlo-->                           
                  </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>             
              <button class="btn btn-danger" id="btnBorrar" type="button" onclick="borrarproveedor()">Borrar</button>
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

// abre el modal para editar los proveedores
function abrirModalEditar(id){
  document.getElementById("formularioU").reset();   
  spinHandle = loadingOverlay().activate();
  axios.post('get_proveedor',{'id': id })
      .then((response) => {	
        loadingOverlay().cancel(spinHandle); // cerrar loading
        if(response.data.success = 1){
          $('#modalEditar').modal('show');
          $('#idU').val(response.data.proveedor.id);
          $('#nombre').val(response.data.proveedor.nombre);    
          $('#telefono').val(response.data.proveedor.telefono);
          $('#nit').val(response.data.proveedor.nit);
          $('#nrc').val(response.data.proveedor.nrc);   
        }else{ 
          toastr.error('Error', 'Proveedor no encontrado'); 
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

    // editar proveedores
function enviarModalEditar(){
          var nombre = document.getElementById('nombre').value;
            var telefono = document.getElementById('telefono').value;
            var nit = document.getElementById('nit').value;
            var nrc = document.getElementById('nrc').value;
            var id = document.getElementById('idU').value;

   
      var spinHandle = loadingOverlay().activate(); // activar loading
            
      let formData = new FormData();
      formData.append('nombre', nombre);
      formData.append('telefono', telefono);
      formData.append('nit', nit);
      formData.append('nrc', nrc);
      formData.append('id', id);
      

      axios.post('update_proveedor', formData, {  
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

    // guardar nuevo proveedor
    function enviarModalAgregar(){
            var nombre = document.getElementById('nombren').value;
            var telefono = document.getElementById('telefonon').value;
            var nit = document.getElementById('nitn').value;
            var nrc = document.getElementById('nrcn').value;

   
      var spinHandle = loadingOverlay().activate(); // activar loading
            
      let formData = new FormData();
      formData.append('nombre', nombre);
      formData.append('telefono', telefono);
      formData.append('nit', nit);
      formData.append('nrc', nrc);

      axios.post('add_proveedor', formData, {  
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

// mensaje cuando se guardan los proveedores
function mensajeResponse2(valor){
  if(valor.data.success == 1){
    toastr.success('Guardado', 'Se han guardado los cambios en el proveedor');
    $('#modalEditar').modal('hide'); 
  }else if(valor.data.success == 2){
    toastr.error('Error', 'Cambios no guardados!');
  }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
  }
}
// mensaje cuando se guardan los proveedores
function mensajeResponse1(valor){
  if(valor.data.success == 1){
    toastr.success('Guardado', 'Se ha guardado el nuevo proveedor');
    $('#modalAgregar').modal('hide'); 
  }else if(valor.data.success == 2){
    toastr.error('Error', 'Proveedor NO guardada!');
  }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
  }
}

// abre el modal para eliminar proveedor
function abrirModalEliminar(id){     
  $('#modalEliminar').modal('show');
  $('#idD').val(id);    
}

// enviar peticion para borrar el proveedor
function borrarproveedor(){
  id = document.getElementById("idD").value;
  spinHandle = loadingOverlay().activate(); // mostrar loading

  axios.post('delete_proveedor',{
    'id': id  
      })
      .then((response) => {	
        loadingOverlay().cancel(spinHandle); // cerrar loading

        if(response.data.success == 1){
          toastr.success('Proveedor Eliminado')
          $('#modalEliminar').modal('hide');   
        }else{
          toastr.error('Error', 'No se pudo eliminar el proveedor');  
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