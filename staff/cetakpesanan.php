<?php
    ob_start();
    include "cetak.php";
   
    $content = ob_get_clean();
    include "../assets/html2pdf/html2pdf.class.php";
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
        $html2pdf->setTestTdInOnePage(false);
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('report.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>