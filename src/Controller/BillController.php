<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Repository\SocietyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/facture", name="bill_")
 */
class BillController extends AbstractController
{
    /**
     * @Route("/societe/{id}/facture/telechargement", name="data_download")
     */
    public function billDownload($id, SocietyRepository $societyRepository): Response
    {
        $society = $societyRepository->find($id);
        $items = $society->getItems();

        $totalSalesTurnover = 0;

        foreach($items as $item) {
          $total = ($item->getPrice() * $item->getQuantity());
          $totalSalesTurnover = $totalSalesTurnover + $total;
        }
        $items = $society->getItems();


        $pdfOptions = new Options();
        
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->setIsRemoteEnabled(true);

        $dompdf = new Dompdf($pdfOptions);
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]);

        $dompdf->setHttpContext($context);

        $html = $this->renderView('bill/template_bill_pdf.html.twig', [
            'items' => $items,
            'society' => $society,
            'totalSalesTurnover' => $totalSalesTurnover
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $file = 'Facture-000.pdf';

        $dompdf->stream($file, [
            'Attachment' => true
        ]);

        return new Response();
        
    }
}
