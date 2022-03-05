<?php  

include '../../controller/CreditoController.php';
$objCre = new CreditoControlador();

$opcion = @$_POST['tipoOpc'];
$opcion1 = @$_POST['tipoOpc1'];
$opcion2 = @$_POST['tipoOpc2'];
$opcion3 = @$_POST['tipoOpc3'];


// ------------------------------------------------------------------------------------------------------
// -------Mostrar Plazos---------------------------------------------------------------------------------
if ($opcion==1) {
	$tipo_cred_id = @$_POST['tipo_cred_id'];

	$cadena="<h4>Plazos</h4>
			<select name='n_plazos' id='n_plazos' class='form-control'>";

	$plazos = $objCre->listarPlazo($tipo_cred_id);

	if (count($plazos)>0) {
		
		foreach ($plazos as $key => $plazo) {
			$cadena .= '<option value="'.$plazo['valor'].'">'.$plazo['valor'].' '.$plazo['tiempo'].'</option>';
		}

	}else{

		$cadena .= '<option value="" disabled selected>No Hay Opciones</option>';

	}

	echo $cadena."</select>";
	
}


// -------------------------------------------------------------------------------------------------------
// --------Mostrar Amortizaciones-------------------------------------------------------------------------
if ($opcion1==1) {
	$tipo_cred_id = @$_POST['tipo_cred_id'];

	// echo $tipo_cred_id;

	$cadena1="<h4>Amortizacion</h4>
			<select name='n_amorti' id='n_amorti' class='form-control'>";

	$amortizaciones = $objCre->listarAmortizacion($tipo_cred_id);

	if (count($amortizaciones)) {
		
		foreach ($amortizaciones as $key => $amortizacione) {
			$cadena1 .= '<option value="'.$amortizacione['valor'].'">'.$amortizacione['valor'].' '.$amortizacione['tiempo'].'-'.$amortizacione['nombre'].'</option>';
		}

	}else{

		$cadena1 .= '<option value="" disabled selected>No Hay Opciones</option>';
		
	}

	echo $cadena1."</select>";
	
}


// -------------------------------------------------------------------------------------------------------
// --------Mostrar Periodo de Gracia----------------------------------------------------------------------
if ($opcion2==1) {
	$tipo_cred_id = @$_POST['tipo_cred_id'];
	$valor_gracia=0;
	// echo $tipo_cred_id;

	$per_gracias = $objCre->seleccionarTipoCredito($tipo_cred_id);
	foreach ($per_gracias as $key => $per_gracia) {
		$valor_gracia=$per_gracia['ap_gracia'];
	}

	$cadena2="<h4>Periodo Gracia</h4>
			<select name='n_gracia' id='n_gracia' class='form-control'>";

	if ($valor_gracia==1) {

		$cadena2 .="<option value=''>Seleccione Una Opcion</option>
	      			<option value='24'>24 Meses</option>
	      			<option value='36'>36 Meses</option>";
	}else{

		$cadena2 .= '<option value="" disabled selected>No Hay Opciones</option>';
		
	}


	echo $cadena2."</select>";
	
}


