<?php
namespace App\Services\Fpdf;

use Codedge\Fpdf\Fpdf\Fpdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Imagick;

class App extends Fpdf
{
    // Pied de page
    function footer()
    {
        // Positionnement à 1,5 cm du bas
        $this->SetXY(4, -8);
        
        // Police Arial italique 8
        // Numéro de page
        $this->SetX(0);
        $this->SetFont('Arial', 'I', 6);
        $this->Cell(80, 3, utf8_decode("Yamoussoukro, Côte d'Ivoire"), '', 1, 'C');
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

    // Tableau amélioré
    function bill($header, $data, $others = NULL)
    {
        // Column Width
        $width = [32, 18, 8, 18];
        
        // Headers
        for($i = 0; $i < count($header); $i++)
            $this->cell($width[$i], 6, utf8_decode($header[$i]), 'LR', 0, 'C');
        $this->Ln();

        
        $this->setFont('Arial', '', 7);
        // Data
        foreach($data as $key => $row)
        {
            $this->setX(2);
            $this->cell($width[0], 6, utf8_decode($row['product']['name']), '', 0, 'C');
            $this->cell($width[1], 6, utf8_decode(moneyFormat($row['price'])), '', 0, 'C');
            $this->cell($width[2], 6, utf8_decode($row['qty']), '', 0, 'C');
            $this->cell($width[3], 6, utf8_decode(moneyFormat($row['amount'])), '', 0, 'C');
            $this->Ln();
        }
        // Trait de terminaison
        // $this->Cell(array_sum($width), 0, '', 'T');
        $this->Ln(2);
        foreach($others as $key => $item)
        {
            $this->setX(22);
            $this->cell(25, 6, utf8_decode($key), '', 0, 'R');
            $this->cell(31, 6, utf8_decode($item), 'LRTB', 0, 'R');
            $this->Ln();
        }
        $this->setX(22);
    }

    // Tableau amélioré
    function receipt($header, $data, $others = NULL)
    {
        // Column Width
        $width = [32, 18, 8, 18];
        
        // Headers
        for($i = 0; $i < count($header); $i++)
            $this->cell($width[$i], 6, utf8_decode($header[$i]), 'LR', 0, 'C');
        $this->Ln();

        
        $this->setFont('Arial', '', 7);
        // Data
        foreach($data as $key => $row)
        {
            $this->setX(2);
            $this->cell($width[0], 6, utf8_decode($row['product']['name']), '', 0, 'C');
            $this->cell($width[1], 6, utf8_decode(moneyFormat($row['price'])), '', 0, 'C');
            $this->cell($width[2], 6, utf8_decode($row['qty']), '', 0, 'C');
            $this->cell($width[3], 6, utf8_decode(moneyFormat($row['amount'])), '', 0, 'C');
            $this->Ln();
        }
        // Trait de terminaison
        // $this->Cell(array_sum($width), 0, '', 'T');
        $this->Ln(2);
        foreach($others as $item)
        {
            $this->setX(2);
            $this->setFont('Arial', 'B', 7);
            $this->cell(15, 6, utf8_decode($item[0]), '', 0, 'R');

            $this->setFont('Arial', 'I', 7);
            $this->cell(25, 6, utf8_decode($item[1]), !empty($item[1]) ? 'LRTB' : '', 0, 'R');

            $this->setFont('Arial', 'B', 7);
            $this->cell(18, 6, utf8_decode($item[2]), '', 0, 'R');
            
            $this->setFont('Arial', 'I', 7);
            $this->cell(18, 6, utf8_decode($item[3]), 'LRTB', 0, 'R');
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
            $this->setFont('Arial', 'IB', 8);
            $this->cell(30, 6, utf8_decode($item[0]), '', 0, 'L');
            
            $this->setFont('Arial', 'I', 8);
            $this->cell(42, 6, utf8_decode($item[1]), !empty($item[1]) ? 'LRTB' : '', 0, 'R');
            $this->Ln();
        }
        $this->setX(22);
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