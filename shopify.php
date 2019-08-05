<?php 
require 'Classes/PHPExcel/IOFactory.php';
require 'conexion.php';
$archivo = 'products_export.xlsx';
$objPHPExcel = PHPExcel_IOFactory::load($archivo);
$objPHPExcel->setActiveSheetIndex(0);
$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
//var_dump($numRows);
$arrStatus = array();
$arrTalla = array();
$arrColor = array();
$arrSKU = array();
$arrExistencia = array();
$arrPrecio = array();
$arrImagen = array();
$arrNombre = array();
$arrTipo = array();
$stus = 0;

echo '<table border=1>
<tr>
<td>Nombre</td>
<td>Tipo</td>
<td>Status</td>
<td>Talla</td>
<td>Color</td>
<td>SKU</td>
<td>Existencia</td>
<td>Precio</td>
<td>Imagen</td>
<td>Imagen+</td>
</tr>';
for ($i=2; $i <= $numRows ; $i++) { 
	$Nombre = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
	$Tipo = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
	$Status = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
	$Color = $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
	$Talla = $objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue();
	$SKU = $objPHPExcel->getActiveSheet()->getCell('N'.$i)->getCalculatedValue();
	$Existencia = $objPHPExcel->getActiveSheet()->getCell('Q'.$i)->getCalculatedValue();
	$Precio = $objPHPExcel->getActiveSheet()->getCell('T'.$i)->getCalculatedValue();
	$Imagen = $objPHPExcel->getActiveSheet()->getCell('Y'.$i)->getCalculatedValue();
	$ImagenMas = $objPHPExcel->getActiveSheet()->getCell('Z'.$i)->getCalculatedValue();

	array_push($arrNombre,$Nombre);
	array_push($arrTipo,$Tipo);
	array_push($arrStatus,$Status);
	array_push($arrColor,$Color);
	array_push($arrSKU,$SKU);
	array_push($arrExistencia,$Existencia);
	array_push($arrPrecio,$Precio);
	array_push($arrImagen,$Imagen);
	array_push($arrTalla,$Talla);

	echo "<tr>";
	echo "<td>".$Nombre."</td>";
	echo "<td>".$Tipo."</td>";
	echo "<td>".$Status."</td>";
	echo "<td>".$Talla."</td>";
	echo "<td>".$Color."</td>";
	echo "<td>".$SKU."</td>";
	echo "<td>".$Existencia."</td>";
	echo "<td>".$Precio."</td>";
	echo "<td>".$Imagen."</td>";
	echo "<td>".$ImagenMas."</td>";
	echo "</tr>";
	if ($Status === "true") {
		$statusDB = 1;
	}else{
		$statusDB = 0;
	}
}
echo "</table>";
$arrNombreFinal = array_unique($arrNombre);
$arrStatusFinal = array_unique($arrStatus);
$arrTallaFinal = array_unique($arrTalla);
$arrColorFinal = array_unique($arrColor);
$arrSKUFinal = array_unique($arrSKU);
$arrExistenciaFinal = array_unique($arrExistencia);
$arrPrecioFinal = array_unique($arrPrecio);
$arrImagenFinal = array_unique($arrImagen);
$arrNombreFinal = array_diff($arrNombreFinal, array(''));
$arrStatusFinal = array_diff($arrStatusFinal, array(''));
$arrImagenFinal = array_diff($arrImagenFinal, array(''));
$arrExistenciaFinal = array_diff($arrExistenciaFinal, array('0'));
$iter = 0;
/*var_dump($arrNombreFinal);
var_dump($arrStatus);*/
/*var_dump($arrSKUFinal);*/
/*var_dump($arrColor);
var_dump($arrSKU);
var_dump($arrExistencia);
var_dump($arrPrecio);
var_dump($arrImagen);*/
/*foreach ($arrSKUFinal as $sku) {
	print($sku."**");
}*/



