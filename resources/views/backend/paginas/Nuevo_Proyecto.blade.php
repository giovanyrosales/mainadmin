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
            <h1>Registro de Proyectos Municipales</h1>
          </div>
        </div>
      </div>
  </section>
    <!-- seccion frame -->
  <section class="content">
    <div class="container-fluid">
      <form class="form-horizontal" id="form1">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Nuevo Proyecto</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
              </div>
          </div>
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
          </div>
          <div class="card-footer">
            <button id="btnguardar" type="button"  class="btn btn-info float-right" onclick="guardarproy();">Guardar</button>
            <button type="button" onclick="location.href='{{ url('/admin/inicio') }}'" class="btn btn-default">Cancelar</button>
          </div>
        </div>
      </form>
	  </div>
	</section>
	<!-- /.section -->
@extends('backend.menus.indexInferior')

@section('content-admin-js')	

  <!-- data table -->
  <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/loading/loadingOverlay.js') }}" type="text/javascript"></script> 
  <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/select2.min.js') }}" type="text/javascript"></script>
  <script>

    // guardar proyecto
    function guardarproy(){

    var codigo = document.getElementById('codigo').value;
    var nombre = document.getElementById('nombre').value;
    var ubicacion = document.getElementById('ubicacion').value;
    var fuentef = document.getElementById('fuentef').value;
    var contraparte = document.getElementById('contraparte').value;
    var fechaini = document.getElementById('fechaini').value;
    var areagestion = document.getElementById('areagestion').value;
    var linea = document.getElementById('linea').value;
    var fuenter = document.getElementById('fuenter').value;
    var naturaleza = document.getElementById('naturaleza').value;
    var ejecutor = document.getElementById('ejecutor').value; 
    var formulador = document.getElementById('formulador').value; 
    var supervisor = document.getElementById('supervisor').value; 
    var encargado = document.getElementById('encargado').value; 
    var codcontable = document.getElementById('codcontable').value; 
    var acuerdoapertura = document.getElementById('acuerdoapertura').value; 

    var retorno = validaciones(nombre, ubicacion);

    if(retorno){ 
   
      var spinHandle = loadingOverlay().activate(); // activar loading
            
      let formData = new FormData();
      formData.append('codigo', codigo);
      formData.append('nombre', nombre);
      formData.append('ubicacion', ubicacion);
      formData.append('fuentef', fuentef);
      formData.append('contraparte', contraparte);
      formData.append('fechaini', fechaini);
      formData.append('areagestion', areagestion);
      formData.append('linea', linea);
      formData.append('fuenter', fuenter);
      formData.append('naturaleza', naturaleza);
      formData.append('ejecutor', ejecutor);
      formData.append('formulador', formulador);
      formData.append('supervisor', supervisor);
      formData.append('encargado', encargado);
      formData.append('codcontable', codcontable);
      formData.append('acuerdoapertura', acuerdoapertura);

      axios.post(url+'add_proyecto', formData, {  
        })
        .then((response) => {	
          loadingOverlay().cancel(spinHandle); // cerrar loading            
          //document.getElementById("btnGuardar").disabled = false; //habilitar boton  
          mensajeResponse(response);
        })
        .catch((error) => {
          //document.getElementById("btnGuardar").disabled = false;     
          loadingOverlay().cancel(spinHandle); // cerrar loading                
          toastr.error('Error', error.message);               
      }); 
    } 
}

// mensaje cuando guardamos el proyecto
function mensajeResponse(valor){
  if(valor.data.success == 1){
    //toastr.success('Guardado', valor.data.message);
    toastr.success('Guardado', 'Se ha guardado El nuevo proyecto!');
    //Limpia el formulario y la tabla (tbody)
    document.getElementById("form1").reset();
    //$("#matriz > tbody").html("");
  }else if(valor.data.success == 2){
    toastr.error('Error', 'Datos no guardados!');
  }else{
    // error en validacion en servidor
    //toastr.error('Error', 'Datos incorrectos!');
    toastr.error('Error', valor.data.message);
  }
}
  
  // validar antes de guardar el proyecto
function validaciones(nombre, ubicacion){            
     
    if(nombre === ''){
      toastr.error('Error', 'Agregar nombre de proyecto!');
      return false;
    }
      else if(ubicacion === ''){
        toastr.error('Error', 'Agregar ubicacion del proyecto.!');
        return false;
    }
    return true; 
}  



//Select con buscardor (select2)
jQuery(document).ready(function($){
    $(document).ready(function() {
        $('.areagestion').select2();
        $('.linea').select2();
        $('.fuenter').select2();
        $('.fuentef').select2();
    });
});
</script>

<!--<script type="text/javascript">
            
            var variableAcumuladora = 0;
            var total = 0.0;
            
            $(document).ready(function () {
                $("#add").on("click", function () {
                    var nFilas = $('#matriz >tbody >tr').length;
                    nFilas = nFilas - 1;
                    //agrega las filas dinamicamente
                    var data = '<tr id="'+(nFilas+1)+'"><td><input id="cantidad'+(nFilas+1)+'" name="cantidad[]" class="form-control" type="number" step="any" value="'+$('#mcantidad').val()+'"></td>\n\
                                                        <td><input id="descripcion'+(nFilas+1)+'" name="descripcion[]" class="form-control" type="text" value="'+$('#mdescripcion').val()+'"></td>\n\
                                                        <td><input id="unidad'+(nFilas+1)+'" name="unidad[]" type="text" class="form-control" value="'+$('#munidad').val()+'"></td>\n\
                                                        <td><input id="pu'+(nFilas+1)+'" name="pu[]" type="text" class="form-control" value="'+$('#mpu').val()+'"></td>\n\
                                                        <td><button class="btn btn-block btn-danger btn-xs" id="delete">Borrar</button></td></tr>';    
               $("#matriz tbody").append(data);
                    var price = parseFloat(document.getElementById('mpu').value)*parseFloat(document.getElementById('mcantidad').value);
                    total = parseFloat(total) + price;
                    document.getElementById("total").value = parseFloat(total);
                    $('#modalAgregar').modal('hide');
                });

                $("#matriz tbody").on("click", "#delete", function (ev) {
                  //elimino la fila
                  var $currentTableRow = $(ev.currentTarget).parents('tr')[0];
                  //verificamos el id de la fila para ponerlo extraer el valor del input precio sumado al id q le corresponde
                    var $i = $currentTableRow.id;
                    var $restaprecio =   document.getElementById('pu' + $i).value * document.getElementById('cantidad' + $i).value;
                    //asignamos el nuevo valor al total
                    total = parseFloat(total) - $restaprecio;
                    document.getElementById("total").value = total;
                    $currentTableRow.remove();
                });
            });

   </script>-->
@stop