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
              <h1>Cotizacion</h1>
            </div>

          </div>
        </div>
  </section>
    <!-- seccion frame -->
  <section class="content" >
    <div class="container-fluid">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Cotizacion</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="exampleInputEmail1" >Destino</label>
                  <input type="text" value="{{ $cotizacion-> destino }}" class="form-control" id="destino" disabled>
                  <input id="cotizacionid"type="hidden" class="form-control" value="{{ $cotizacion-> id }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" >Necesidad</label>
                  <textarea type="textbox" class="form-control" id="necesidad" rows="3" disabled>{{ $cotizacion-> necesidad }}</textarea>
                </div>
              </div>
              <div class="col-md-2">
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label for="exampleInputEmail1" >Proveedor</label>
                  <select class="custom-select" id="proveedor" disabled>
                    <option value="{{ $cotizacion->proveedor_nombre }}">{{ $cotizacion->proveedor_nombre }}</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Fecha de cotizacion:</label>

                  @if ($cotizacion->estado == 0 )
                  <!--@hasrole('uaci')-->
                  <input type="date" name="fechacotizacion" id="fechacotizacion" class="form-control" value="{{ $cotizacion->fecha }}">
                  <!-- @endhasrole-->
                  <!--@hasrole('jefeuaci')-->
                  <input type="date" name="fechacotizacion" id="fechacotizacion" class="form-control" value="{{ $cotizacion->fecha }}" disabled>
                  <!-- @endhasrole--> 
                  @else
                  <input type="date" name="fechacotizacion" id="fechacotizacion" class="form-control" value="{{ $cotizacion->fecha }}" disabled>
                  @endif
                </div>
              </div>
            </div>
            <!-- tabla detalles cotizacion -->
            <div class="row">
              <table  class="table" id="tablecrearcotizacion"  data-toggle="table">
                <thead>
                  <tr>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Descripci&oacute;n</th>
                    <th scope="col">Precio Unitario</th>
                    <th scope="col">Cod. Presup</th>
                  </tr>
                </thead>
                <tbody>
                @if ($cotizacion->estado == 0 )
                <!--@hasrole('uaci')-->
                @foreach($detcotizacion as $key => $item)
                  <td ><input id="cantidad'{{$key}}'" name="cantidad[]" class="form-control" type="number" step="any" value="{{ $item-> cantidad }}" ></td>
                  <td ><input id="descripcion'{{$key}}'" name="descripcion[]" class="form-control" type="text" step="any" value="{{ $item-> descripcion }}" ></td>
                  <td ><input id="preciounitario'{{$key}}'" name="preciounitario[]" class="form-control" type="number" step="any" value="{{ $item-> preciounit }}" ></td>
                  <td ><input id="codpresup'{{$key}}'" name="codpresup[]" class="form-control" type="number" step="any" value="{{ $item-> cod_presup }}" >
                       <input id="detallecotid'{{$key}}'" name="detallecotid[]" class="form-control" type="number" step="any" value="{{ $item-> id }}" hidden></td>
                </tr>
                @endforeach  
                <!-- @endhasrole--> 

                <!--@hasrole('jefeuaci')-->
                @foreach($detcotizacion as $key => $item)
                  <td ><input id="cantidad'{{$key}}'" name="cantidad[]" class="form-control" type="number" step="any" value="{{ $item-> cantidad }}" disabled></td>
                  <td ><input id="descripcion'{{$key}}'" name="descripcion[]" class="form-control" type="text" step="any" value="{{ $item-> descripcion }}" disabled></td>
                  <td ><input id="preciounitario'{{$key}}'" name="preciounitario[]" class="form-control" type="number" step="any" value="{{ $item-> preciounit }}" disabled></td>
                  <td ><input id="codpresup'{{$key}}'" name="codpresup[]" class="form-control" type="number" step="any" value="{{ $item-> cod_presup }}" disabled>
                       <input id="detallecotid'{{$key}}'" name="detallecotid[]" class="form-control" type="number" step="any" value="{{ $item-> id }}" hidden></td>
                </tr>
                @endforeach  
                <!-- @endhasrole--> 
                @else
                  @foreach($detcotizacion as $key => $item)
                    <td ><input id="cantidad'{{$key}}'" name="cantidad[]" class="form-control" type="number" step="any" value="{{ $item-> cantidad }}" disabled></td>
                    <td ><input id="descripcion'{{$key}}'" name="descripcion[]" class="form-control" type="text" step="any" value="{{ $item-> descripcion }}" disabled></td>
                    <td ><input id="preciounitario'{{$key}}'" name="preciounitario[]" class="form-control" type="number" step="any" value="{{ $item-> preciounit }}" disabled></td>
                    <td ><input id="codpresup'{{$key}}'" name="codpresup[]" class="form-control" type="number" step="any" value="{{ $item-> cod_presup }}" disabled>
                        <input id="detallecotid'{{$key}}'" name="detallecotid[]" class="form-control" type="number" step="any" value="{{ $item-> id }}" hidden></td>
                  </tr>
                  @endforeach
                @endif
                </tbody>
              </table>
            </div>
            <!-- boton generar cotizacion -->
            <div class="row">
              <div class="col-md-8">
                  <a class="btn btn-info  mt-3 float-left" href= "javascript:history.back() "    target="frameprincipal">
                  <i class="" title="Cancelar"></i>&nbsp; Cancelar </a>
              </div>
              <div class="col-md-4">
              @if ($cotizacion->estado == 0 )
                <!--@hasrole('uaci')-->
                  <button type="button" id="btnActualizarCotizacion" class="btn btn-warning float-right mt-3" >Actualizar Cotizacion</button>
                <!-- @endhasrole-->
                <!--@hasrole('jefeuaci')-->
                  <button type="button" id="AutorizarrCotizacion" class="btn btn-success  mt-3" onclick="procesarCot(1)" >Autorizar Cotizacion</button>
                  <button type="button" id="DenegarCotizacion" class="btn btn-danger float-right mt-3" onclick="procesarCot(2)" >Denegar Cotizacion</button>
                <!-- @endhasrole-->
              @else

              @endif

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
    function procesarCot(estado){
      var estado = estado;
      var cotizacion_id =  document.getElementById("cotizacionid").value;

      let formData = new FormData();

        formData.append('estado', estado);
        formData.append('cotizacion_id', cotizacion_id);

      axios.post('procesar_cotizacion', formData )
        .then(function (response) {
          var spinHandle = loadingOverlay().activate(); // activar loading
          toastr.success('Procesada', 'Cotizacion procesada con exito', {
                timeOut: 1700,
                preventDuplicates: true,
                // Redirect 
                onHidden: function() {
                  window.location.href = "procesar_cotizaciones";
                }
            });
                  
          //console.log(response);
        })
        .catch(function (error) {
          console.log(error);
      });
    }
