<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Services\Fpdf\App;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    private $pdf;

    public function __construct()
    {
        $this->pdf = new App('P','mm','A4');
    }

    public function receipt($id, $type) 
    {
        $order = Order::find($id);
        $data  = OrderDetail::with('product')->where('order_id', $order->id)->get()->toArray();

        if ($type == 'bill') {
            $this->pdf = new App('P', 'mm', [80, 250]);
            $this->pdf->setTitle(utf8_decode('FACTURE'));
            $this->pdf->SetMargins(2, 3, 2);
            $this->pdf->disableFooter = true;
            $this->pdf->addPage();

            $this->pdf->bill(
                ['DESIGNATION', 'PRIX U', 'QTE', 'TOTAL'],
                $data,
                [
                    'Remise appliquée: ' => moneyFormat(0),
                    'TVA appliquée: '    => moneyFormat(0),
                    'Net à payer: '      => moneyFormat($order->amount),
                ],
                [
                    'caisse'   => $order->creator->firstname.' '.$order->creator->name,
                    'client'   => 'CL DIVERS',
                    'date'     => date('d/m/Y à H:i:s', strtotime($order->created_at)),
                    'count'    => $order->order_details->count(),
                    'order_id' => $order->id,
                ]
            );
        } else {
            $this->pdf = new App('P', 'mm', [80, 270]);
            $this->pdf->setTitle(utf8_decode('REÇU'));
            $this->pdf->SetMargins(2, 3, 2);
            $this->pdf->disableFooter = true;
            $this->pdf->addPage();

            $this->pdf->bill(
                ['DESIGNATION', 'PRIX U', 'QTE', 'TOTAL'],
                $data,
                [
                    'Remise appliquée: ' => moneyFormat(0),
                    'TVA appliquée: '    => moneyFormat(0),
                    'Net à payer: '      => moneyFormat($order->amount),
                    'Espèces: '          => moneyFormat($order->received),
                    'Monnaie rendue: '   => moneyFormat($order->rest),
                ],
                [
                    'caisse'   => $order->creator->firstname.' '.$order->creator->name,
                    'client'   => 'CL DIVERS',
                    'date'     => date('d/m/Y à H:i:s', strtotime($order->created_at)),
                    'count'    => $order->order_details->count(),
                    'order_id' => $order->id,
                ],
                'REÇU'
            );
        }

        $pdfContent = $this->pdf->output('S');
        $pdfBase64 = base64_encode($pdfContent);

        return view('admin.orders.print', compact('pdfBase64'));
    }

    public function dailyreport(Request $request) 
    {
        $orders = Order::whereDate('created_at', '>=', $request->start)
            ->whereDate('created_at', '<=', $request->end)
            ->get();


        $this->pdf = new App('P', 'mm', [80, 130]);
        $this->pdf->setTitle(utf8_decode('DAILY REPORT'));
        $this->pdf->SetMargins(2, 3, 2);
        $this->pdf->addPage();

        $this->pdf->setX(4);
        $this->pdf->setFont('Arial', 'B', 10);
        $this->pdf->cell(15, 8, utf8_decode("Caissière"), '', 0, 'L');
        $this->pdf->setFont('Arial', 'I', 10);
        $this->pdf->cell(61, 8, utf8_decode(auth()->user()->firstname.' '.auth()->user()->name), '', 1, 'L');

        $this->pdf->setX(4);
        $this->pdf->setFont('Arial', 'B', 10);
        $this->pdf->cell(20, 8, utf8_decode("Date Début: "), '', 0, 'L');
        $this->pdf->setFont('Arial', 'I', 10);
        $this->pdf->cell(61, 8, utf8_decode(date('d/m/Y H:i:s', strtotime($request->start))), '', 1, 'C');
        $this->pdf->setX(4);
        $this->pdf->setFont('Arial', 'B', 10);
        $this->pdf->cell(20, 8, utf8_decode("Date Fin: "), '', 0, 'L');
        $this->pdf->setFont('Arial', 'I', 10);
        $this->pdf->cell(61, 8, utf8_decode(date('d/m/Y H:i:s', strtotime($request->end))), '', 1, 'C');


        $this->pdf->ln(2);
        $this->pdf->setX(4);
        $this->pdf->setFont('Arial', 'B', 10);
        $this->pdf->dailyreport(
            [
                ['Remise ', moneyFormat(0)], 
                ['TVA ', moneyFormat(0)], 
                ['TOTAL ', moneyFormat(0)], 
                ['Total TVA', moneyFormat(0)], 
                ['Total sans TVA', moneyFormat($orders->sum('amount'))], 
                ['Cash (Comptant)', moneyFormat($orders->sum('amount'))], 
                ['Crédit', moneyFormat(0)], 
                ['Autres réglements', moneyFormat(0)], 
                ['Total encaissé', moneyFormat($orders->sum('amount'))], 
                ['Avoir (monnaie)', moneyFormat(0)], 
                ['Total à annuler', moneyFormat(0)], 
                ['Total machine', moneyFormat($orders->sum('amount'))], 
                ['Fond de caisse', moneyFormat(0)], 
                ["Apport d'espèce", moneyFormat(0)], 
                ["Retrait d'espèce", moneyFormat(0)], 
                ["Recette à verser", moneyFormat($orders->sum('amount'))], 
                ["Recette versée", moneyFormat(0)], 
                ["Ecart", moneyFormat($orders->sum('amount'))], 
            ]
        );
        
        $this->pdf->output('I', 'report.pdf');
        exit;
    }
}
