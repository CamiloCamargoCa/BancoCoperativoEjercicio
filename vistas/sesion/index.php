
<?php 
	include '../../controller/CreditoController.php'; 
	$objCre = new CreditoControlador(); 
?>


<!DOCTYPE html>
<html lang="es">

  <head>
  <?php session_start();  ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Banco Coperativo Industrial</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../../plugins/bootstrap-4.3.1-dist/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../../plugins/font-awesome-4.7.0/css/font-awesome.min.css">
    

  </head>

  <body>
<?php include '../layouts/menu.php'; ?>  

	<!-- Mensajes -->
	<div class="container-fluid">
		<br>
		<!-- Mensajes -->
		<?php 
		$mensaje = @$_REQUEST['men'];
		if ($mensaje==1) { ?>
			<div class="alert alert-success" role="alert">
			  	<b>Bienvenido!</b>
			  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    	<span aria-hidden="true">&times;</span>
			  	</button>
			</div>
		<?php }elseif($mensaje==2) { ?>
			<div class="alert alert-danger" role="alert">
			  	<b>Datos de acceso incorrectos!</b>
			  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    	<span aria-hidden="true">&times;</span>
			  	</button>
			</div>
		<?php }elseif($mensaje==3) { ?>
			<div class="alert alert-secondary" role="alert">
				<b>Sesion Cerrada!</b>
			  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    	<span aria-hidden="true">&times;</span>
			  	</button>
			</div>
		<?php }else{} ?>

		<center><h1>Banco Coperativo Industrial</h1></center>
		<center><h3>Calcule su credito</h3></center>
		
	</div>

	<!-- Modal Inicio de sesion	 -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	    	<form action="login.php" method="post">	
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLongTitle">Ingreso</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <div class="form-group">
				  <label class="col-form-label" for="inputDefault">Usuario</label>
				  <input type="text" class="form-control" placeholder="Usuario" name="txtusuario"  required="">
				</div>
		        <div class="form-group">
				  <label class="col-form-label" for="inputDefault">Contraseña</label>
				  <input type="password" class="form-control" placeholder="Contraseña" name="txtcontrasena"  required="">
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		        <input type="submit" class="btn btn-primary" value="Enviar">
		      </div>
	      </form>
	    </div>
	  </div>
	</div>

	<!-- Contenedor Calculo de credito -->
	<div class="container-fluid">

		<form action="index.php" method="post">
		
			<h4>Datos Cliente</h4>
			<div class="row">
				
				<div class="form-group col-12 col-sm-4">
			      <label>Nombres</label>
			      <input type="text" class="form-control" name="nombres" id="nombres" required="" >
				
			    </div>

			    <div class="form-group col-12 col-sm-4">
			      <label>Apellidos</label>
			      <input type="text" class="form-control" name="apellidos" id="apellidos" required="" >
			    </div>			
				
				<div class="form-group col-12 col-sm-4">
			      <label>Identificación</label>
			      <input type="text" class="form-control" name="identificacion" id="identificacion" required="" >
			    </div>

			    <div class="form-group col-12 col-sm-4">
			      <label>Telefono</label>
			      <input type="number" class="form-control" name="telefono" id="telefono" required="" >
			    </div>

			    <div class="form-group col-12 col-sm-4">
			      <label>Dirección</label>
			      <input type="text" class="form-control" name="direccion" id="direccion" required="" >
			    </div>

			    <div class="form-group col-12 col-sm-4">
				    <div class="input-group mt-4">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">COP &nbsp;&nbsp;$</span>
					  </div>
					  <input type="text" class="form-control" name="monto" id="monto">
					</div>
				</div>

			    <!-- <div class="form-group col-12 col-sm-4">
			      <label>Monto</label>
			      $COL:<input type="number" min="0.00"  step="000" class="form-control" name="monto" required="" >
			    </div>-->

			  
		
			</div>

			<div class="row">

				<div class="form-group col-12 col-sm-6 col-md-3">
					<h4>Tipo Credito</h4>
			      	<select name="tipo_cred_id" id="tipo_cred_id" class="form-control" required="" >
			      		<option value="" disabled selected="">Seleccione Una Opcion</option>
				      	<?php
							$creditos = $objCre->listarTipoCredito(); 
							foreach ($creditos as $key => $credito) {
								echo '<option value="'.$credito['id_tipo_cre'].'">'.$credito['nombre_credito'].'</option>
								option';
							}
					 	?>
					</select>
			    </div>

				<!-- PlaZos -->
				<div class="form-group col-12 col-sm-6 col-md-3" id="listPlazos"></div>

				<!-- Amortizaciones -->
				<div class="form-group col-12 col-sm-6 col-md-3" id="listAmortizacion"></div>

				<!-- Periodo Gracia -->
				<div class="form-group col-12 col-sm-6 col-md-3" id="listGracia"></div>


			</div>

				<h4>Intereses</h4><br>
				

			<div class="row">
				<div class="form-group col-12 col-sm-4">
			      <label>IP.Interes Periodico</label>
			      <input type="number" class="form-control" name="periodico" readonly="" title="Numero + Entr para calcular" step="0.01" required="" id="periodico">
			    </div>

			    <div class="form-group col-12 col-sm-4">
			      <label>EA.Efectivo Anual</label>
			      <input type="number" class="form-control" name="anual" readonly="" title="Numero + Entr para calcular" step="0.01" required="" id="anual">
			    </div>

			    <div class="form-group col-12 col-sm-4">
			      <label>IN.Interes Nomina</label>
			      <input type="number" class="form-control" name="nominal" readonly="" title="Numero + Entr para calcular" step="0.01" required="" id="nominal">
			    </div>

			</div>

			<div class="row">
				
				<button type="button" class="btn btn-primary" onclick="calcularTabla()">Calcular</button>
				<button type="button" class="btn btn-secondary" id="pdf">PDF</button>
				<button type="button" class="btn btn-success" id="excel">EXCEL</button>
				<!-- <button type="button" class="btn btn-info">Guardar</button> -->

			</div>

		</form>

		<br>
		<div class="row">
			<!-- Periodo Gracia -->
			<div class="form-group col-12" id="tabla"></div>
		</div>

	</div>


