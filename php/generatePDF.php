<?php
    require('../vendor/setasign/fpdf/fpdf.php');

    $resForm = [
        $_POST['customerLastName'],
        $_POST['marqueName'],
        $_POST['licensePlateCar']
    ];

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    $pdf->Cell(0, 10, 'Mon Document PDF', 0, 1, 'C');

    $data = [
        'Nom' => $resForm[0],
        'Marque' => $resForm[1],
        'Immatriculation' => $resForm[2],
    ];

    $pdf->SetFont('Arial', '', 12);
    foreach ($data as $key => $value) {
        $pdf->Cell(50, 10, $key . ':', 1, 0);
        $pdf->Cell(0, 10, $value, 1, 1);
    }

    $pdf->Output('I', 'mon_document.pdf');
    // $pdf->Output('D', 'mon_document.pdf');
?>