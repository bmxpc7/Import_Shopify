<?php 
require 'Classes/PHPExcel/IOFactory.php';
require 'conexion.php';
$archivo = 'products_export.csv';
$objPHPExcel = PHPExcel_IOFactory::load($archivo);
$objPHPExcel->setActiveSheetIndex(0);
$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

$arrNombre = array();
$arrStatus = array();
$arrTalla = array();
$arrColor = array();
$arrSKU = array();
$arrExistencia = array();
$arrPrecio = array();
$arrImagen = array();
$Nombre1 = $objPHPExcel->getActiveSheet()->getCell('B2')->getCalculatedValue();
$Status1 = 1;
$Talla1 = $objPHPExcel->getActiveSheet()->getCell('I2')->getCalculatedValue();
$Color1 = $objPHPExcel->getActiveSheet()->getCell('K2')->getCalculatedValue();
$SKU1 = $objPHPExcel->getActiveSheet()->getCell('N2')->getCalculatedValue();
$Existencia1 = $objPHPExcel->getActiveSheet()->getCell('Q2')->getCalculatedValue();
$Precio1 = $objPHPExcel->getActiveSheet()->getCell('T2')->getCalculatedValue();
$Imagen1 = $objPHPExcel->getActiveSheet()->getCell('Y2')->getCalculatedValue();
echo '<table border=1>
		<tr>
			<td>Nombre</td>
			<td>Status</td>
			<td>Talla</td>
			<td>Color</td>
			<td>SKU</td>
			<td>Existencia</td>
			<td>Precio</td>
			<td>Imagen</td>
		</tr>';
		$sql = "INSERT INTO `shopify`(`Nombre`, `Talla`, `Color`, `SKU`, `Existencia`, `Precio`, `imagen`, `Status`) VALUES ('$Nombre1','$Talla1','$Color1','$SKU1','$Existencia1','$Precio1','$Imagen1','$Status1')";
		$result = mysqli_query($conn, $sql);
for ($i=2; $i <= $numRows ; $i++) { 
	$NombreTodos = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
	$Nombre = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
	$Status = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
	$Talla = $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
	$Color = $objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue();
	$SKU = $objPHPExcel->getActiveSheet()->getCell('N'.$i)->getCalculatedValue();
	$Existencia = $objPHPExcel->getActiveSheet()->getCell('Q'.$i)->getCalculatedValue();
	$Precio = $objPHPExcel->getActiveSheet()->getCell('T'.$i)->getCalculatedValue();
	$Imagen = $objPHPExcel->getActiveSheet()->getCell('Y'.$i)->getCalculatedValue();
	
	array_push($arrNombre,$Nombre);
	array_push($arrStatus,$Status);
	array_push($arrTalla,$Talla);
	array_push($arrColor,$Color);
	array_push($arrSKU,$SKU);
	array_push($arrExistencia,$Existencia);
	array_push($arrPrecio,$Precio);
	array_push($arrImagen,$Imagen);

	echo "<tr>";
	echo "<td>".$Nombre."</td>";
	echo "<td>".$Status."</td>";
	echo "<td>".$Talla."</td>";
	echo "<td>".$Color."</td>";
	echo "<td>".$SKU."</td>";
	echo "<td>".$Existencia."</td>";
	echo "<td>".$Precio."</td>";
	echo "<td>".$Imagen."</td>";
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
 ?>