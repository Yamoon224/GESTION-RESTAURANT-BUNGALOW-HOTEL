<?php
namespace App\Services\Fpdf;

use Codedge\Fpdf\Fpdf\Fpdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Imagick;

class App extends Fpdf
{
    public $disableFooter = false;

    // Pied de page
    function footer()
    {
        if ($this->disableFooter) return;
        // Positionnement à 1,5 cm du bas
        $this->SetXY(4, -8);
        
        // Police Arial italique 8
        // Numéro de page
        $this->SetX(0);
        $this->SetFont('Arial', 'I', 6);
        $this->Cell(80, 3, "Yamoussoukro, C\xf4te d'Ivoire", '', 1, 'C');
        $this->SetX(0);
        $this->Cell(80, 3, utf8_decode("2730610871 - direction@bungalowshotel.net - www.bungalowshotel.net"), '', 1, 'C');
    }

    // Tableau simple
    function basicTable($header, $data)
    {
        // En-tête
        foreach($header as $col)
            $this->Cell(40, 7, utf8_decode(strtoupper($col)), 1);
        $this->Ln();

        // Données
        foreach($data as $row)
        {
            foreach($row as $col)
                $this->Cell(40, 6, $col, 1);
            $this->Ln();
        }
    }

    // Ticket de caisse style thermique
    function bill($header, $data, $others = NULL, $meta = [])
    {
        $usable = 76;

        // ===== EN-TÊTE =====
        $logoPath = public_path('images/logo.png');
        if (file_exists($logoPath)) {
            $logoW = 28;
            $this->Image($logoPath, (80 - $logoW) / 2, $this->GetY(), $logoW, $logoW, 'PNG');
            $this->Ln($logoW + 2);
        }

        $this->SetX(2);
        $this->SetFont('Arial', 'B', 13);
        $this->Cell($usable, 8, utf8_decode('BUNGALOWS HOTEL'), 0, 1, 'C');

        $this->SetX(2);
        $this->SetFont('Arial', '', 8);
        $this->Cell($usable, 5, "Yamoussoukro, C\xf4te d'Ivoire", 0, 1, 'C');

        $this->SetX(2);
        $this->Cell($usable, 5, utf8_decode('Tel: 2730610871'), 0, 1, 'C');

        $this->Ln(1);
        $this->ticketSeparator();

        // ===== TITRE =====
        $this->SetX(2);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell($usable, 7, utf8_decode('FACTURE'), 0, 1, 'C');

        $this->ticketSeparator();

        // ===== INFO CAISSE / CLIENT =====
        $caisse = $meta['caisse'] ?? '';
        $client = $meta['client'] ?? 'CL DIVERS';
        $date   = $meta['date']   ?? '';
        $count  = $meta['count']  ?? 0;

        $this->SetX(2);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(15, 6, utf8_decode('Caisse:'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(43, 6, utf8_decode($caisse), 0, 0, 'L');
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(18, 6, 'CASH', 0, 1, 'R');

        $this->SetX(2);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(15, 6, utf8_decode('Client:'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(61, 6, utf8_decode($client), 0, 1, 'L');

        $this->SetX(2);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(48, 5, utf8_decode("Le $date"), 0, 0, 'L');
        $this->SetFont('Arial', 'IB', 8);
        $this->Cell(28, 5, utf8_decode("N A : $count"), 0, 1, 'R');

        $this->Ln(1);
        $this->ticketSeparator();

        // ===== EN-TÊTE COLONNES =====
        $w = [32, 18, 8, 18];
        $this->SetX(2);
        $this->SetFont('Arial', 'B', 10);
        foreach ($header as $i => $col) {
            $this->Cell($w[$i], 7, utf8_decode($col), 'B', 0, 'C');
        }
        $this->Ln();

        // ===== ARTICLES =====
        $this->SetFont('Arial', '', 9);
        foreach ($data as $row) {
            $this->SetX(2);
            $this->Cell($w[0], 6, utf8_decode($row['product']['name']), 0, 0, 'L');
            $this->Cell($w[1], 6, utf8_decode(moneyFormat($row['price'])), 0, 0, 'R');
            $this->Cell($w[2], 6, utf8_decode($row['qty']), 0, 0, 'C');
            $this->Cell($w[3], 6, utf8_decode(moneyFormat($row['amount'])), 0, 0, 'R');
            $this->Ln();
        }

        $this->Ln(1);
        $this->ticketSeparator();

        // ===== TOTAUX =====
        if ($others) {
            $keys   = array_keys($others);
            $values = array_values($others);
            $last   = count($keys) - 1;
            foreach ($keys as $i => $key) {
                $this->SetX(2);
                $this->SetFont('Arial', $i === $last ? 'B' : '', 9);
                $this->Cell(44, 6, utf8_decode($key), 0, 0, 'L');
                $this->Cell(32, 6, utf8_decode($values[$i]), 0, 1, 'R');
            }
        }

        $this->Ln(1);
        $this->ticketSeparator();

        // ===== MERCI =====
        $this->SetX(2);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell($usable, 7, utf8_decode('MERCI POUR VOTRE VISITE!'), 0, 1, 'C');

        $this->Ln(3);

        // ===== CODE BARRES =====
        $orderId = str_pad($meta['order_id'] ?? 0, 8, '0', STR_PAD_LEFT);
        $this->Code39($orderId, 3, 70, 14);

        $this->SetX(2);
        $this->SetFont('Arial', '', 7);
        $this->Cell($usable, 4, $orderId, 0, 1, 'C');

        $this->Ln(3);
    }

    // Tableau amélioré
    function receipt($header, $data, $others = NULL)
    {
        // Column Width
        $width = [32, 18, 8, 18];
        
        // Headers
        $this->setFont('Arial', 'B', 10);
        for($i = 0; $i < count($header); $i++)
            $this->cell($width[$i], 8, utf8_decode($header[$i]), '1', 0, 'C');
        $this->Ln();

        $this->setFont('Arial', '', 9);
        // Data
        foreach($data as $key => $row)
        {
            $this->setX(2);
            $this->cell($width[0], 8, utf8_decode($row['product']['name']), '1', 0, 'C');
            $this->cell($width[1], 8, utf8_decode(moneyFormat($row['price'])), '1', 0, 'C');
            $this->cell($width[2], 8, utf8_decode($row['qty']), '1', 0, 'C');
            $this->cell($width[3], 8, utf8_decode(moneyFormat($row['amount'])), '1', 0, 'C');
            $this->Ln();
        }
        $this->Ln(2);
        foreach($others as $item)
        {
            $this->setX(2);
            $this->setFont('Arial', 'B', 9);
            $this->cell(15, 8, utf8_decode($item[0]), '1', 0, 'R');

            $this->setFont('Arial', 'I', 9);
            $this->cell(25, 8, utf8_decode($item[1]), '1', 0, 'R');

            $this->setFont('Arial', 'B', 9);
            $this->cell(18, 8, utf8_decode($item[2]), '1', 0, 'R');
            
            $this->setFont('Arial', 'I', 9);
            $this->cell(18, 8, utf8_decode($item[3]), '1', 0, 'R');
            $this->Ln();
        }
        $this->setX(22);
    }

    // Tableau amélioré
    function dailyreport($data)
    {
        foreach($data as $item)
        {
            $this->setX(4);
            $this->setFont('Arial', 'IB', 10);
            $this->cell(30, 8, utf8_decode($item[0]), '1', 0, 'L');
            
            $this->setFont('Arial', 'I', 10);
            $this->cell(42, 8, utf8_decode($item[1]), '1', 0, 'R');
            $this->Ln();
        }
        $this->setX(22);
    }

    // Séparateur de ticket thermique (ligne d'astérisques)
    function ticketSeparator()
    {
        $this->SetFont('Arial', '', 7);
        $unit  = $this->GetStringWidth('* ');
        $count = (int)(74 / $unit);
        $sep   = str_repeat('* ', $count);
        $this->SetX(2);
        $this->Cell(76, 5, $sep, 0, 1, 'C');
    }

    // Code barres Code 39
    function Code39($code, $x, $totalWidth, $h = 12)
    {
        $chars = [
            '0'=>'111221211', '1'=>'211211112', '2'=>'112211112', '3'=>'212211111',
            '4'=>'111221112', '5'=>'211221111', '6'=>'112221111', '7'=>'111211212',
            '8'=>'211211211', '9'=>'112211211', 'A'=>'211112112', 'B'=>'112112112',
            'C'=>'212112111', 'D'=>'111122112', 'E'=>'211122111', 'F'=>'112122111',
            'G'=>'111112212', 'H'=>'211112211', 'I'=>'112112211', 'J'=>'111122211',
            'K'=>'211111122', 'L'=>'112111122', 'M'=>'212111121', 'N'=>'111121122',
            'O'=>'211121121', 'P'=>'112121121', 'Q'=>'111111222', 'R'=>'211111221',
            'S'=>'112111221', 'T'=>'111121221', 'U'=>'221111112', 'V'=>'122111112',
            'W'=>'222111111', 'X'=>'121121112', 'Y'=>'221121111', 'Z'=>'122121111',
            '-'=>'121111212', '.'=>'221111211', ' '=>'122111211', '$'=>'121212111',
            '/'=>'121211121', '+'=>'121112121', '%'=>'111212121', '*'=>'121121211'
        ];

        $fullCode = '*' . strtoupper($code) . '*';
        $len      = strlen($fullCode);
        // Code 39 : chaque caractère = 6 étroits + 3 larges (ratio 1:3) = 15 unités
        // + 1 unité d'espace inter-caractère
        $totalUnits = $len * 16 - 1;
        $n = $totalWidth / $totalUnits; // largeur d'un élément étroit (mm)
        $w = $n * 3;                    // largeur d'un élément large (mm)

        $y    = $this->GetY();
        $xPos = $x;
        $this->SetFillColor(0, 0, 0);

        for ($i = 0; $i < $len; $i++) {
            $char = $fullCode[$i];
            if (!isset($chars[$char])) { $xPos += 15 * $n + $n; continue; }
            $pattern = $chars[$char];
            for ($j = 0; $j < 9; $j++) {
                $elemWidth = ($pattern[$j] === '1') ? $n : $w;
                if ($j % 2 === 0) { // positions paires = barres (noires)
                    $this->Rect($xPos, $y, $elemWidth, $h, 'F');
                }
                $xPos += $elemWidth;
            }
            $xPos += $n; // espace inter-caractère
        }

        $this->SetFillColor(255, 255, 255);
        $this->SetY($y + $h + 1);
    }

    // Tableau coloré
    function FancyTable($header, $data, $isReceipt, $others = [], $isDiama = false)
    {
        // Couleurs, épaisseur du trait et police grasse
        $this->SetFillColor(150, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'IB');
        // En-tête
        $w = array(10, 80, 35, 30, 35);
        for($i=0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, utf8_decode($header[$i]), 1, 0, 'C', true);
        $this->Ln();
        // Restauration des couleurs et de la police
        $this->SetFillColor(224, 215, 215);
        $this->SetTextColor(0);
        $this->SetLineWidth(.1);
        // Données
        $fill = false;
        $this->SetFont('Arial', 'I', 8);
        $sum = 0;
        $taxs = 0;
        foreach($data as $key => $row)
        {
            $this->Cell($w[0], 6, ++$key, 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, utf8_decode($row->employee->matricule." - ".(!empty($row->employee->currentAffectation()->location) ? $row->employee->currentAffectation()->location : 'Non défini')), 'LR', 0, 'C', $fill);
            $this->Cell($w[2], 6, moneyformat($row->price), 'LR', 0, 'C', $fill);
            $this->Cell($w[3], 6, moneyformat($row->tva*0.01*$row->price), 'LR', 0, 'C', $fill);
            $this->Cell($w[4], 6, moneyformat($row->price+$row->tva*0.01*$row->price), 'LR', 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
            $sum += $row->price;
            $taxs += $row->tva*0.01*$row->price;
        }
        // Trait de terminaison
        $this->Cell(array_sum($w), 0, '', 'T', 1);
        $this->Ln();
        $this->SetFont('Arial', 'I', 9);
        $supp = ['TOTAL HT'=>moneyformat($sum), 'TOTAL TVA'=>moneyformat($taxs)];
        $ttc = $sum+$taxs;
        if(!empty($others['discount'])) {
            $ttc -= $others['discount']; 
            $supp['TOTAL REMISE'] = moneyformat($others['discount']);
        }
        if(!empty($others['arrears'])) {
            $ttc += $others['arrears']; 
            $supp['TOTAL ARRIERES'] = moneyformat($others['arrears']);
        }
        $supp['MONTANT TTC'] = moneyformat($ttc);
        
        foreach($supp as $key => $item)
        {
            $this->setX(115);
            $this->Cell(40, 9, $key, 'LRT', 0, 'L', $fill);
            $this->Cell(45, 9, utf8_decode($item), 'LRT', 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->setX(115);
        $this->Cell(85, 0, '', 'T');
        
        $this->SetFont('Arial', 'I', 8);
        $this->setXY(10, $this->getY()-24);
        $this->Cell(80, 0, 'Conakry le '.date('d/m/Y'), '');
        $this->Image('images/signature.png', 10, $this->getY()+2, 30, 0);
        
        $this->Ln(25);
        $this->SetFont('Arial', 'I', 7.8);
        $txt = "Sauf Erreur ou Omission, le montant de ".($isReceipt == 1 ? 'ce reçu' : 'cette facture')." s'élève à ".$supp['MONTANT TTC']." comme TTC ".(!empty($supp['TOTAL ARRIERES']) ? "avec ".$supp['TOTAL ARRIERES']." comme arriérés sur le total HT " : "") . (!empty($supp['TOTAL REMISE']) ? "et ".$supp['TOTAL REMISE']." comme remise sur le total HT " : ""). "Payable en";
        
        if(strlen($txt) <= 110) 
            $txt .= "par chèque ou virement bancaire à l'ordre de: ";
        if(strlen($txt) <= 147 && strlen($txt) > 110) 
            $txt .= "par chèque,";
        // if(strlen($txt) <= 191 && strlen($txt) > 144){
        //     $txt = str_replace("sur le total HT Payable en liquidité, ", '', $txt);
        // } 
        
        $this->Cell(190, 6, utf8_decode($txt), '', 1, 'L');
        if(strlen($txt) <= 110) 
            $this->setXY(10, $this->getY());
        
        // if(strlen($txt) <= 156 && strlen($txt) > 110 && strlen($txt) != 149) {
        //     $this->setX(10);
        //     $this->Cell(30, 3, utf8_decode("par virement bancaire à l'ordre de: "), '', 0, 'L');
        //     $this->setX(53);
        // }
        // dd( strlen($txt) );
        if(strlen($txt) <= 191 && strlen($txt) > 144){
            $this->setX(10);
            $this->Cell(40, 3, utf8_decode("liquidité, par chèque ou par virement bancaire à l'ordre de: "), '', 0, 'L');
            $this->setX(81);
        } 
        
        $bankname = "JAGUAR SECURITY SERVICES SARL - RIB: ". ($isDiama ? '0010330009-04 - DIAMA BANK' : '004.002.4410425102.05 - BANQUE ISLAMIQUE DE GUINEE (BIG)');
        // if(strlen($txt) <= 191 && strlen($txt) > 144) {
        //     $bankname = str_replace("ISLAMIQUE DE GUINEE (BIG)", '', $bankname);
        // } 
        $this->SetFont('Arial', 'IB', 6.5);
        $this->Cell(80, 3, utf8_decode($bankname), '', 1, 'L');
        // if(strlen($txt) <= 191 && strlen($txt) > 144) {
        //     $this->setX(10);
        //     $this->Cell(40, 5, utf8_decode("ISLAMIQUE DE GUINEE (BIG)"), '', 1, 'L');
        // }
    }
}
