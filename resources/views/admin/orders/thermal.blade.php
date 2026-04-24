<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        @page {
            size: 80mm auto;
            margin: 0;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body {
            width: 80mm;
            font-family: Arial, sans-serif;
            font-size: 13px;
            background: #fff;
            color: #000;
            line-height: 1.5;
        }
        .wrap {
            width: 80mm;
            padding: 4mm 4mm 6mm 4mm;
        }
        .center  { text-align: center; }
        .right   { text-align: right; }
        .left    { text-align: left; }
        .bold    { font-weight: bold; }
        .italic  { font-style: italic; }

        /* Séparateur */
        .sep {
            width: 100%;
            border: none;
            border-top: 1px dashed #000;
            margin: 5px 0;
        }

        /* En-tête */
        .hotel-name {
            font-size: 17px;
            font-weight: bold;
            text-align: center;
            letter-spacing: 1px;
            margin-bottom: 2px;
        }
        .hotel-sub {
            font-size: 11px;
            text-align: center;
            line-height: 1.6;
        }
        .doc-title {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin: 4px 0;
            letter-spacing: 1px;
        }

        /* Meta */
        .meta { font-size: 12px; }
        .meta-row {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 4px;
        }
        .meta-label { font-weight: bold; flex-shrink: 0; margin-right: 4px; }
        .meta-value { flex: 1; }
        .meta-right { font-weight: bold; margin-left: 4px; }

        /* Tableau articles */
        .items {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
            margin-top: 3px;
        }
        .items thead th {
            border-bottom: 1.5px solid #000;
            padding: 4px 3px;
            font-size: 11px;
            font-weight: bold;
        }
        .items tbody td {
            padding: 4px 3px;
            vertical-align: middle;
        }
        .items tbody tr:not(:last-child) td {
            border-bottom: 1px dotted #ccc;
        }
        .col-name  { width: 42%; text-align: left; }
        .col-price { width: 22%; text-align: right; }
        .col-qty   { width: 10%; text-align: center; }
        .col-total { width: 26%; text-align: right; }

        /* Totaux */
        .totals {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        .totals td { padding: 3px 2px; }
        .totals td:last-child { text-align: right; }
        .totals .last-row td {
            font-weight: bold;
            font-size: 14px;
            padding-top: 5px;
            border-top: 1px solid #000;
        }

        /* Merci */
        .merci {
            font-size: 15px;
            font-weight: bold;
            text-align: center;
            margin: 7px 0 5px;
            letter-spacing: 1px;
        }

        /* Code-barres */
        .barcode-wrap { text-align: center; margin-top: 5px; }
        .barcode-num  { font-size: 10px; text-align: center; margin-top: 3px; letter-spacing: 3px; }

        @media print {
            html, body { width: 80mm; }
            .wrap { padding: 3mm 4mm 8mm 4mm; }
        }
    </style>
</head>
<body>
<div class="wrap">

    {{-- Logo --}}
    @if(file_exists(public_path('images/logo.png')))
    <div class="center" style="margin-bottom: 3mm;">
        <img src="{{ asset('images/logo.png') }}" style="height: 14mm;" alt="logo">
    </div>
    @endif

    {{-- En-tête hôtel --}}
    <div class="hotel-name">BUNGALOWS HOTEL</div>
    <div class="hotel-sub">Yamoussoukro, Côte d'Ivoire</div>
    <div class="hotel-sub" style="margin-bottom:3px;">Tel: 2730610871</div>

    <hr class="sep">

    {{-- Titre du document --}}
    <div class="doc-title">{{ $title }}</div>

    <hr class="sep">

    {{-- Informations caisse --}}
    <div class="meta" style="margin: 3px 0;">
        <div class="meta-row">
            <span class="meta-label">Caisse:</span>
            <span class="meta-value">{{ $meta['caisse'] }}</span>
            <span class="meta-right">CASH</span>
        </div>
        <div class="meta-row">
            <span class="meta-label">Client:</span>
            <span class="meta-value">{{ $meta['client'] }}</span>
        </div>
        <div class="meta-row italic" style="font-size:11px; margin-top:3px;">
            <span>Le {{ $meta['date'] }}</span>
            <span>N° Art : {{ $meta['count'] }}</span>
        </div>
    </div>

    <hr class="sep">

    {{-- Articles --}}
    <table class="items">
        <thead>
            <tr>
                <th class="col-name">DESIGNATION</th>
                <th class="col-price">PRIX U</th>
                <th class="col-qty">QTE</th>
                <th class="col-total">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td class="col-name">{{ $row['product']['name'] }}</td>
                <td class="col-price">{{ moneyformat($row['price']) }}</td>
                <td class="col-qty">{{ $row['qty'] }}</td>
                <td class="col-total">{{ moneyformat($row['amount']) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr class="sep">

    {{-- Totaux --}}
    <table class="totals">
        @php $i = 0; $total = count($others); @endphp
        @foreach($others as $label => $value)
        @php $i++; @endphp
        <tr class="{{ $i === $total ? 'last-row' : '' }}">
            <td>{{ $label }}</td>
            <td>{{ $value }}</td>
        </tr>
        @endforeach
    </table>

    <hr class="sep">

    {{-- Merci --}}
    <div class="merci">MERCI POUR VOTRE VISITE!</div>

    {{-- Code-barres --}}
    @php $orderId = str_pad($meta['order_id'], 8, '0', STR_PAD_LEFT); @endphp
    <div class="barcode-wrap">
        <svg id="barcode"></svg>
        <div class="barcode-num">{{ $orderId }}</div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>
<script>
    JsBarcode("#barcode", "{{ $orderId }}", {
        format: "CODE39",
        width: 1.5,
        height: 40,
        displayValue: false,
        margin: 2
    });

    window.addEventListener('load', function () {
        window.print();
        window.addEventListener('afterprint', function () {
            window.close();
        });
    });
</script>
</body>
</html>
