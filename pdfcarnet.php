<?php
if (isset($_GET['idusuario'])) {
    $id = $_GET['idusuario'];
    $sql = "select * from usuario where idusuario=" . $id;
    $result = pg_query($conn, $sql);
    if (pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
    } else {
        $errorMsg = 'No se encontro nada';
    }
}

//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */
require_once('vendor/autoload.php');
require_once('db.php');

use Picqer\Barcode\BarcodeGeneratorHTML;
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        // Logo
        $image_file = K_PATH_IMAGES . 'GoFastLogo.jpg';
        $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, 'C', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
    }

    protected $customPageSize = array(80, 150);  // Ajusta los valores de ancho y alto según tus necesidades

    public function __construct($orientation = 'P', $unit = 'mm', $format = 'custom')
    {
        parent::__construct($orientation, $unit, $format);
        $this->SetCustomPageSize($this->customPageSize);
    }

    protected function SetCustomPageSize($size)
    {
        $this->SetMargins(0, 0, 0);  // Establece los márgenes izquierdo, superior y derecho a 0
        $this->SetAutoPageBreak(true, 0);  // Desactiva el salto automático de página
        $this->AddPage('', $size);  // Agrega una nueva página con el tamaño personalizado
    }
}

$query = "SELECT * FROM usuario WHERE idusuario = 44";
$resultado = pg_query($conn, $query);

if (!$resultado) {
    echo "Error al ejecutar la consulta.";
    exit;
}

$fila = pg_fetch_assoc($resultado);
$name = $fila['name'];
$phone = $fila['phone'];
$generator = new BarcodeGeneratorHTML();
$codigo_barras = $fila['barcode'];
$barcode_html = $generator->getBarcode($codigo_barras, $generator::TYPE_CODE_128);

// Crear una instancia de TCPDF para generar un PDF temporal
/*$temp_pdf = new TCPDF();

$pdf->AddPage();
// Establecer la página actual como la primera página del PDF
$pdf->setPage(1);

// Agregar el código de barras HTML al PDF temporal
$temp_pdf->writeHTML($barcode_html);

// Obtener el contenido del PDF temporal como una cadena
$temp_pdf_content = $temp_pdf->Output('', 'S');

// Guardar el código de barras generado en un archivo PNG
$png_filename = 'photos/barcode.png';
file_put_contents($png_filename, $temp_pdf_content);*/

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('GoFast');
$pdf->SetTitle('GoFast Id Card');
$pdf->SetSubject('GoFast Id');
$pdf->SetKeywords('Go, Fast, Id, Card');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->SetLeftMargin($pdf->GetX() + 0); // Mueve la posición horizontal hacia la derecha en 10 unidades
$pdf->SetY($pdf->GetY() + 30); // Mueve la posición vertical hacia abajo en 20 unidades

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
// Establecer la página actual como la primera página del PDF
$pdf->setPage(1);

// Crear contenido HTML con la información obtenida
$contenidoCelda = "
    <p><strong>Name: </strong>{$name}</p>
    <p><strong>Phone: </strong>{$phone}</p>
    <p><strong>Barcode: </strong></p>
";

// Establecer el ancho y el alto de la celda
$anchoCelda = 80; // Ancho de la celda
$altoCelda = 10; // Alto de la celda

// Agregar la celda al documento
$pdf->writeHTMLCell($anchoCelda, $altoCelda, '', '', $contenidoCelda, 1, 0, false, true, 'L', true);

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('GoFastIdCard.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+