<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impression</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { width: 100%; height: 100%; overflow: hidden; background: #333; }

        iframe {
            display: block;
            width: 100%;
            height: 100%;
            border: none;
        }

        #msg { display: none; }
    </style>
</head>
<body>
    <iframe id="pdfFrame" src="data:application/pdf;base64,{{ $pdfBase64 }}"></iframe>

    <div id="msg">
        <div class="spinner"></div>
        <span>Préparation de l'impression…</span>
    </div>

    <script>
        var frame = document.getElementById('pdfFrame');

        frame.onload = function () {
            try {
                frame.contentWindow.focus();
                frame.contentWindow.print();
            } catch (e) {
                window.print();
            }

            // Fermer l'onglet après impression (ou annulation)
            window.addEventListener('afterprint', function () {
                window.close();
            });
        };
    </script>
</body>
</html>
