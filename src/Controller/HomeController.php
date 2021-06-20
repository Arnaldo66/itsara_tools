<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {

        // this work to split pdf into separate file.
        /*$pdf = new \setasign\Fpdi\Fpdi();
	    $pagecount = $pdf->setSourceFile(__DIR__ . '/timbre.pdf'); // How many pages?
        // Split each page into a new PDF
        for ($i = 1; $i <= $pagecount; $i++) {
            $new_pdf = new \setasign\Fpdi\Fpdi();
            $new_pdf->AddPage();
            $new_pdf->setSourceFile(__DIR__ . '/timbre.pdf');
            $new_pdf->useTemplate($new_pdf->importPage($i));
            
            try {
                $new_filename = str_replace('.pdf', '', __DIR__ . '/timbre.pdf').'_'.$i.".pdf";
                $new_pdf->Output($new_filename, "F");
                echo "Page ".$i." split into ".$new_filename."<br />\n";
            } catch (\Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }*/

        // change policy.ym into etc/image to read|write pdf
       /* $myurl = __DIR__.'/timbre.pdf[0]';
        $image = new \Imagick();
        $image->readImage($myurl);
        $image->setImageResolution(2550, 3300);
        $image->setResolution(2550, 3300);
        $image->setImageFormat( "jpeg" );
        $image->writeImage('newfilename.png');*/

        // très bien ! faire une commande pour ça car traitement long et lourd 504 gateway
        /*$pdf = new \Spatie\PdfToImage\Pdf(__DIR__ . '/timbre.pdf');
        
        $pdf->setResolution(1000);
        $pdf->setOutputFormat('png');
        $pdf->setCompressionQuality(100);
        $pdf->saveAllPagesAsImages(__DIR__, 'new_t');*/





        // instantiate and use the dompdf class
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml('hello world');
        
        $customPaper = array(0,0,150,200);
        $dompdf->setPaper($customPaper);
        // (Optional) Setup the paper size and orientation
        //$dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();

        die();
      
        // Parse pdf file and build necessary objects.
        $parser = new \Smalot\PdfParser\Parser();
        $pdf    = $parser->parseFile(__DIR__ . '/timbre.pdf');
        
        $pages  = $pdf->getPages();
        foreach ($pages as $page) {
            $im->readImage($page);
            die();
        }

        die('ee');
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
