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
            <div class="col-sm-1">
              <button type="button" onclick="imprimirPresupuesto()" class="btn btn-info btn-sm">
                <i class="fas fa-print"></i>
                Imprimir
              </button>
            </div>
            <div class="col-sm-1">
              <button type="button" onclick="abrirModalAgregarPar()" class="btn btn-success btn-sm">
                <i class="fas fa-pencil-alt"></i>
                Partida
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
                <br>
                  <button type="button" onclick="abrirModalAgregarBit()" class="btn btn-success btn-sm">
                  <i class="fas fa-pencil-alt"></i>
                    Bitacora
                  </button>
                
              </div>
            </div>          
          </div>
       </div>
      </div>
    </div>
    <!------------------ PRESUPUESTO DEL PROYECTO INDIVIDUAL ---------------->
    <div class="col-sm-6 float-right">
      <div class="container-fluid">
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Presupuesto de Proyecto</h3>
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
                  <th style="width: 40%;">Fecha</th>                            
                  <th style="width: 20%;">Opciones</th>                           
                </tr>
                </thead>
                <tbody>
              
              @foreach($partidas as $par)  
                <tr>
                  <td>{{ $par-> item }}</td>
                  <td>{{ $par-> nombre }}</td> 
                  <td>
                  <center>
                    <button type="button" class="btn btn-info btn-xs" onclick="abrirModalEditar({{ $par->id }})">
                      <i class="fas fa-pencil-alt" title="Editar"></i>&nbsp; Editar
                    </button>
                    <button type="button" class="btn btn-danger btn-xs" onclick="EliminarPartida({{ $par->id }})">
                      <i class="fas fa-trash" title="Editar"></i>&nbsp; Borrar
                    </button>
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
    <!------------------ CONTROL DE BITACORAS ---------------->
      <div class="col-sm-6 float-left">
        <div class="container-fluid">
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Control de Bitacoras</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                <table id="example2" class="table table-bordered table-hover">
                <thead>             
                <tr>
                  <th style="width: 15%;">Num.</th>   
                  <th style="width: 15%;">Fecha</th>                            
                  <th style="width: 40%;">Opciones</th>                           
                </tr>
                </thead>
                <tbody>
              
              @foreach($bitacoras as $bit)  
                <tr>
                  <td>{{ $bit-> num }}</td>
                  <td>{{ $bit-> fecha }}</td> 
                  <td>
                  <center>
                  <button type="button" class="btn btn-info btn-xs" onclick="abrirModalEditarBit({{ $bit->id }})">
                    <i class="fas fa-pencil-alt" title="Editar"></i>&nbsp; Editar
                    </button>
                    <a href="{{route('pdf.bit', ['id' => $bit->id] )}}" target="_blank"><button type="button"  class="btn btn-success btn-xs">
                      <i class="fas fa-print" title="Imprimir"></i>&nbsp; Imprimir
                      </button></a>       
                    <a href="{{route('pdf.bit', ['id' => $bit->id] )}}" target="_blank"><button type="button"  class="btn btn-success btn-xs">
                      <i class="fas fa-print" title="Imprimir_fotos"></i>&nbsp; Fotograf&iacute;as
                      </button></a> 
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
    
  </section>

    <!-- Modal Agregar Bitacora -->