// -------------------------------------------------------------------------------------------------------
// --------Mostrar Tablas de pagos----------------------------------------------------------------------
if ($opcion3==1) {

	$tipo_cred_id = @$_POST['tipo_cred_id'];
	$tipo_tabla = 0;
	$per_gracias = $objCre->seleccionarTipoCredito($tipo_cred_id);

	foreach ($per_gracias as $key => $per_gracia) {
		$tipo_tabla=$per_gracia['tipo_tabla'];
	}


	//ingreso de variables	
	$monto = (@$_POST['monto']!=0)? (int) str_replace(',','',$_POST['monto']):0;
	$periodico = ($_POST['periodico']!=0)?$_POST['periodico']/100:0;
	$anual = @$_POST['anual'];
	$nominal = @$_POST['nominal'];
	$n_plazos = @$_POST['n_plazos'];
	$n_amorti = @$_POST['n_amorti'];
	$n_gracia = (@$_POST['n_gracia']!=0) ? $_POST['n_gracia']:0;

	//caloculo de periodos
	$n_plazosmulti = (isset($n_plazos) && $n_plazos!=0)?$n_plazos*30:0;
	$n_graciamulti = (isset($n_gracia) && $n_gracia!=0)?$n_gracia*30:0;
	$n_periodos = ($n_plazosmulti > 0) ? $n_plazosmulti/$n_amorti:0;
	$n_periodosGracia = ($n_graciamulti > 0) ? $n_graciamulti/$n_amorti:0;
	$n_restantes = $n_periodos-$n_periodosGracia;
	$cadena3='';
	$cadena4='';
	$anualidad = 0;

	// credito cuota fija con pagos iguales a capital tipo 1 en tabla pago
	if ($tipo_tabla==1) {
		$cadena3 ='
		<table class="table table-hover">
			<caption><b>Credito Con periodo de Gracia</b></caption>
			<thead>
				<tr>
					<th>Cuotas</th>
					<th>Fechas</th>
					<th>Saldo a Capital</th>
					<th>Amortización a Capital</th>
					<th>Amortización Interes</th>
					<th>Flujo de Caja</th>
				</tr>
			</thead>
			<tbody>';
				

		// saldo a capital
		$saldoCapital = 0;
		// amortizacion a capital
		$amortCapital = 0;
		// amortizacion a interes
		$amortInteres = 0;
		// flujo de caja
		$flujoCapital = 0;



		for ($i=0; $i <= $n_periodos; $i++) { 

			$cadena3.='
				<tr class="table-primary">

					<td>'.($i).'</td>

					<td>'.fechas($i).'</td>';

				// saldo a capital
				if ($i==0) {
					$saldoCapital=$monto;
					$cadena3.='<td>'.number_format($saldoCapital,2,'.',',').'</td>';
				}elseif ($i<=$n_periodosGracia) {
					$saldoCapital=$monto;
					$cadena3.='<td>'.number_format($saldoCapital,2,'.',',').'</td>';
				}elseif ($i==$n_periodosGracia+1) {
					$saldoCapital=$saldoCapital-($monto/$n_restantes);
					$cadena3.='<td>'.number_format($saldoCapital,2,'.',',').'</td>';
				}elseif ($i>$n_periodosGracia+1) {
					$saldoCapital=$saldoCapital-$amortCapital;
					$cadena3.='<td>'.number_format($saldoCapital,2,'.',',').'</td>';
				}
				// amortizacion a capital
				if ($i==0) {
					$amortCapital=0;
					$cadena3.='<td>'.number_format($amortCapital,2,'.',',').'</td>';
				}elseif ($i<=$n_periodosGracia) {
					$amortCapital=0;
					$cadena3.='<td>'.number_format($amortCapital,2,'.',',').'</td>';
				}elseif ($i>$n_periodosGracia){
					$amortCapital=$monto/$n_restantes;
					$cadena3.='<td>'.number_format($amortCapital,2,'.',',').'</td>';
				}
				// amortizacion a interes
				if ($i==0) {
					$amortInteres=0;
					$cadena3.='<td>'.number_format($amortInteres,2,'.',',').'</td>';
				}elseif ($i<=$n_periodosGracia) {
					$amortInteres=$saldoCapital*$periodico;
					$cadena3.='<td>'.number_format($amortInteres,2,'.',',').'</td>';
				}elseif ($i==$n_periodosGracia+1) {
					$amortInteres=$monto*$periodico;
					$cadena3.='<td>'.number_format($amortInteres,2,'.',',').'</td>';
				}elseif ($i>$n_periodosGracia+1) {
					$amortInteres=($saldoCapital+$amortCapital)*$periodico;
					$cadena3.='<td>'.number_format($amortInteres,2,'.',',').'</td>';
				}
				// flujo de caja
				if ($i==0) {
					$flujoCapital=$monto;
					$cadena3.='<td>'.number_format($flujoCapital,2,'.',',').'</td>';
				}elseif ($i<=$n_periodosGracia) {
					$flujoCapital=$amortCapital+$amortInteres;
					$cadena3.='<td>-('.number_format($flujoCapital,2,'.',',').')</td>';
				}elseif($i>$n_periodosGracia){
					$flujoCapital=$amortCapital+$amortInteres;
					$cadena3.='<td>'.number_format($flujoCapital,2,'.',',').'</td>';
				}
					
			$cadena3.='</tr>';
					
		}

		$cadena3 .='
				
			</tbody>
		</table>';
	}elseif ($tipo_tabla==2) {

		$anualidad = $monto*((pow((1+$periodico),$n_restantes)*$periodico)/((pow((1+$periodico),$n_restantes)-1)));

		$cadena4 ='
		<table class="table table-hover">
			<caption><b>Credito Cuota Fija</b></caption>
			<thead>
				<tr>
					<th>Cuotas</th>
					<th>Fechas</th>
					<th>Saldo a Capital</th>
					<th>Amortización a Capital</th>
					<th>Amortización Interes</th>
					<th>Cuota Fija</th>
					<th>Flujo de Caja</th>
				</tr>
			</thead>
			<tbody>';
				

		// saldo a capital
		$saldoCapital = 0;
		// amortizacion a capital
		$amortCapital = 0;
		// amortizacion a interes
		$amortInteres = 0;
		// cuota fija
		$cuotaFija = 0;
		// flujo de caja
		$flujoCapital = 0;
		//saldo temporal
		$saldoCapitalTemp = 0;
		//interes temporal
		$amortInteresTemp = 0;

		for ($i=0; $i <= $n_periodos; $i++) { 

			$cadena4.='
				<tr class="table-primary">

					<td>'.($i).'</td>

					<td>'.fechas($i).'</td>';

				// saldo a capital
				if ($i==0) {
					$saldoCapital=$monto;
					$cadena4.='<td>'.number_format($saldoCapital,2,'.',',').'</td>';
				}elseif ($i<=$n_periodosGracia) {
					$saldoCapital=$monto;
					$cadena4.='<td>'.number_format($saldoCapital,2,'.',',').'</td>';
				}elseif ($i==$n_periodosGracia+1) {
					$saldoCapital=$saldoCapital-($anualidad-($monto*$periodico));
					$saldoCapitalTemp=$saldoCapital;
					$cadena4.='<td>'.number_format($saldoCapital,2,'.',',').'</td>';
				}elseif ($i>$n_periodosGracia+1) {
					$saldoCapitalTemp=$saldoCapital;
					$saldoCapital=$saldoCapital-($cuotaFija-($saldoCapitalTemp*$periodico));
					$cadena4.='<td>'.number_format($saldoCapital,2,'.',',').'</td>';
				}
				// amortizacion a capital
				if ($i==0) {
					$amortCapital=0;
					$cadena4.='<td>'.number_format($amortCapital,2,'.',',').'</td>';
				}elseif ($i<=$n_periodosGracia) {
					$amortCapital=0;
					$cadena4.='<td>'.number_format($amortCapital,2,'.',',').'</td>';
				}elseif ($i==$n_periodosGracia+1) {
					$amortCapital=$anualidad-($monto*$periodico);
					$cadena4.='<td>'.number_format($amortCapital,2,'.',',').'</td>';
				}elseif ($i>$n_periodosGracia){
					$amortCapital=$cuotaFija-($saldoCapitalTemp*$periodico);
					$cadena4.='<td>'.number_format($amortCapital,2,'.',',').'</td>';
				}
				// amortizacion a interes
				if ($i==0) {
					$amortInteres=0;
					$cadena4.='<td>'.number_format($amortInteres,2,'.',',').'</td>';
				}elseif ($i<=$n_periodosGracia) {
					$amortInteres=$saldoCapital*$periodico;
					$cadena4.='<td>'.number_format($amortInteres,2,'.',',').'</td>';
				}elseif ($i==$n_periodosGracia+1) {
					$amortInteres=$monto*$periodico;
					$cadena4.='<td>'.number_format($amortInteres,2,'.',',').'</td>';
				}elseif ($i>$n_periodosGracia+1) {
					$amortInteres=$saldoCapitalTemp*$periodico;
					$cadena4.='<td>'.number_format($amortInteres,2,'.',',').'</td>';
				}
				// cuota fija
				if ($i==0) {
					$cuotaFija=0;
					$cadena4.='<td>'.number_format($cuotaFija,2,'.',',').'</td>';
				}elseif ($i<=$n_periodosGracia) {
					$cuotaFija=0;
					$cadena4.='<td>'.number_format($cuotaFija,2,'.',',').'</td>';
				}elseif($i>$n_periodosGracia){
					$cuotaFija=$anualidad;
					$cadena4.='<td>'.number_format($cuotaFija,2,'.',',').'</td>';
				}
				// flujo de caja
				if ($i==0) {
					$flujoCapital=$monto;
					$cadena4.='<td>'.number_format($flujoCapital,2,'.',',').'</td>';
				}elseif ($i<=$n_periodosGracia) {
					$flujoCapital=$anualidad;
					$cadena4.='<td>-('.number_format($flujoCapital,2,'.',',').')</td>';
				}elseif($i>$n_periodosGracia){
					$flujoCapital=$anualidad;
					$cadena4.='<td>'.number_format($flujoCapital,2,'.',',').'</td>';
				}
					
			$cadena4.='</tr>';
					
		}

		$cadena4 .='
				
			</tbody>
		</table>';
	}
		

	if ($tipo_tabla==1) {
	
		// $cadena3.=$tipo_cred_id.'</br>';
		// $cadena3.=$monto.'</br>';
		// $cadena3.=$periodico.'</br>';
		// $cadena3.=$anual.'</br>';
		// $cadena3.=$nominal.'</br>';
		// $cadena3.=$n_plazos.'</br>';
		// $cadena3.=$n_amorti.'</br>';
		// $cadena3.=$n_gracia.'</br>';
		// $cadena3.=$n_plazosmulti.'</br>';
		// $cadena3.=$n_periodos.'</br>';
		// $cadena3.=$n_periodosGracia.'</br>';
		// $cadena3.=$n_restantes.'</br>';
		// $cadena3.=$anualidad.'</br>';
		
		echo $cadena3;
	}elseif ($tipo_tabla==2) {
		// $cadena4.=$tipo_cred_id.'</br>';
		// $cadena4.=$monto.'</br>';
		// $cadena4.=$periodico.'</br>';
		// $cadena4.=$anual.'</br>';
		// $cadena4.=$nominal.'</br>';
		// $cadena4.=$n_plazos.'</br>';
		// $cadena4.=$n_amorti.'</br>';
		// $cadena4.=$n_gracia.'</br>';
		// $cadena4.=$n_plazosmulti.'</br>';
		// $cadena4.=$n_periodos.'</br>';
		// $cadena4.=$n_periodosGracia.'</br>';
		// $cadena4.=$n_restantes.'</br>';
		// $cadena4.=$anualidad.'</br>';
		echo $cadena4;
	}

	

	
}

// funcion devuelve el mes siguiente segun numero
function fechas($end) {
    
    if (is_string($end) === true ) $end = strtotime($end);
    	
    	$fecha = date('Y-m-d');
		$nuevafecha = strtotime ( '+'.$end.' month' , strtotime ( $fecha ) ) ;
		$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
		return $nuevafecha;
    
}

?>