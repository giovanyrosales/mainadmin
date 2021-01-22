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
            <div class="col-sm-4">
              <h1>Cat&aacute;logo de Materiales</h1>
            </div>
            <div class="col-sm-2">
              <button type="button" onclick="abrirModalAgregar()" class="btn btn-info btn-sm">
                <i class="fas fa-pencil-alt"></i>
                Nuevo Material
              </button>
            </div>
          </div>
        </div>
  </section>
    <!-- seccion frame -->
  <section class="content">
    <div class="container-fluid">
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Cat&aacute;logo</h3>

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
                  <th style="width: 15%;">C&oacute;digo</th>
                  <th style="width: 50%;">Nombre</th>    
                  <th style="width: 15%;">Unidad</th>                      
                  <th style="width: 25%;">Opciones</th>                           
                </tr>
                </thead>
                <tbody>
                @foreach($materiales as $dato)
                <tr>
                  <td>{{ $dato->cod }}</td>
                  <td>{{ $dato->nombre }}</td>  
                  <td>{{ $dato->unidad }}</td>      
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
	
    <!-- modal Agregar Nuevo material al catalogo -->
    <div class="modal fade" id="modalAgregar">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Agregar nuevo material</h4>
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
                      <label>C&oacute;digo:</label>   
                      <select style="width: 50%;" class="form-control codn" id="codn" name="codn">
                          <option value="">Seleccione una Opción</option>
                          @foreach($cuentas as $sel)
                          <option value="{{ $sel->id }}">{{ $sel->codigo.' '.$sel->nombre }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Nombre:</label>   
                      <input type="text" class="form-control" id="nombren" name="nombren" placeholder="Nombre del material">
                    </div>  
                  </div>
                </div>   
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Unidad de Medida:</label>  
                      <br> 
                      <select width="60%"  class="form-control unidadn" id="unidadn" name="unidadn">
                        <option value="mts">Metros</option>
                        <option value="plg">Pulgadas</option>
                        <option value="m3">Metros C&uacute;bicos</option>
                        <option value="m2">Metros Cuadrados</option>
                        <option value="gln">Galones</option>
                        <option value="qq">Quintales</option>
                        <option value="lb">Libras</option>
                        <option value="vrs">Varas</option>
                        <option value="bls">Bolsas</option>
                        <option value="h-m">Hora M&aacute;quina</option>
                        <option value="pzs">Piezas</option>
                        <option value="varilla">Varillas</option>
                        <option value="und">Unidad</option>
                        <option value="pliego">Pliego</option>
                        <option value="yrds">Yarda</option>
                        <option value="pliego">Pliego</option>
                        <option value="dia">D&iacute;as</option>                                        
                      </select>           
                    </div>   
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Precio Unitario:</label>   
                      <input type="number" class="form-control" id="pun" name="pun" step="any">
                    </div> 
                  </div>  
                </div>
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                        <label>Clasificaci&oacute;n:</label>   
                        <select  class="form-control clasificacionn" id="clasificacionn" name="clasificacionn">
                          <option value="materiales">Materiales</option>
                          <option value="herramienta">Herramienta</option>
                          <option value="alquiler_maquinaria">Alquiler de Maquina</option>
                          <option value="mano_de_obra">Mano de Obra</option>
                          <option value="transporte">Transporte</option>
                          <option value="aporte_patronal">Aporte Patronal</option>
                        </select>
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

    <!-- modal editar informacion de material -->
    <div class="modal fade" id="modalEditar">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Editar Material Registrado</h4>
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
                      <label>C&oacute;digo:</label>   
                      <select class="form-control cod" id="cod" name="cod">
                      @foreach($cuentas as $sel)
                          <option value="{{ $sel->id }}">{{ $sel->codigo.' '.$sel->nombre }}</option>
                      @endforeach
                      </select>
                      <input type="hidden" id="idU"  name="idU"/> 
                    </div>
                    <div class="form-group">
                      <label>Nombre:</label>   
                      <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>  
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Unidad de Medida:</label>   
                      <select  class="form-control unidad" id="unidad" name="unidad">
                        <option value="mts">Metros</option>
                        <option value="plg">Pulgadas</option>
                        <option value="m3">Metros C&uacute;bicos</option>
                        <option value="m2">Metros Cuadrados</option>
                        <option value="gln">Galones</option>
                        <option value="qq">Quintales</option>
                        <option value="lb">Libras</option>
                        <option value="vrs">Varas</option>
                        <option value="bls">Bolsas</option>
                        <option value="h-m">Hora M&aacute;quina</option>
                        <option value="pzs">Piezas</option>
                        <option value="varilla">Varillas</option>
                        <option value="und">Unidad</option>
                        <option value="pliego">Pliego</option>
                        <option value="yrds">Yarda</option>
                        <option value="pliego">Pliego</option>
                        <option value="dia">D&iacute;as</option>
                      </select>
                    </div>   
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Precio Unitario:</label>   
                      <input type="number" class="form-control" id="pu" name="pu" step="any">
                    </div>  
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Clasificaci&oacute;n:</label>   
                      <select  class="form-control clasificacion" id="clasificacion" name="clasificacion">
                        <option value="materiales">Materiales</option>
                        <option value="herramienta">Herramienta</option>
                        <option value="alquiler_maquinaria">Alquiler de Maquina</option>
                        <option value="mano_de_obra">Mano de Obra</option>
                        <option value="transporte">Transporte</option>
                        <option value="aporte_patronal">Aporte Patronal</option>
                      </select>
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
              <h4 class="modal-title">Eliminar Material</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
                  <div class="modal-body">
                    <input type="hidden" id="idD" name="idD"/> <!-- id del material para borrarlo-->                           
                  </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>             
              <button class="btn btn-danger" id="btnBorrar" type="button" onclick="borrar()">Borrar</button>
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

// abre el modal para editar un material
function abrirModalEditar(id){
  document.getElementById("formularioU").reset();   
  spinHandle = loadingOverlay().activate();
  axios.post('get_material',{'id': id })
      .then((response) => {	
        loadingOverlay().cancel(spinHandle); // cerrar loading
        if(response.data.success = 1){
          $('#modalEditar').modal('show');
          $('#idU').val(response.data.material.id);
          $('#cod').val(response.data.material.cod);   
          $('#nombre').val(response.data.material.nombre);   
          $('#unidad').val(response.data.material.unidad);   
          $('#pu').val(response.data.material.pu);   
          $('#clasificacion').val(response.data.material.clasificacion);    
        }else{ 
          toastr.error('Error', 'Material no encontrado'); 
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

    // enviar peticion para editar los datos de un material
function enviarModalEditar(){
          var id = document.getElementById('idU').value;
          var cod = document.getElementById('cod').value;
          var nombre = document.getElementById('nombre').value;
          var unidad = document.getElementById('unidad').value;
          var pu = document.getElementById('pu').value;
          var clasificacion = document.getElementById('clasificacion').value;

   
      var spinHandle = loadingOverlay().activate(); // activar loading
            
      let formData = new FormData();
      formData.append('cod', cod);
      formData.append('nombre', nombre);
      formData.append('unidad', unidad);
      formData.append('pu', pu);
      formData.append('clasificacion', clasificacion);
      formData.append('id', id);
      

      axios.post('update_material', formData, {  
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

    // guardar nuevo material
    function enviarModalAgregar(){
            var cod = document.getElementById('codn').value;
            var nombre = document.getElementById('nombren').value;
            var unidad = document.getElementById('unidadn').value;
            var pu = document.getElementById('pun').value;
            var clasificacion = document.getElementById('clasificacionn').value;

   
      var spinHandle = loadingOverlay().activate(); // activar loading
            
      let formData = new FormData();
      formData.append('cod', cod);
      formData.append('nombre', nombre);
      formData.append('unidad', unidad);
      formData.append('pu', pu);
      formData.append('clasificacion', clasificacion);

      axios.post('add_material', formData, {  
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

// mensaje cuando se guardan los cambios en un material
function mensajeResponse2(valor){
  if(valor.data.success == 1){
    toastr.success('Guardado', 'Se ha actualizado la informacion del material!');
    $('#modalEditar').modal('hide'); 
  }else if(valor.data.success == 2){
    toastr.error('Error', 'Material Actualizado!');
  }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
  }
}
// mensaje cuando se guardan los codigos presupuestarios
function mensajeResponse1(valor){
  if(valor.data.success == 1){
    toastr.success('Guardado', 'Se ha agregado el material exitosamente!');
    $('#modalAgregar').modal('hide'); 
  }else if(valor.data.success == 2){
    toastr.error('Error', 'Material NO guardada!');
  }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
  }
}

// abre el modal para eliminar codigo
function abrirModalEliminar(id){     
  $('#modalEliminar').modal('show');
  $('#idD').val(id);    
}

// enviar peticion para borrar el material
function borrar(){
  id = document.getElementById("idD").value;
  spinHandle = loadingOverlay().activate(); // mostrar loading

  axios.post('delete_material',{
    'id': id  
      })
      .then((response) => {	
        loadingOverlay().cancel(spinHandle); // cerrar loading

        if(response.data.success == 1){
          toastr.success('Material Eliminado!')
          $('#modalEliminar').modal('hide');   
        }else{
          toastr.error('Error', 'No se pudo eliminar el material');  
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

//Select con buscardor (select2)
jQuery(document).ready(function($){
    $(document).ready(function() {
        $('.unidadn').select2();
        $('.clasificacionn').select2();
        $('.unidad').select2();
        $('.clasificacion').select2();
        $('.codn').select2();
        $('.cod').select2();
    });
});
</script>

@stop