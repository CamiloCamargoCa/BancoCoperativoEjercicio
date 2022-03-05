<?php

include '../../controller/CreditoController.php';
require  __DIR__.'/vendor/autoload.php ' ;

// funcion devuelve el mes siguiente segun numero
function fechas($end) {
    
    if (is_string($end) === true ) $end = strtotime($end);
        
        $fecha = date('Y-m-d');
        $nuevafecha = strtotime ( '+'.$end.' month' , strtotime ( $fecha ) ) ;
        $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
        return $nuevafecha;
    
}


use  Spipu\Html2Pdf\Html2Pdf;
$html2pdf  =  new  Html2Pdf (); 

    $objCre = new CreditoControlador();

    $tipo_cred_id = @$_REQUEST['tipo_cred_id'];
    $tipo_tabla = 0;
    $codigoHTML = '';
    $per_gracias = $objCre->seleccionarTipoCredito($tipo_cred_id);

    foreach ($per_gracias as $key => $per_gracia) {
        $tipo_tabla=$per_gracia['tipo_tabla'];
    }


    //ingreso de variables  
    $monto = (@$_REQUEST['monto']!=0)? (int) str_replace(',','',$_REQUEST['monto']):0;
    $periodico = ($_REQUEST['periodico']!=0)?$_REQUEST['periodico']/100:0;
    $anual = @$_REQUEST['anual'];
    $nominal = @$_REQUEST['nominal'];
    $n_plazos = @$_REQUEST['n_plazos'];
    $n_amorti = @$_REQUEST['n_amorti'];
    $n_gracia = (@$_REQUEST['n_gracia']!=0) ? $_REQUEST['n_gracia']:0;
    $nombres = @$_REQUEST['nombres'];
    $apellidos = @$_REQUEST['apellidos'];
    $identificacion = @$_REQUEST['identificacion'];
    $telefono = @$_REQUEST['telefono'];
    $direccion = @$_REQUEST['direccion'];

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

        <style type="text/css" media="screen">
            table {
              border-collapse: collapse;
              border:1px solid #2F84F7;
              width: 100%;
            }

            th, td {
              text-align: left;
              border:1px solid #2F84F7;
            }
            
           

            th {
              background-color: #2F84F7;
              color: white;
            }
        </style>
        <h1>Banco Coperativo</h1>
        <br>
        <h3>Datos de Usuario</h3>
        <table style="text-align:center;">
            <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Direccion</th>
                    <th>Identificacion</th>
                    <th>Telefono</th>
                    <th>Monto</th>
                    <th>Interes Periodico</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>'.$nombres.'</td>
                    <td>'.$apellidos.'</td>
                    <td>'.$direccion.'</td>
                    <td>'.$identificacion.'</td>
                    <td>'.$telefono.'</td>
                    <td>'.$_REQUEST['monto'].'</td>
                    <td>'.$_REQUEST['periodico'].'</td>
                </tr>
            </tbody>
        </table>
        <br>
        <h3>Credito Con periodo de Gracia</h3>
        <table class="table table-hover">
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

                // // saldo a capital
                // if ($i==0) {
                //     $saldoCapital=$monto;
                //     $cadena3.='<td>'.$saldoCapital.'</td>';
                // }elseif ($i<=$n_periodosGracia) {
                //     $saldoCapital=$monto;
                //     $cadena3.='<td>'.$saldoCapital.'</td>';
                // }elseif ($i==$n_periodosGracia+1) {
                //     $saldoCapital=$saldoCapital-($monto/$n_restantes);
                //     $cadena3.='<td>'.$saldoCapital.'</td>';
                // }elseif ($i>$n_periodosGracia+1) {
                //     $saldoCapital=$saldoCapital-$amortCapital;
                //     $cadena3.='<td>'.$saldoCapital.'</td>';
                // }
                // // amortizacion a capital
                // if ($i==0) {
                //     $amortCapital=0;
                //     $cadena3.='<td>'.$amortCapital.'</td>';
                // }elseif ($i<=$n_periodosGracia) {
                //     $amortCapital=0;
                //     $cadena3.='<td>'.$amortCapital.'</td>';
                // }elseif ($i>$n_periodosGracia){
                //     $amortCapital=$monto/$n_restantes;
                //     $cadena3.='<td>'.$amortCapital.'</td>';
                // }
                // // amortizacion a interes
                // if ($i==0) {
                //     $amortInteres=0;
                //     $cadena3.='<td>'.$amortInteres.'</td>';
                // }elseif ($i<=$n_periodosGracia) {
                //     $amortInteres=$saldoCapital*$periodico;
                //     $cadena3.='<td>'.$amortInteres.'</td>';
                // }elseif ($i==$n_periodosGracia+1) {
                //     $amortInteres=$monto*$periodico;
                //     $cadena3.='<td>'.$amortInteres.'</td>';
                // }elseif ($i>$n_periodosGracia+1) {
                //     $amortInteres=($saldoCapital+$amortCapital)*$periodico;
                //     $cadena3.='<td>'.$amortInteres.'</td>';
                // }
                // // flujo de caja
                // if ($i==0) {
                //     $flujoCapital=$monto;
                //     $cadena3.='<td>'.$flujoCapital.'</td>';
                // }elseif ($i<=$n_periodosGracia) {
                //     $flujoCapital=$amortCapital+$amortInteres;
                //     $cadena3.='<td> -('.$flujoCapital.')</td>';
                // }elseif($i>$n_periodosGracia){
                //     $flujoCapital=$amortCapital+$amortInteres;
                //     $cadena3.='<td>'.$flujoCapital.'</td>';
                // }

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
        <style type="text/css" media="screen">
            table {
              border-collapse: collapse;
              border:1px solid #2F84F7;
              width: 100%;
            }

            th, td {
              text-align: left;
              border:1px solid #2F84F7;
            }
            
           

            th {
              background-color: #2F84F7;
              color: white;
            }
        </style>

        <h1>Banco Coperativo</h1>   
        <br>
        <h3>Datos de Usuario</h3>
        <table style="text-align:center;">
            <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Direccion</th>
                    <th>Identificacion</th>
                    <th>Telefono</th>
                    <th>Monto</th>
                    <th>Interes Periodico</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>'.$nombres.'</td>
                    <td>'.$apellidos.'</td>
                    <td>'.$direccion.'</td>
                    <td>'.$identificacion.'</td>
                    <td>'.$telefono.'</td>
                    <td>'.$_REQUEST['monto'].'</td>
                    <td>'.$_REQUEST['periodico'].'</td>
                </tr>
            </tbody>
        </table>
        <br>
        <h3>Credito Cuota Fija</h3>
        <table class="table table-hover">
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

                // // saldo a capital
                // if ($i==0) {
                //     $saldoCapital=$monto;
                //     $cadena4.='<td>'.$saldoCapital.'</td>';
                // }elseif ($i<=$n_periodosGracia) {
                //     $saldoCapital=$monto;
                //     $cadena4.='<td>'.$saldoCapital.'</td>';
                // }elseif ($i==$n_periodosGracia+1) {
                //     $saldoCapital=$saldoCapital-($anualidad-($monto*$periodico));
                //     $saldoCapitalTemp=$saldoCapital;
                //     $cadena4.='<td>'.$saldoCapital.'</td>';
                // }elseif ($i>$n_periodosGracia+1) {
                //     $saldoCapitalTemp=$saldoCapital;
                //     $saldoCapital=$saldoCapital-($cuotaFija-($saldoCapitalTemp*$periodico));
                //     $cadena4.='<td>'.$saldoCapital.'</td>';
                // }
                // // amortizacion a capital
                // if ($i==0) {
                //     $amortCapital=0;
                //     $cadena4.='<td>'.$amortCapital.'</td>';
                // }elseif ($i<=$n_periodosGracia) {
                //     $amortCapital=0;
                //     $cadena4.='<td>'.$amortCapital.'</td>';
                // }elseif ($i==$n_periodosGracia+1) {
                //     $amortCapital=$anualidad-($monto*$periodico);
                //     $cadena4.='<td>'.$amortCapital.'</td>';
                // }elseif ($i>$n_periodosGracia){
                //     $amortCapital=$cuotaFija-($saldoCapitalTemp*$periodico);
                //     $cadena4.='<td>'.$amortCapital.'</td>';
                // }
                // // amortizacion a interes
                // if ($i==0) {
                //     $amortInteres=0;
                //     $cadena4.='<td>'.$amortInteres.'</td>';
                // }elseif ($i<=$n_periodosGracia) {
                //     $amortInteres=$saldoCapital*$periodico;
                //     $cadena4.='<td>'.$amortInteres.'</td>';
                // }elseif ($i==$n_periodosGracia+1) {
                //     $amortInteres=$monto*$periodico;
                //     $cadena4.='<td>'.$amortInteres.'</td>';
                // }elseif ($i>$n_periodosGracia+1) {
                //     $amortInteres=$saldoCapitalTemp*$periodico;
                //     $cadena4.='<td>'.$amortInteres.'</td>';
                // }
                // // cuota fija
                // if ($i==0) {
                //     $cuotaFija=0;
                //     $cadena4.='<td>'.$cuotaFija.'</td>';
                // }elseif ($i<=$n_periodosGracia) {
                //     $cuotaFija=0;
                //     $cadena4.='<td>'.$cuotaFija.'</td>';
                // }elseif($i>$n_periodosGracia){
                //     $cuotaFija=$anualidad;
                //     $cadena4.='<td>'.$cuotaFija.'</td>';
                // }
                // // flujo de caja
                // if ($i==0) {
                //     $flujoCapital=$monto;
                //     $cadena4.='<td>'.$flujoCapital.'</td>';
                // }elseif ($i<=$n_periodosGracia) {
                //     $flujoCapital=$anualidad;
                //     $cadena4.='<td> -('.$flujoCapital.')</td>';
                // }elseif($i>$n_periodosGracia){
                //     $flujoCapital=$anualidad;
                //     $cadena4.='<td>'.$flujoCapital.'</td>';
                // }

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
        // $cadena3.=$nombres.'</br>';
        // $cadena3.=$identificacion.'</br>';
        // $cadena3.=$telefono.'</br>';
        // $cadena3.=$direccion.'</br>';

        $html2pdf->writeHTML($cadena3); 
        
        // echo $cadena3;
        
        
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
        // $cadena4.=$nombres.'</br>';
        // $cadena4.=$apellidos.'</br>';
        // $cadena4.=$identificacion.'</br>';
        // $cadena4.=$telefono.'</br>';
        // $cadena4.=$direccion.'</br>';

        $html2pdf->writeHTML($cadena4); 
        
        // echo $cadena4;

    }

        $html2pdf->output();






    
?>