for ($j=0; $j < sizeof($arrColor); $j++) {
		print($arrColor[$j]."**");
		$j+=5;

for ($i=0; $i < sizeof($arrNombre); $i++) {
	if ($arrNombre[$i] !== null) {
		if ($arrStatus[$i]==="true") {
			$stus = 1;
		}
 		$sql ="INSERT INTO `shopify`(`Nombre`,`Color`, `SKU`, `Precio`, `imagen`, `Tipo`) VALUES ('$arrNombre[$i]','$arrColor[$j]','$arrSKU[$i]','$arrPrecio[$i]','$arrImagen[$i]','$arrTipo[$i]')";
 		$result = mysqli_query($conn, $sql);
 		var_dump($sql);
	}
}
	}

 		for ($k=0; $k < sizeof($arrTalla); $k++) {
 			#print($arrTalla[$k]."**");
 		}
 		for ($l=0; $l < sizeof($arrColor); $l++) {
 				for ($m=0; $m < sizeof($arrTalla); $m++) {
 					#print($arrTalla[$m]."**");
 				}
 				#print($arrColor[$l*6]."**");
 			}

/*var_dump($arrStatusFinal);
var_dump($arrNombreFinal);*/
// for ($k=0; $k < sizeof($arrNombreFinal) ; $k++) {
// 	if ((sizeof($arrExistenciaFinal) < 2) || (sizeof($arrExistenciaFinal) < 2)) {
// 		if ((sizeof($arrPrecioFinal)<2) && (sizeof($arrExistenciaFinal)<2)) {
// 			for ($l=0; $l < sizeof($arrColorFinal); $l++) {
// 				for ($m=0; $m < sizeof($arrTallaFinal); $m++) {
// 					$mul = $m*2;
// 					$sql ="INSERT INTO `shopify`(`Nombre`, `Talla`, `Color`, `Existencia`, `Precio`, `imagen`, SKU) VALUES ('$arrNombreFinal[$iter]','$arrTallaFinal[$mul]','$arrColorFinal[$l]','$arrExistenciaFinal[0]','$arrPrecioFinal[0]','$arrImagenFinal[$iter]', '$arrSKUFinal[$m]')";
// 					$result = mysqli_query($conn, $sql);
// 				}
// 			}
// 		}else if(sizeof($arrExistenciaFinal) < 2){
// 			for ($l=0; $l < sizeof($arrColorFinal); $l++) {
// 				for ($m=0; $m < sizeof($arrTallaFinal); $m++) {
// 					$mul = $m*2;
// 					$sql ="INSERT INTO `shopify`(`Nombre`, `Talla`, `Color`, `Existencia`, `Precio`, `imagen`, SKU) VALUES ('$arrNombreFinal[$iter]','$arrTallaFinal[$mul]','$arrColorFinal[$l]','$arrExistenciaFinal[0]', '$arrPrecioFinal[$k]','$arrImagenFinal[$iter]', '$arrSKUFinal[$m]')";
// 					$result = mysqli_query($conn, $sql);
// 				}
// 			}
// 		}else if(sizeof($arrPrecioFinal) < 2){
// 			for ($l=0; $l < sizeof($arrColorFinal); $l++) {
// 				for ($m=0; $m < sizeof($arrTallaFinal); $m++) {
// 					$mul = $m*2;
// 					$sql ="INSERT INTO `shopify`(`Nombre`, `Talla`, `Color`, `Existencia`, `Precio`, `imagen`, SKU) VALUES ('$arrNombreFinal[$iter]','$arrTallaFinal[$mul]','$arrColorFinal[$l]','$arrExistenciaFinal[$k]', '$arrPrecioFinal[0]','$arrImagenFinal[$iter]', '$arrSKUFinal[$m]')";
// 					$result = mysqli_query($conn, $sql);
// 				}
// 			}
// 		}
// 	}else{
// 		for ($l=0; $l < sizeof($arrColorFinal); $l++) {
// 				for ($m=0; $m < sizeof($arrTallaFinal); $m++) {
// 					$mul = $m*2;
// 					$sql ="INSERT INTO `shopify`(`Nombre`, `Talla`, `Color`, `Existencia`, `Precio`, `imagen`, SKU) VALUES ('$arrNombreFinal[$iter]','$arrTallaFinal[$mul]','$arrColorFinal[$l]','$arrExistenciaFinal[$k]', '$arrPrecioFinal[$k]','$arrImagenFinal[$iter]', '$arrSKUFinal[$m]')";
// 					$result = mysqli_query($conn, $sql);
// 				}
// 			}
// 	}
// 	$iter += $iteNombre;
// }
mb_http_output('UTF-8');
?>