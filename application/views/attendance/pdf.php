<?php
include(APPPATH . 'views/fpdf/fpdf.php');
date_default_timezone_set($this->config->item("time_zone"));

$pdf = new FPDF();
$pdf -> AddPage();
$header = array('Full cards', 'Half cards','Free cards', 'Total', 'Teachers share', 'Institute share');
$pdf -> SetFont("Arial", "B", "30");
$pdf -> Cell(0,15, $class_detail['ClassName'],0, 0);
$pdf->Cell(0,15,$class_detail['BatchName'] . '-' . $class_detail['BatchYear'],0,1,'R');
$pdf->Ln();
$pdf -> SetFont("Arial", "", "15");
$pdf -> Cell(0,10, "Conducted by ".$class_detail['TFName'],0, 0);
$pdf->Cell(0,10,"Date - ".date('d-M-Y',time())." @ ".date('h:i a',time()),0,1,'R');
$pdf -> Cell(0,10, "Class Fee ",0, 1);

$pdf->Ln();

$total = 0;
$full = 0;
$half = 0;
$free = 0;

foreach ($students as $i=>$student){
    if(isset($student['Amount'])) {
        $total += $student['Amount'];
        if ($student['FeesRate'] == 0)
            $free += 1;
        elseif ($student['FeesRate'] == 0.5)
            $half += 1;
        elseif ($student['FeesRate'] == 1)
            $full += 1;
    }
}

$Tshare = ($total/5)*4;
$Ishare = $total/5;


$w = array(25, 25, 25, 40, 40, 40);

$pdf -> SetFont("Arial", "B", "14");
for($i=0;$i<count($header);$i++)
    $pdf->Cell($w[$i],7,$header[$i],1,0,'C');

$pdf->Ln();

$pdf->Cell($w[0],6,number_format($full) ,'LR',0,'R');
$pdf->Cell($w[1],6,number_format($half) ,'LR',0,'R');
$pdf->Cell($w[2],6,number_format($free) ,'LR',0,'R');
$pdf->Cell($w[3],6,number_format($total) ,'LR',0,'R');
$pdf->Cell($w[4],6,number_format($Ishare) ,'LR',0,'R');
$pdf->Cell($w[4],6,number_format($Ishare) ,'LR',0,'R');

$pdf->Ln();
$pdf->Cell(array_sum($w),0,'','T');



$pdf -> Output();