
<?php
	  require APP . 'libs/fpdf/fpdf.php';

	class Pdf extends FPDF
	{
		function Header()
		{
			// $this->Image('imgs/logo.png', 5, 5, 30 );
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10, 'Reporte De Empleados',0,0,'C');
			$this->Ln(20);//Generar un salto de línea
		}

		function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}
	}

    $pdf = new Pdf('P', 'mm', 'A4');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFillColor(232, 232,232);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetXY(10,40);
    $pdf->Cell(40, 6, 'Nombre', 1, 0, 'C', 1);
    $pdf->Cell(40, 6, 'Apellido', 1, 0, 'C', 1);
    $pdf->Cell(70, 6, 'Correo', 1, 0, 'C', 1);
    $pdf->Cell(40, 6, 'Cargo', 1, 1, 'C', 1);

    $pdf->SetFillColor(249, 249, 249);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial','',10);
?>
