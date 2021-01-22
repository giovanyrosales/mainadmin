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
    <td width="80%" style="text-align:left; margin-left: -10px;"><h3>REPORTE DE MATERIALES A COTIZAR</h3>
	<br><br>
	</td>
  </tr>
</table>
<br>
<table class="table-body" cellspacing=0 >
	<tr>
        <td colspan="2">
			<label style="font-weight: bold; vertical-align:middle;">Proyecto:</label>
			<input type="text" style="width:70%;" value="{{ $proyecto->nombre }}">
		</td>
	</tr>
</table>
<br>
<table  class="table-head" style="margin-top: -10px;">
  <tr>
    <td width="100%" style="text-align:center;"><h3>MATERIALES DE FERRETERIA:</h3>
	<br><br>
	</td>
  </tr>
</table>
<table  class="table-head" style="margin-top: -10px;">
  <tr>
    <td width="15%" style="text-align:center;">CANTIDAD</td>
    <td width="45%" style="text-align:center;">DESCRIPCION</td>
  </tr>
  <tr>
  	<td width="15%" style="text-align:center;"></td>
    <td width="45%" style="text-align:center;"></td>
  </tr>
</table>

