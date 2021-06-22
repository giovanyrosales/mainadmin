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
              <h1>Crear Cotizacion</h1>
            </div>

          </div>
        </div>
  </section>
    <!-- seccion frame -->
  <section class="content" >
    <div class="container-fluid">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Crear Cotizacion</h3>

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
                  <label >Destino</label>
                  <input type="text" value="{{ $requisicion-> destino }}" class="form-control" id="destino" disabled>
                  <input id="requisicionid"type="hidden" class="form-control" value="{{ $requisicion-> id }}">
                </div>
                <div class="form-group">
                  <label >Necesidad</label>
                  <textarea type="textbox" class="form-control" id="necesidad" rows="3" disabled>{{ $requisicion-> necesidad }}</textarea>
                </div>
              </div>
              <div class="col-md-2">
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label >Proveedor</label>
                  <select class="custom-select" id="proveedor">
                  @foreach($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                  @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label>Fecha de cotizacion:</label>
                  <input type="date" name="fechacotizacion" id="fechacotizacion" class="form-control" value="<?php echo date("Y-m-d");?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
              <div class="row">
                  <!-- Selección del lado izquierdo -->
                  <div class="col-xs-5 col-md-5 col-sm-5">
                  <label>Lista de Items de requisicion</label>
                    <select name="from[]" id="mySideToSideSelect" class="form-control" size="8" multiple="multiple">
                      @foreach ($requisicion_det as $item)
                        <option value="{{ $item-> id }}" id="{{ $item-> id }}">{{ $item-> descripcion }}</option>
                      @endforeach
                    </select>
                  </div>
                    
                  <!-- Botones de acción -->
                  <div class="col-xs-2 col-md-2 col-sm-2">
                  
                    <label>&nbsp;</label>
                    <button type="button" id="mySideToSideSelect_rightAll" class="btn btn-secondary col-xs-12 col-md-12 col-sm-12 mt-1"><i class="fas fa-forward"></i></button>
                    <button type="button" id="mySideToSideSelect_rightSelected" class="btn btn-secondary col-md-12 col-sm-12 mt-1"><i class="fas fa-chevron-right"></i></button>
                    <button type="button" id="mySideToSideSelect_leftSelected" class="btn btn-secondary col-md-12 col-sm-12 mt-1"><i class="fas fa-chevron-left"></i></button>
                    <button type="button" id="mySideToSideSelect_leftAll" class="btn btn-secondary col-md-12 col-sm-12 mt-1"><i class="fas fa-backward"></i></button>
                  </div>
                    
                  <!-- Selección del lado derecho -->
                  <div class="col-xs-5 col-md-5 col-sm-5">
                  <label>Lista de Items a cotizar</label>
                    <select name="to[]" id="mySideToSideSelect_to" class="form-control" size="8" multiple="multiple"></select>
                  </div>
                </div>
             </div>
            </div>
            <!-- boton generar cotizacion -->
            <div class="row">
              <div class="col-md-12">
                <button type="button" id="GenerarCotizacion" class="btn btn-primary float-right mt-3" >Generar Cotizacion</button>
                <button type="button" onclick="location.href='javascript: history.go(-1)'" class="btn float-left btn-default mt-3">Cancelar</button>
              </div></div>
            <!-- Modal Agregar Cotizacion -->
            <div class="modal fade" id="modalAgregarCotizacion" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Detalles Cotizacion</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="formulariocrearcotizacion">
                        <div class="card-body">    
                          <div class="row">
                            <table  class="table" id="tablecrearcotizacion"  data-toggle="table">
                              <thead>
                                <tr>
                                  <th scope="col">Cantidad</th>
                                  <th scope="col">Descripci&oacute;n</th>
                                  <th scope="col">Unidad Medida</th>
                                  <th scope="col">Precio Unitario</th>
                                  <th scope="col">Cod. Presup</th>
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
                      <button type="button" class="btn btn-primary" id="btnGuardarCotizacion"  >Guardar</button>
                    </div>          
                  </div>        
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
</script>

<script type="text/javascript">
    
    $(document).ready(function() {
      $('#mySideToSideSelect').multiselect();


      //ABRIR MODAL PARA AGREGAR PRECIO UNITARIO//
      document.getElementById("GenerarCotizacion").onclick = function generarCot(){
        let lista = [];
        $('option','#mySideToSideSelect_to').each(function(){
          lista.push($(this).attr('id')); 
        });
        document.getElementById("formulariocrearcotizacion").reset();   
        $('#tablecrearcotizacion tbody').empty(); 
        axios.post(url+'get_requisiciones_on_list', { 'lista' : lista} )
        .then((response) => {
          let items = response.data;
          for (var i = 0; i < items.length; i++) {
            var llenadodetabla = '<tr>\n\
                                    <td><input id="cantidad'+i+'" name="cantidad[]" class="form-control" type="number" step="any" value="'+items[i].cantidad+'" disabled></td>\n\
                                    <td><input id="descripcion'+i+'" name="descripcion[]" class="form-control" type="text" value="'+items[i].descripcion+'" disabled></td>\n\
                                    <td><input id="unidadmedida'+i+'" name="unidadmedida[]" type="text" class="form-control" value="'+items[i].unidadmedida+'"  disabled></td>\n\
                                    <td><input id="preciounitario'+i+'" name="preciounitario[]" type="number" min="0" class="form-control" value=0 required >\n\
                                    <td><input id="codpresup'+i+'" name="codpresup[]" type="number" min="0" class="form-control" value=0 required >\n\
                                        <input id="detallereqid'+i+'" name="detallereqid[]" type="number" min="0" class="form-control" value="'+items[i].id+'"hidden >\n\
                                  </tr>';
            $("#tablecrearcotizacion tbody").append(llenadodetabla);
          } 
        }, (error) => {
          console.log(error);
        });
        document.getElementById("formulariocrearcotizacion").reset();   
          $('#matriz tbody').empty();
          $('#modalAgregarCotizacion').css('overflow-y', 'auto');
          $('#modalAgregarCotizacion').modal('show');   
        }

        //GUARDAR COTIZACION//
      document.getElementById("btnGuardarCotizacion").onclick = function guardarCot(){
          
          var destino =  document.getElementById("destino").value;
          var fecha = document.getElementById("fechacotizacion").value;
          var necesidad =  document.getElementById("necesidad").value;
          var proveedor_id =  document.getElementById("proveedor").value;
          var requisicion_id =  document.getElementById("requisicionid").value;
          var estado = 0;
          var cantidades = $("input[name='cantidad[]']").map(function(){return $(this).val();}).get();
          var unidades = $("input[name='unidadmedida[]']").map(function(){return $(this).val();}).get();
          var descripciones = $("input[name='descripcion[]']").map(function(){return $(this).val();}).get();
          var preciosunitarios = $("input[name='preciounitario[]']").map(function(){return $(this).val();}).get();
          var codpresup = $("input[name='codpresup[]']").map(function(){return $(this).val();}).get();
          var detallereqid = $("input[name='detallereqid[]']").map(function(){return $(this).val();}).get();
          


          let formData = new FormData();

          formData.append('destino', destino);
          formData.append('fecha', fecha);
          formData.append('necesidad', necesidad);
          formData.append('proveedor_id', proveedor_id);
          formData.append('requisicion_id', requisicion_id);
          formData.append('estado', estado);
          formData.append('detallereqid', detallereqid);

          for(var a = 0; a< descripciones.length; a++){
            formData.append('cantidad[]', cantidades[a]);
            formData.append('unidadmedida[]', unidades[a]);
            formData.append('descripcion[]', descripciones[a]);
            formData.append('preciounitario[]', preciosunitarios[a]);
            formData.append('codpresup[]', codpresup[a]);
            formData.append('detallereqid[]', detallereqid[a]);
          }    
          console.log(window.location);
          axios.post(url+'guardar_cotizacion', formData )
          .then(function (response) {
            
            removeOptionsFromSelect(document.getElementById('mySideToSideSelect_to'));
            if (document.getElementById('mySideToSideSelect').innerHTML.trim() !== ''){
              //console.log(document.getElementById('mySideToSideSelect'));
              toastr.success('Cotizacion Guardada', 'Guardada exitosamente', {
                timeOut: 1700,
                preventDuplicates: true,
            });
                   
              $('#modalAgregarCotizacion').modal('toggle');  
            }else{
              
              var spinHandle = loadingOverlay().activate(); // activar loading
              toastr.success('Cotizacion Guardada', 'Guardada exitosamente', {
                timeOut: 1700,
                preventDuplicates: true,
                // Redirect 
                onHidden: function() {
                  window.location.href = url+'load_cotizaciones_pendientes';
                }
            });
                    
             
            }
            //console.log(response);
          })
          .catch(function (error) {
            console.log(error);
          });
        }

        function removeOptionsFromSelect(selectElement) {
          var i, L = selectElement.options.length - 1;
          for(i = L; i >= 0; i--) {
              selectElement.remove(i);
          }
        }


    });
</script>

<!-- Multi Select CDN -->
<script src="https://cdn.rawgit.com/crlcu/multiselect/master/dist/js/multiselect.min.js"></script>

@stop