<?php include '../layouts/footer.php'; ?>
<script type="text/javascript">
	
	$(document).ready(function() {
		// recargarLista();
		$('#tipo_cred_id').change(function() {
			recargarLista();
			$("#periodico").removeAttr("readonly");
			$("#anual").removeAttr("readonly");
			$("#nominal").removeAttr("readonly");
		});

		// calcular a partir de interes periodico
		$("#periodico").keyup(function(e){ 

			//error al ingresar punto
			if (e.keyCode==190) {
				alert('Por favor separe decimales con comas , ');
				$("#periodico").val('');
			}

			if (e.keyCode == 13 ) { 

	    		var periodico = $("#periodico").val();
				var n_amorti = $("#n_amorti").val();
				var numElevacion = 0;
				var multiplicador = calIntereses();
				var efectAnual = 0;
				var efectNominal = 0;
				var efectPeriodica = 0;

				numElevacion = 360/n_amorti;
				efectPeriodica = periodico;
				efectAnual = (Math.pow((1+(periodico/100)), numElevacion)-1)*100;
				efectNominal = efectPeriodica * multiplicador;

				var ea = parseFloat(efectAnual).toFixed(2);
				var ip = parseFloat(efectPeriodica).toFixed(2);
				var en = parseFloat(efectNominal).toFixed(2);

				$("#periodico").val(ip);
				$("#anual").val(ea);
				$("#nominal").val(en);
			}

		});

		// calcular a partir de efectivo anual
		$("#anual").keyup(function(e){ 

			//error al ingresar punto
			if (e.keyCode==190) {
				alert('Por favor separe decimales con comas , ');
				$("#anual").val('');
			}

			if (e.keyCode == 13 ) { 

	    		var anual = $("#anual").val();
				var n_amorti = $("#n_amorti").val();
				var numElevacion1 = 0;
				var multiplicador = calIntereses();
				var efectAnual = 0;
				var efectNominal = 0;
				var efectPeriodica = 0;

				numElevacion1 = n_amorti/360;
				efectAnual = anual;
				efectPeriodica = (Math.pow((1+(efectAnual/100)), numElevacion1)-1)*100;
				efectNominal = efectPeriodica * multiplicador;

				var ea = parseFloat(efectAnual).toFixed(2);
				var ip = parseFloat(efectPeriodica).toFixed(2);
				var en = parseFloat(efectNominal).toFixed(2);

				$("#periodico").val(ip);
				$("#anual").val(ea);
				$("#nominal").val(en);

			}

		});


		// calcular a partir de efectivo nominal
		$("#nominal").keyup(function(e){

			//error al ingresar punto
			if (e.keyCode==190) {
				alert('Por favor separe decimales con comas , ');
				$("#nominal").val('');
			}

			if (e.keyCode == 13 ) { 

	    		var nominal = $("#nominal").val();
				var n_amorti = $("#n_amorti").val();
				var numElevacion2 = 0;
				var multiplicador = calIntereses();
				var efectAnual = 0;
				var efectNominal = 0;
				var efectPeriodica = 0;

				efectNominal = nominal
				efectPeriodica = nominal/multiplicador;
				numElevacion2 = 360/n_amorti;
				efectAnual = (Math.pow((1+(efectPeriodica/100)), numElevacion2)-1)*100;

				var ea = parseFloat(efectAnual).toFixed(2);
				var ip = parseFloat(efectPeriodica).toFixed(2);
				var en = parseFloat(efectNominal).toFixed(2);

				$("#periodico").val(ip);
				$("#anual").val(ea);
				$("#nominal").val(en);

			}
			
		});


		$("#monto").on({
		    "focus": function (event) {
		        $(event.target).select();
		    },
		    "keyup": function (event) {
		        $(event.target).val(function (index, value ) {
		            return value.replace(/\D/g, "")
		                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
		                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
		        });
		    }
		});


		// generar excel
		$('#excel').on('click', function() {
			var tipo_cred_id = $("#tipo_cred_id").val();
			var monto = $("#monto").val();
			var periodico = $("#periodico").val();
			var anual = $("#anual").val();
			var nominal = $("#nominal").val();
			var n_plazos = $("#n_plazos").val();
			var n_amorti = $("#n_amorti").val();
			var n_gracia = $("#n_gracia").val();
			var nombres = $('#nombres').val();
		    var apellidos = $('#apellidos').val();
			var identificacion = $('#identificacion').val();
			var telefono = $('#telefono').val();
			var direccion = $('#direccion').val();

			$(location).attr('href',"excel.php?tipo_cred_id="+tipo_cred_id+"&monto="+monto+"&periodico="+periodico+"&anual="+anual+"&nominal="+nominal+"&n_plazos="+n_plazos+"&n_amorti="+n_amorti+"&n_gracia="+n_gracia+"&nombres="+nombres+"&apellidos="+apellidos+"&identificacion="+identificacion+"&telefono="+telefono+"&direccion="+direccion);
		});

		// generar pdf
		$('#pdf').on('click', function() {
			var tipo_cred_id = $("#tipo_cred_id").val();
			var monto = $("#monto").val();
			var periodico = $("#periodico").val();
			var anual = $("#anual").val();
			var nominal = $("#nominal").val();
			var n_plazos = $("#n_plazos").val();
			var n_amorti = $("#n_amorti").val();
			var n_gracia = $("#n_gracia").val();
			var nombres = $('#nombres').val();
		    var apellidos = $('#apellidos').val();
			var identificacion = $('#identificacion').val();
			var telefono = $('#telefono').val();
			var direccion = $('#direccion').val();

			$(location).attr('href',"pdf.php?tipo_cred_id="+tipo_cred_id+"&monto="+monto+"&periodico="+periodico+"&anual="+anual+"&nominal="+nominal+"&n_plazos="+n_plazos+"&n_amorti="+n_amorti+"&n_gracia="+n_gracia+"&nombres="+nombres+"&apellidos="+apellidos+"&identificacion="+identificacion+"&telefono="+telefono+"&direccion="+direccion);
		});


	});


	// despliega los plazos y la amortizacion en base a tipo de credito
	function recargarLista(){

		var tipo_cred_id = $("#tipo_cred_id").val();
		var tipoOpc = 1;
		var tipoOpc1 = 1;
		var tipoOpc2 = 1;
		$.ajax({
			url: 'operaciones.php',
			type: 'POST',
			data: {tipo_cred_id:tipo_cred_id,tipoOpc:tipoOpc},
			success:function(r){
				$('#listPlazos').html(r);
			}
		});

		$.ajax({
			url: 'operaciones.php',
			type: 'POST',
			data: {tipo_cred_id:tipo_cred_id,tipoOpc1:tipoOpc1},
			success:function(r){
				$('#listAmortizacion').html(r);
			}
		});

		$.ajax({
			url: 'operaciones.php',
			type: 'POST',
			data: {tipo_cred_id:tipo_cred_id,tipoOpc2:tipoOpc2},
			success:function(r){
				$('#listGracia').html(r);
			}
		});
	}

	function calcularTabla(){

		var tipoOpc3 = 1;
		var tipo_cred_id = $("#tipo_cred_id").val();
		var monto = $("#monto").val();
		var periodico = $("#periodico").val();
		var anual = $("#anual").val();
		var nominal = $("#nominal").val();
		var n_plazos = $("#n_plazos").val();
		var n_amorti = $("#n_amorti").val();
		var n_gracia = $("#n_gracia").val();

		$.ajax({
			url: 'operaciones.php',
			type: 'POST',
			data: {tipo_cred_id:tipo_cred_id,tipoOpc3:tipoOpc3,monto:monto,periodico:periodico,anual:anual,
					nominal:nominal,n_plazos:n_plazos,n_amorti:n_amorti,n_gracia:n_gracia},
			success:function(r){
				$('#tabla').html(r);
			}
		});
	}

	// calcula todos los intereses cambiando de amortizacion
	function calIntereses(){

		var n_amorti = $("#n_amorti").val();
		var multiplicador = 0;

		if (n_amorti == 30) {
			multiplicador = 12;
		}else if(n_amorti == 60){
			multiplicador = 6;
		}else if(n_amorti == 90){
			multiplicador = 4;
		}else if(n_amorti == 180){
			multiplicador = 2;
		}else{
			multiplicador = 1;
		}

		return multiplicador;

	}


</script>	
