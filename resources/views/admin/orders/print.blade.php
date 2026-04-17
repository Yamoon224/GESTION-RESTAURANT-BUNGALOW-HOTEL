<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impression en cours…</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { width: 100%; height: 100%; background: #f5f5f5; font-family: Arial, sans-serif; }

        /* iframe caché hors écran — doit rester dans le DOM pour se charger */
        iframe {
            position: absolute;
            left: -9999px;
            top: -9999px;
            width: 1px;
            height: 1px;
            border: none;
        }

        /* Message visible pendant la préparation */
        #msg {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            gap: 16px;
            color: #555;
        }
        .spinner {
            width: 40px; height: 40px;
            border: 4px solid #ccc;
            border-top-color: #900;
            border-radius: 50%;
            animation: spin .8s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        @media print {
            #msg { display: none; }
            iframe { position: static; width: 100%; height: 100%; left: 0; top: 0; }
        }
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
