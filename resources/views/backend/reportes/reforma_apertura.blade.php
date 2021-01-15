<style type="text/css">
input {
	border-width:1px;  border:none;
	}
.ordenInput{
	display: block;    
} 
.table-body{
	width: 100%;
}
.table-head{
	width: 100%;
}
.table-head td{
	font-family:Arial, sans-serif; font-size:14px;
}
.table-body td{
	font-family:Arial, sans-serif; font-size:14px;
}
</style>
<table  class="table-head" style="margin-top: -10px;">
  <tr>
    <td width="20%"><img style="margin-top: -20px; "src="{{ asset('/images/logo.png') }}" width="50px" height="50px"></td>
    <td width="80%" style="text-align:center; margin-left: -10px;"><h3>REPROGRAMACION PRESUPUESTARIA</h3>
	<br><br>
	</td>
  </tr>
</table>
<table class="table-body" border="1" cellspacing=0 >
	<tr>
        <td colspan="2">
			<label style="font-weight: bold; vertical-align:middle;">C&oacute;digo de Proyecto:</label>
			<input type="text" style="width:70%;" value="{{ $proyecto->codigo }}">
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<label style="font-weight: bold; vertical-align:middle;">Nombre de Proyecto:</label>
			<input type="text" style="width:70%;"  value="{{ $proyecto->nombre }}">
		</td>
	</tr>
    <tr>
		<td colspan="2">
			<label style="font-weight: bold; vertical-align:middle;">&Aacute;rea de Gesti&oacute;n:</label>
			<input type="text" style="width:70%;" value="{{ $proyecto->areagestion }}">
		</td>
	</tr>
    <tr>
		<td colspan="2">
			<label style="font-weight: bold; vertical-align:middle;">Linea de Trabajo:</label>
			<input type="text" style="width:70%;" value="{{ $proyecto->linea }}">
		</td>
	</tr>
    <tr>
		<td colspan="2">
			<label style="font-weight: bold; vertical-align:middle;">Fuente de Financiamiento:</label>
			<input type="text" style="width:70%;" value="{{ $proyecto->fuentef }}">
		</td>
	</tr>
    <tr>
		<td colspan="2">
			<label style="font-weight: bold; vertical-align:middle;">Sub-Fuente de Financiamiento:</label>
			<input type="text" style="width:70%;" value="{{ $proyecto->fuenter }}">
		</td>
	
	</tr>
    <tr>
		<td colspan="2">
			<label style="font-weight: bold; vertical-align:middle;">Tipo:</label>
			<input type="text" style="width:70%;" value="">
		</td>
	
	</tr>
    <tr>
		<td colspan="2">
			<label style="font-weight: bold; vertical-align:middle;">Naturaleza:</label>
			<input type="text" style="width:70%;" value="{{ $proyecto->naturaleza }}">
		</td>
	
	</tr>
    <tr>
		<td colspan="2">
			<label style="font-weight: bold; vertical-align:middle;">Fase:</label>
			<input type="text" style="width:70%;" value="">
		</td>
	
	</tr>
    <tr>
		<td colspan="2">
			<label style="font-weight: bold; vertical-align:middle;">Fecha de Inicio:</label>
			<input type="text" style="width:70%;" value="">
		</td>
	</tr>
    <tr>
		<td colspan="2">
			<label style="font-weight: bold; vertical-align:middle;">Calificacion del Gasto:</label>
			<input type="text" style="width:70%;" value="">
		</td>
	</tr>
</table>
<table class="table-body">

<tr>
  	<td width="60%" colspan="1">
		<input type="text" style="width:100%" value="">
	</td>
	<td width="40%" colspan="1">
		<input type="text" style="width:85%; text-align:right;" value="">
	</td>
</tr>

<tr>
  	<td colspan="1">
		
	</td>
</tr>
</table>
<table  class="table-head" style="margin-top: -10px;">
  <tr>
    <td width="100%" style="text-align:center;"><h3>CIFRAS PRESUPUESTARIAS A REPROGRAMAR:</h3>
	<br><br>
	</td>
  </tr>
</table>
<table  class="table-head" style="margin-top: -10px;">
  <tr>
    <td width="100%" style="text-align:center;"><h3>Cuentas de presupuesto que se afectan:</h3>
	<br><br>
	</td>
  </tr>
</table>
<table  class="table-head" style="margin-top: -10px;">
  <tr>
    <td width="15%" style="text-align:center;">COD</td>
    <td width="45%" style="text-align:center;">CUENTA</td>
    <td width="20%" style="text-align:center;">DISMINUYE</td>
    <td width="20%" style="text-align:center;">AUMENTA</td>
  </tr>
  @foreach ($materiales as $val)
  <tr>
  	<td width="15%" style="text-align:center;">{{ $val->codigo }}</td>
    <td width="45%" style="text-align:center;">{{ $val->nombre }}</td>
    <td width="20%" style="text-align:center;"></td>
    <td width="20%" style="text-align:center;">{{ $val->subtotal }}</td>
  </tr>
  @endforeach
</table>
<table  class="table-head" style="margin-top: -10px;">
  <tr>
    <td width="100%" style="text-align:center;"><h3>Cuentas de presupuesto que se refuerzan:</h3>
	<br><br>
	</td>
  </tr>
</table>
<table  class="table-head" style="margin-top: -10px;">
  <tr>
    <td width="15%" style="text-align:center;">COD</td>
    <td width="45%" style="text-align:center;">CUENTA</td>
    <td width="20%" style="text-align:center;">DISMINUYE</td>
    <td width="20%" style="text-align:center;">AUMENTA</td>
  </tr>
  @foreach ($materiales as $val)
  <tr>
  <td width="15%" style="text-align:center;">{{ $val->codigo }}</td>
    <td width="45%" style="text-align:center;">{{ $val->nombre }}</td>
    <td width="20%" style="text-align:center;"></td>
    <td width="20%" style="text-align:center;">{{ $val->subtotal }}</td>
  </tr>
  @endforeach
  <tr>
  <td width="15%" style="text-align:center;">TOTAL</td>
    <td width="45%" style="text-align:center;"></td>
    <td width="20%" style="text-align:center;"></td>
    <td width="20%" style="text-align:center;">$</td>
  </tr>
</table>