//Script para Organizar la tabla de datos
    
    $(document).ready(function() {

      //ACTUALIZAR COTIZACION//
      if(document.getElementById("btnActualizarCotizacion")){
        document.getElementById("btnActualizarCotizacion").onclick = function actualizarCot(){
            
            var fecha = document.getElementById("fechacotizacion").value;
            var cotizacion_id =  document.getElementById("cotizacionid").value;
            
            var cantidades = $("input[name='cantidad[]']").map(function(){return $(this).val();}).get();
            var descripciones = $("input[name='descripcion[]']").map(function(){return $(this).val();}).get();
            var preciosunitarios = $("input[name='preciounitario[]']").map(function(){return $(this).val();}).get();
            var codpresup = $("input[name='codpresup[]']").map(function(){return $(this).val();}).get();
            var detallecotid = $("input[name='detallecotid[]']").map(function(){return $(this).val();}).get();
            


            let formData = new FormData();

            formData.append('fecha', fecha);
            formData.append('cotizacion_id', cotizacion_id);

            for(var a = 0; a< descripciones.length; a++){
              formData.append('cantidad[]', cantidades[a]);
              formData.append('descripcion[]', descripciones[a]);
              formData.append('preciounitario[]', preciosunitarios[a]);
              formData.append('codpresup[]', codpresup[a]);
              formData.append('detallecotid[]', detallecotid[a]);
            }    

            axios.post('update_cotizacion', formData )
            .then(function (response) {
              var spinHandle = loadingOverlay().activate(); // activar loading
              toastr.success('Actualizada', 'Cotizacion actualizada con exito', {
                timeOut: 1700,
                preventDuplicates: true,
                // Redirect 
                onHidden: function() {
                  window.location.href = "load_cotizaciones_pendientes";
                }
            });
                  
              
              //console.log(response);
            })
            .catch(function (error) {
              console.log(error);
            });
        }
      }
      //AUTORIZAR O DENEGAR COTIZACION
      



    });
</script>

<!-- Multi Select CDN -->
<script src="https://cdn.rawgit.com/crlcu/multiselect/master/dist/js/multiselect.min.js"></script>

@stop