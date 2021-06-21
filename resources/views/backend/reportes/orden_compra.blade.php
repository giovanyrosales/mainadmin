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
<table  class="table-head" style="margin-top: 10px;">
  <tr>
	<br><br>
    <td width="20%"></td>
    <td width="80%" style="text-align:right; ">
	<br></br>
	<br></br>
			<label style="font-weight: bold; font-size: 25px;  text-align:right;">{{ $proyecto-> codigo }}</label>
	</td>
  </tr>
</table>


<br></br>
<table class="table-body" border="0" cellspacing=0 >
	<tr>
		<td  style=" width: 11%; text-align:right; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:right;"></label>
		</td>
        <td  style=" width: 7%; text-align:center; ">
			<label style="font-weight: bold; vertical-align:middle; font-size: 18px;  text-align:center;">{{ strftime("%d", strtotime($fecha)) }}</label>
		</td>
		<td style=" text-align:center; ">
			<label style="font-weight: bold; vertical-align:middle; font-size: 18px;">{{ strftime("%B", strtotime($fecha)) }}</label>
		</td>
		<td style="width: 13%; text-align:right; ">
			<label style="font-weight: bold; vertical-align:middle; font-size: 18px;">{{ strftime("%y", strtotime($fecha)) }}</label>
		</td>
		<td style="width: 1%; text-align:right; ">
			<label style="font-weight: bold; vertical-align:middle;"></label>
		</td>
	</tr>
</table>

<table class="table-body" border="0" cellspacing=0  style="margin-top:20px">
	<tr>
        <td  style=" width: 12.42%; text-align:right; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:right;"></label>
		</td>
		<td  style=" width: 51.75%; text-align:center; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:center; font-size: 18px;">{{ $proveedor->nombre }}</label>
		</td>
		<td  style=" width: 16.8%; text-align:right; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:right;"></label>
		</td>
		<td  style=" width: 19.08%; text-align:center; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:center; font-size: 15px;">{{ $proveedor->nit }}</label>
		</td>
		
	</tr>
</table>

<br></br>
<br></br>

<?php $total = 0; ?>
<table class="table-body" border="0" cellspacing=0 >
	
	@foreach($det_cotizacion as $item)
	
	<tr style=" height: 30px" >
        <td  style=" width: 8.9%; text-align:center; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:center; font-size: 18px;">{{ $item->cantidad }}</label>
		</td>
		<td  style=" width: 54.1%; text-align:left; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:left; margin-left: 5%; font-size: 18px;">{{ $item->descripcion }} </label>
		</td>
		<td  style=" width: 11.6%; text-align:center; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:center; font-size: 18px;">{{ $item->cod_presup }}</label>
		</td>
		<td  style=" width: 1.6%; text-align:left; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:left; font-size: 18px;">$</label>
		</td>
		<td  style=" width: 9%; text-align:right; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:right; font-size: 18px;">{{ $item->preciounit }}</label>
		</td>
		<td  style=" width: 1%; text-align:right; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:right;"></label>
		</td>
		<td  style=" width: 1.6%; text-align:left; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:left; font-size: 18px;">$</label>
		</td>
		<td  style=" width: 11.2%; text-align:right; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:right; font-size: 18px;">{{ $item->cantidad * $item->preciounit }}</label>
		</td>
		<td  style=" width: 1%; text-align:right; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:right;" value="{{$total = $total + ($item->cantidad * $item->preciounit) }}"></label>
		</td>
		
	</tr>
	@endforeach 
	@for($i = 1; $i < (20-count($det_cotizacion)); ++$i)
	<tr style=" height: 30px" >
        <td  style=" width: 8.9%; text-align:center; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:center; font-size: 18px;"></label>
		</td>
		<td  style=" width: 54.1%; text-align:left; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:left; margin-left: 5%; font-size: 18px;"> </label>
		</td>
		<td  style=" width: 11.6%; text-align:center; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:center; font-size: 18px;"></label>
		</td>
		<td  style=" width: 1.6%; text-align:left; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:left; font-size: 18px;"></label>
		</td>
		<td  style=" width: 9%; text-align:right; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:right; font-size: 18px;"></label>
		</td>
		<td  style=" width: 1%; text-align:right; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:right;"></label>
		</td>
		<td  style=" width: 1.6%; text-align:left; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:left; font-size: 18px;"></label>
		</td>
		<td  style=" width: 11.2%; text-align:right; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:right; font-size: 18px;"></label>
		</td>
		<td  style=" width: 1%; text-align:right; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:right;"></label>
		</td>
		
	</tr>
	@endfor
</table>

<table class="table-body" border="0" cellspacing=0 >
<tr style=" height: 30px" >
        <td  style=" width: 8.9%; text-align:center; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:center; font-size: 18px;"></label>
		</td>
		<td  style=" width: 54.1%; text-align:left; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:left; margin-left: 5%; font-size: 18px;"> </label>
		</td>
		<td  style=" width: 11.6%; text-align:center; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:center; font-size: 18px;"></label>
		</td>
		<td  style=" width: 1.6%; text-align:left; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:left; font-size: 18px;"></label>
		</td>
		<td  style=" width: 9%; text-align:right; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:right; font-size: 18px;">TOTAL</label>
		</td>
		<td  style=" width: 1%; text-align:right; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:right;"></label>
		</td>
		<td  style=" width: 1.6%; text-align:left; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:left; font-size: 18px;">$</label>
		</td>
		<td  style=" width: 11.2%; text-align:right; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:right; font-size: 18px;">{{ $total }}</label>
		</td>
		<td  style=" width: 1%; text-align:right; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:right;"></label>
		</td>	
	</tr>
</table>

<table class="table-body" border="0" cellspacing=0 style="margin-top:20px" >
<tr style=" height: 30px; " >
        <td  style=" width: 63%; text-align:center; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:center; font-size: 18px;">{{$administrador->nombre}}</label>
		</td>
		<td  style=" width: 37%; text-align:center; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:center; margin-left: 5%; font-size: 18px;">{{  $proyecto->codigo}} </label>
		</td>
	</tr>
</table>

<table class="table-body" border="0" cellspacing=0 style="margin-top:20px" >
<tr style=" height: 30px; " >
        <td  style=" width: 100%; text-align:center; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:center; font-size: 18px;">{{$proyecto->nombre}}</label>
		</td>
	</tr>
</table>

<table class="table-body" border="0" cellspacing=0 style="margin-top:20px" >
<tr style=" height: 30px; " >
        <td  style=" width: 100%; text-align:center; ">
			<label style="font-weight: bold; vertical-align:middle; text-align:center; font-size: 18px;">{{$proyecto->ubicacion}}</label>
		</td>
	</tr>
</table>