<div class="modal fade" id="modalAgregarBit">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Agregar Nueva Bit&aacute;cora</h4>
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
                        <label>Num:</label>   
                        <input type="text" class="form-control" id="numn" name="numn" value="{{ count($bitacoras) + 1 }}" readonly>
                        <input type="hidden" class="form-control" id="proyecto_idn" name="proyecto_idn" value="{{ $proyecto-> id }}">
                    </div>
                    <div class="form-group">
                        <label>Fecha:</label>   
                        <input type="date" class="form-control" id="fechan" name="fechan">
                    </div>
                    <div class="form-group">
                        <label>Observaciones:</label>   
                        <textarea class="form-control" id="observacionesn" name="observacionesn" rows="4"></textarea>
                    </div>                   
                  </div>
                </div> 
                <div class="row">
                  <table  class="table" id="matrizfotos"  data-toggle="table">
                    <thead>
                      <tr>
                        <th scope="col" >Titulo</th>
                        <th scope="col" >Fotograf&iacute;a</th>                        
                        <th scope="col" >Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td scope="col"> 
                          <input type="text" class="form-control" id="titulo" name="titulo[]" >
                        </td>
                        <td scope="col"> 
                          <!-- imagen -->
                          <input type="file" class="form-control" id="dir" name="dir[]" accept="image/jpeg, image/jpg" />
                        </td>                        
                        <td scope="col"><button class="btn btn-block btn-danger btn-xs" id="delete2">Borrar</button></td>
                      </tr>  
                    </tbody>
                  </table>
                  <a class="btn btn-block btn-success btn-xs" id="add2">
                  <i class="fas fa-plus" title="mas"></i>&nbsp; M&aacute;s</a>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnGuardarU" onclick="enviarModalAgregarBit()">Guardar</button>
          </div>          
        </div>        
      </div>      
    </div>
   <!-- Modal editar Bitacora -->
   <div class="modal fade" id="modalEditarBit">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Editar Bitacora</h4>
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
                        <label>Num:</label>
                        <input type="hidden" id="idU"  name="idU"/> <!-- id de la bit-->      
                        <input style="width: 50%;" type="text" class="form-control" id="num" name="num" readonly>
                      </div>
                      <div class="form-group">
                        <label>Fecha:</label>   
                        <input type="date" class="form-control" id="fecha" name="fecha" >
                      </div>
                      <div class="form-group">
                        <label>Observaciones:</label>   
                        <textarea class="form-control" id="observaciones" name="observaciones" rows="4"></textarea>
                      </div>
                    </div>
                  </div> 
                </div>
              </form>
            </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnGuardarU" onclick="enviarModalEditarBit()">Guardar</button>
          </div>          
        </div>        
      </div>      
    </div>

      <!-- Modal Agregar Partida -->
    <div class="modal fade" id="modalAgregar" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Agregar partida de Presupuesto</h4>
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
                        <label>Item:</label>   
                        <input  type="text" class="form-control" id="itemn" name="itemn" value="{{ count($partidas) + 1 }}" readonly>
                        <input type="hidden" class="form-control" id="proyecto_idnp" name="proyecto_idnp" value="{{ $proyecto-> id }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Cantidad C/ Unidad:</label>   
                        <input style="width:50%;" type="text" class="form-control" id="cantidadpn" name="cantidadpn">
                    </div>
                  </div>
                </div>  
                <div class="row">
                  <div class="col-md-10">
                    <div class="form-group">
                      <label>Partida:</label>   
                      <textarea class="form-control" id="nombren" name="nombren" rows="2"></textarea>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <br>
                      <button type="button" onclick="abrirModalAgregarMate(1)" class="btn btn-primary btn-sm float-right" style="margin-top:10px;">
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
            <button type="button" class="btn btn-primary" id="btnGuardarU" onclick="enviarModalAgregarPar()">Guardar</button>
          </div>          
        </div>        
      </div>      
    </div>
     <!-- Modal Editar Partida -->
   <div class="modal fade" id="modalEditar">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Editar Partida</h4>
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
                          <label>Cantidad C/ Unidad:</label>   
                          <input style="width:50%;" type="text" class="form-control" id="cantidadp" name="cantidadp">
                          <input type="hidden" class="form-control" id="idU2" name="idU2">
                      </div>               
                    </div>
                  </div> 
                  <div class="row">
                    <div class="col-md-6"> 
                      <div class="form-group">
                        <label>Partida:</label>   
                        <textarea class="form-control" id="nombre" name="nombre" rows="2"></textarea>
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
            <button type="button" class="btn btn-primary" id="btnGuardarU" onclick="enviarModalEditarPar()">Guardar</button>
          </div>          
        </div>        
      </div>      
    </div>
    <!-- Modal agregar detalle de Partida -->
    <div class="modal fade" id="modalAgregarPar" style="margin-top:3%;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Agregar Detalle de Partida</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formularion3">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Cantidad:</label>   
                        <input type="number" step="any" class="form-control" id="mcantidad" name="mcantidad">
                    </div>
                  </div>
                </div>  
                <div class="row">
                  <div class="col-md-10">
                    <div class="form-group">
                      <label>Descripción:</label> 
                      <select class="form-control mmaterial_id" id="mmaterial_id" name="mmaterial_id">
                        <option value="" >Seleccione una opción</option>
                        @foreach($materiales as $mat)
                        <option value="{{ $mat->id }}" data-unidad="{{ $mat->unidad }}" >{{ $mat->nombre }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Unidad de medida:</label>   
                        <input type="text" class="form-control" id="munidad" name="munidad" readonly>
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
//*********************** Para darle tiempo al toaster al recargar la pagina */
    toastr.options.timeOut = 750;
    toastr.options.fadeOut = 750;
    toastr.options.onHidden = function(){
    // this will be executed after fadeout, i.e. 2secs after notification has been show
     window.location.reload();
    }; 
//****************************************************************************/

// abre el modal para editar una bitacora
function abrirModalEditarBit(id){
  document.getElementById("formularioU").reset();   
  spinHandle = loadingOverlay().activate();
  axios.post('/admin/get_bitacora',{'id': id })
      .then((response) => {	
        loadingOverlay().cancel(spinHandle); // cerrar loading
        if(response.data.success = 1){
          $('#modalEditarBit').modal('show');
          $('#idU').val(response.data.bitacora.id);
          $('#num').val(response.data.bitacora.num);    
          $('#fecha').val(response.data.bitacora.fecha);    
          $('#observaciones').val(response.data.bitacora.observaciones);   
        }else{ 
          toastr.error('Error', 'Bitacora no encontrada'); 
        }
      })
      .catch((error) => {
        loadingOverlay().cancel(spinHandle); // cerrar loading
        toastr.error('Error');
  });
}


    // guardar edicion de Bitacora
function enviarModalEditarBit(){
            var fecha = document.getElementById('fecha').value;
            var observaciones = document.getElementById('observaciones').value;
            var id = document.getElementById('idU').value;

   
      var spinHandle = loadingOverlay().activate(); // activar loading
      //document.getElementById("btnGuardar").disabled = true;
            
      let formData = new FormData();
      formData.append('fecha', fecha);
      formData.append('observaciones', observaciones);
      formData.append('id', id);
      

      axios.post('/admin/update_bitacora', formData, {  
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
//Abrir modal Agregar bitacora
function abrirModalAgregarBit(){
    document.getElementById("formularion").reset();   
    $('#modalAgregarBit').modal('show');   
   // $('#matrizfotos tbody').empty();
   $("#matrizfotos tbody").children( 'tr:not(:first)' ).html("");
}
//Guardar nueva bitacora
function enviarModalAgregarBit(){
            var proyecto_id = document.getElementById('proyecto_idn').value;
            var num = document.getElementById('numn').value;
            var fecha = document.getElementById('fechan').value;
            var observaciones = document.getElementById('observacionesn').value;

            var dirs = document.getElementsByName('dir[]');
            var titulos = $("input[name='titulo[]']").map(function(){return $(this).val();}).get();
            
      var spinHandle = loadingOverlay().activate(); // activar loading
            
      let formData = new FormData();
      formData.append('proyecto_id', proyecto_id);
      formData.append('num', num);
      formData.append('fecha', fecha);
      formData.append('observaciones', observaciones);      
      
      
      for (var i = 0; i < titulos.length; i++){
            // Agregar titulo y foto al formData
            formData.append('dir[]', dirs[i].files[0])
            formData.append('titulo[]', titulos[i]);
        }

      axios.post('/admin/add_bitacora', formData, {  
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
//Abrir modal Agregar partida
function abrirModalAgregarPar(){
    document.getElementById("formularion2").reset();   
    $('#matriz tbody').empty();
    $('#modalAgregar').css('overflow-y', 'auto');
    $('#modalAgregar').modal('show');   
}
//Guardar partida
function enviarModalAgregarPar(){
            var proyecto_id = document.getElementById('proyecto_idnp').value;
            var item = document.getElementById('itemn').value;
            var cantidadp = document.getElementById('cantidadpn').value;
            var nombre = document.getElementById('nombren').value;

            var cantidades = $("input[name='cantidad[]']").map(function(){return $(this).val();}).get();
            var material_id = $("input[name='material_id[]']").map(function(){return $(this).val();}).get();
            var unidades = $("input[name='unidad[]']").map(function(){return $(this).val();}).get();

   
      var spinHandle = loadingOverlay().activate(); // activar loading
            
      let formData = new FormData();
      formData.append('proyecto_id', proyecto_id);
      formData.append('item', item);
      formData.append('cantidadp', cantidadp);
      formData.append('nombre', nombre);  
      for(var a = 0; a< material_id.length; a++){
        formData.append('cantidad[]', cantidades[a]);
        formData.append('material_id[]', material_id[a]);
        formData.append('unidad[]', unidades[a]);
      }    

      

      axios.post('/admin/add_partida', formData, {  
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
//Abrir modal Agregar detale partida
function abrirModalAgregarMate(m){
    document.getElementById("formularion3").reset();   
    if(m == 2){
      document.getElementById("add").value = 2;   
    } else {
      document.getElementById("add").value = 1;   
    }   
    $('#modalAgregarPar').modal('show');   
}

// abre el modal para editar una partida
function abrirModalEditar(id){
  document.getElementById("formularioU2").reset();   
  $('#matrizpar tbody').empty();
  spinHandle = loadingOverlay().activate();
  axios.post('/admin/get_partida',{'id': id })
      .then((response) => {	
        loadingOverlay().cancel(spinHandle); // cerrar loading
        if(response.data.success = 1){
          $('#modalEditar').css('overflow-y', 'auto');
          $('#modalEditar').modal('show');
          $('#idU2').val(response.data.partida.id);
          $('#nombre').val(response.data.partida.nombre);    
          $('#cantidadp').val(response.data.partida.cantidadp);    
          
          var detpartida = response.data.datosdetalle;
          for (var i = 0; i < detpartida.length; i++) {
              var data = '<tr><td><input id="cantidad'+i+'" name="cantidad[]" class="form-control" type="number" step="any" value="'+detpartida[i].cantidad+'"></td>\n\
                              <td><input id="material_id'+i+'" name="material_id[]" class="form-control" type="hidden" value="'+detpartida[i].material_id+'">\n\
                                  <input id="nombre_material'+i+'" class="form-control" type="text" value="'+detpartida[i].nombrematerial+'" readonly></td>\n\
                              <td><input id="unidad'+i+'" name="unidad[]" type="text" class="form-control" value="'+detpartida[i].unidad+'"  readonly></td>\n\
                              <td><input id="id'+i+'" name="id[]" type="hidden" class="form-control" value="'+detpartida[i].id+'">\n\
                              <button class="btn btn-block btn-danger btn-xs" id="delete3">Borrar</button></td></tr>';    
                $("#matrizpar tbody").append(data);
                  }
                $("#matrizpar tbody").on("click", "#delete3", function (ev) {
                  var $currentTableRow = $(ev.currentTarget).parents('tr')[0];
                      $currentTableRow.remove();
                });
        }else{ 
          toastr.error('Error', 'Partida no encontrada'); 
        }
      })
      .catch((error) => {
        loadingOverlay().cancel(spinHandle); // cerrar loading
        toastr.error('Error');    
  });
}
    //*********** guardar edicion de partida con detalle de partida *****/ 
    function enviarModalEditarPar(){
            var cantidadp = document.getElementById('cantidadp').value;
            var nombre = document.getElementById('nombre').value;
            var id = document.getElementById('idU2').value;

            var cantidades = $("input[name='cantidad[]']").map(function(){return $(this).val();}).get();
            var material_id = $("input[name='material_id[]']").map(function(){return $(this).val();}).get();
            var unidades = $("input[name='unidad[]']").map(function(){return $(this).val();}).get();
            var iddet = $("input[name='id[]']").map(function(){return $(this).val();}).get();

          var spinHandle = loadingOverlay().activate(); // activar loading
          //document.getElementById("btnGuardar").disabled = true;
                
          let formData = new FormData();
          formData.append('cantidadp', cantidadp);
          formData.append('nombre', nombre);
          formData.append('id', id);

          for(var a = 0; a< material_id.length; a++){
            formData.append('cantidad[]', cantidades[a]);
            formData.append('material_id[]', material_id[a]);
            formData.append('unidad[]', unidades[a]);
            formData.append('iddet[]', iddet[a]);
            }    
          

          axios.post('/admin/update_partida', formData, {  
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

// mensaje cuando se crea una nueva bitacora
function mensajeResponse1(valor){
    if(valor.data.success == 1){
      toastr.success('Guardado', 'Bitacora creada exitosamente!');
      $('#modalAgregarBit').modal('hide'); 
    }else if(valor.data.success == 2){
      toastr.error('Error', 'Bitacora NO guardada!');
    }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
    }
}

// mensaje cuando se edita una bitacora
function mensajeResponse2(valor){
  if(valor.data.success == 1){
    toastr.success('Guardado', 'Se han guardado los cambios!');
    $('#modalEditarBit').modal('hide'); 
  }else if(valor.data.success == 2){
    toastr.error('Error', 'Cambios no guardados!');
  }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
  }
}
// mensaje cuando se agrega una nueva partida
function mensajeResponse3(valor){
    if(valor.data.success == 1){
      toastr.success('Guardado', 'Partida Agregada exitosamente!');
      $('#modalAgregarBit').modal('hide'); 
    }else if(valor.data.success == 2){
      toastr.error('Error', 'Partida NO guardada!');
    }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
    }
}
// mensaje por edicion de partida
function mensajeResponse4(valor){
    if(valor.data.success == 1){
      toastr.success('Guardado', 'Partida actualizada exitosamente!');
      $('#modalEditar').modal('hide'); 
    }else if(valor.data.success == 2){
      toastr.error('Error', 'Partida NO guardada!');
    }else{
    // error en validacion en servidor
    toastr.error('Error', 'Datos incorrectos!');
    }
}
</script>

<script type="text/javascript">
//Script para Organizar la tabla de datos
    $(document).ready(function() {
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "order": [[ 2, "desc" ]],
        "info": true,
        "autoWidth": false,
        "language": {
        "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas"            
        }
      });
    });

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

    //Para funcion de select con live search
      $(document).ready(function(){
        $("#unidadn").select2();
        $("#mmaterial_id").select2();
      });

      //Para capturar el evento del select de agregar material en partida
          $("#mmaterial_id").change(function () {
          var unidad = $(this).find(':selected').data('unidad');
          $('#munidad').val(unidad);
           
      });
      //Para limpiar el select cada vez que se resetee el Form q esta en el modal agregar detalle de partida
      $('form').on('reset', function() {
          setTimeout(function() {
            $('#mmaterial_id').select2('val',0);
          }, 0);
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
                    var name =$("#mmaterial_id option:selected").text();
                    //agrega las filas dinamicamente
                    var data = '<tr id="'+(nFilas+1)+'"><td><input id="cantidad'+(nFilas+1)+'" name="cantidad[]" class="form-control" type="number" step="any" value="'+$('#mcantidad').val()+'"></td>\n\
                                                        <td><input id="material_id'+(nFilas+1)+'" name="material_id[]" class="form-control" type="hidden" value="'+$('#mmaterial_id').val()+'">\n\
                                                        <input id="nombre_material'+(nFilas+1)+'" class="form-control" type="text" value="'+name+'"></td>\n\
                                                        <td><input id="unidad'+(nFilas+1)+'" name="unidad[]" type="text" class="form-control" value="'+$('#munidad').val()+'"></td>\n\
                                                        <td><button class="btn btn-block btn-danger btn-xs" id="delete">Borrar</button></td></tr>';    
                    if (quemodal == 2){
                      $("#matrizpar tbody").append(data); 
                    }else{
                      $("#matriz tbody").append(data);
                    }
                    $('#modalAgregarPar').modal('hide');
                });                

                $("#matriz tbody").on("click", "#delete", function (ev) {
                  //elimino la fila
                  var $currentTableRow = $(ev.currentTarget).parents('tr')[0];
                      $currentTableRow.remove();
                });
              });

              //*************Para las fotos de la bitacora ******************/
              $(document).ready(function () {
                $("#add2").on("click", function () {
                    var nFilas = $('#matrizfotos >tbody >tr').length;
                    nFilas = nFilas - 1;
                    //agrega las filas dinamicamente
                    var data = '<tr id="'+(nFilas+1)+'"><td><input id="titulo'+(nFilas+1)+'" name="titulo[]" class="form-control" type="text" ></td>\n\
                                                        <td><input type="file" class="form-control" id="dir" name="dir[]" accept="image/jpeg, image/jpg" /></td>\n\
                                                        <td><button class="btn btn-block btn-danger btn-xs" id="delete2">Borrar</button></td></tr>';    
                $("#matrizfotos tbody").append(data);
                });

                $("#matrizfotos tbody").on("click", "#delete2", function (ev) {
                  //elimino la fila
                  var $currentTableRow = $(ev.currentTarget).parents('tr')[0];
                      $currentTableRow.remove();
                });
              });
   </script>
@stop