<?php
require('fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $sesin = $_SESSION['username'];
        
        $arr = array(1,2,3,4,5,'Luis','nombre' => 'Villasenor','arreglo' => array(9,8,7,6,5,4));
        $nombre = $arr['nombre'];

        
        // Logo
        $this->Image('posada.png',20,15,35);
        // Arial bold 15

        $this->SetFont('Arial','B',15);
        // Salto de línea
        $this->Ln(5);
        // Movernos a la derecha
        //$this->Cell(80);
        // Título
        $this->Cell(30,10,'SECRETARIA DE TURISMO',1,0,'C');
        // Salto de línea
        $this->Ln(10);
        // Movernos a la derecha
        $this->Cell(80);
        // Sub título
        $this->Cell(30,10,'Solictud de Compra',0,0,'C');
        $this->Ln(25);

        $this->Cell(30,10,'Requisitante:');
        $this->Ln(5);
        $this->Cell(30,10, $sesin);
        $this->Ln(15);

        $this->Cell(30,10,'Proveedor Sugerido:');
        $this->Ln(5);
        $this->Cell(30,10, $nombre);
        $this->Ln(15);


        
    }

    function subfooter()
    {
        
        $this->SetFont('Arial','B',15);
        // Salto de línea
        //$this->Ln(15);
        // Movernos a la derecha
        
        // Título
        
        // Salto de línea
        //$this->Ln(10);        
        
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    // Cargar los datos
    function LoadData($file)
    {
        // Leer las líneas del fichero
        $lines = file($file);
        $data = array();
        foreach($lines as $line)
            $data[] = explode(';',trim($line));
        return $data;
    }

    // Tabla coloreada
    function FancyTable($header, $data)
    {
        // Colores, ancho de línea y fuente en negrita
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // Cabecera
        $w = array(40, 35, 45, 40);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        // Restauración de colores y fuentes
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Datos
        $fill = false;
        foreach($data as $row)
        {
            $this->Cell($w[0],2,$row[0],'LR',0,'L',$fill);
            $this->Cell($w[1],2,$row[1],'LR',0,'L',$fill);
            //$this->Cell($w[2],2,number_format($row[2]),'LR',0,'R',$fill);
            //$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Línea de cierre
        $this->Cell(array_sum($w),0,'','T');
    }
}


?>