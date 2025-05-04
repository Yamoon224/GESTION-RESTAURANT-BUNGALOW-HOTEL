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

        $this->pdf = new App('P', 'mm', [80, 130]);
        $this->pdf->setTitle(utf8_decode(__('locale.'.$type)));
        $this->pdf->addPage();

        $this->pdf->setX(4);
        $this->pdf->setFillColor(255, 193, 7);
        $this->pdf->setFont('Arial', 'B', 8);
        
        $this->pdf->setX(2);
        $this->pdf->cell(15, 6, utf8_decode("Caisse"), '', 0, 'L');
        $this->pdf->setFont('Arial', '', 8);
        $this->pdf->cell(43, 6, utf8_decode($order->creator->firstname.' '.$order->creator->name), 'LR', 0, 'L');
        $this->pdf->cell(18, 6, utf8_decode("CASH"), 'LR', 1, 'C');

        $this->pdf->setX(2);
        $this->pdf->cell(15, 6, utf8_decode("Client"), '', 0, 'L');
        $this->pdf->setFont('Arial', '', 8);
        $this->pdf->cell(61, 6, utf8_decode('CL DIVERS'), 'LRB', 1, 'L');

        $this->pdf->ln(4);
        $this->pdf->setX(2);
        $this->pdf->setFont('Arial', 'I', 7);
        $this->pdf->cell(40, 5, utf8_decode("Le ".date('d/m/Y  à  H:i:s', strtotime($order->created_at))), '', 0, 'L');
        $this->pdf->setFont('Arial', 'IB', 7);
        $this->pdf->cell(30, 5, utf8_decode("N A : ".$order->order_details->count()), '', 0, 'R');

        $this->pdf->ln(6);
        $this->pdf->setX(2);
        $this->pdf->setFont('Arial', 'B', 8);
        $data = OrderDetail::with('product')->where('order_id', $order->id)->get()->toArray();
        if($type == 'bill') 
        {
            $this->pdf->bill(
                ['DESIGNATION', 'PRIX U', 'QTE', 'TOTAL'], 
                $data, 
                [
                    'Remise appliquée: '=>moneyFormat(0), 
                    'TVA appliquée: '=>moneyFormat(0), 
                    'Net à payer: '=>moneyFormat($order->amount)
                ]
            );
        } else {
            $this->pdf->receipt(
                ['DESIGNATION', 'PRIX U', 'QTE', 'TOTAL'], 
                $data, 
                [
                    ['Remise: ', moneyFormat(0), 'Espèces:', moneyFormat($order->received)], 
                    ['TVA: ', moneyFormat(0), 'Monnaie:', moneyFormat($order->rest)], 
                    ['TOTAL: ', moneyFormat($order->amount), 'Rendu:', moneyFormat($order->rest)], 
                    ['', '', 'Avoir:', moneyFormat(0)], 
                ]
            );
        }
        
        $this->pdf->output('I', 'RECU.pdf');
        exit;
    }

    public function dailyreport(Request $request) 
    {
        $orders = Order::whereDate('created_at', '>=', $request->start)
            ->whereDate('created_at', '<=', $request->end)
            ->get();


        $this->pdf = new App('P', 'mm', [80, 130]);
        $this->pdf->setTitle(utf8_decode('DAILY REPORT'));
        $this->pdf->addPage();

        $this->pdf->setX(4);
        $this->pdf->setFont('Arial', 'B', 8);
        $this->pdf->cell(15, 6, utf8_decode("Caissière"), '', 0, 'L');
        $this->pdf->setFont('Arial', 'I', 8);
        $this->pdf->cell(61, 6, utf8_decode(auth()->user()->firstname.' '.auth()->user()->name), '', 1, 'L');

        $this->pdf->setX(4);
        $this->pdf->setFont('Arial', 'B', 8);
        $this->pdf->cell(20, 6, utf8_decode("Date Début: "), '', 0, 'L');
        $this->pdf->setFont('Arial', 'I', 8);
        $this->pdf->cell(61, 6, utf8_decode(date('d/m/Y H:i:s', strtotime($request->start))), '', 1, 'C');
        $this->pdf->setX(4);
        $this->pdf->setFont('Arial', 'B', 8);
        $this->pdf->cell(20, 6, utf8_decode("Date Fin: "), '', 0, 'L');
        $this->pdf->setFont('Arial', 'I', 8);
        $this->pdf->cell(61, 6, utf8_decode(date('d/m/Y H:i:s', strtotime($request->end))), '', 1, 'C');


        $this->pdf->ln(2);
        $this->pdf->setX(4);
        $this->pdf->setFont('Arial', 'B', 8);
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
