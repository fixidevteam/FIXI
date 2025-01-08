<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $document->type ?? '⚠️ Notification' }}</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            color: #333;
            background-color: #f9f9f9;
            line-height: 1.8;
        }

        .container {
            margin: 0 auto;
            max-width: 600px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #1f2937;
        }

        p {
            margin: 1em 0;
        }

        a.button {
            display: block;
            margin: 20px auto;
            padding: 15px 25px;
            background-color: #1f2937; /* Gris foncé */
            color: #ffffff;
            text-decoration: none;
            border-radius: 24px;
            text-align: center;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        a.button:hover {
            background-color: #374151;
        }

        footer {
            text-align: center;
            font-size: 0.9em;
            color: #aaa;
            margin-top: 20px;
        }

        footer a {
            text-decoration: none;
            color: #1f2937;
        }

        .alert-details {
            margin: 20px 0;
            padding: 15px;
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
        }

        .alert-details p {
            margin: 5px 0;
        }

        .alert-details span {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        {{-- <header style="text-align: center; padding-bottom: 20px;">
            <img src="https://fixi.ma/wp-content/uploads/2024/02/logo-2-350-x-100-px.webp" alt="Fixi Logo" style="max-width: 150px;">
        </header> --}}
        <main>
            <h1>⚠️ {{ $document->type ?? 'Notification' }} nécessite votre attention</h1>

            <p>Bonjour, {{ $user->name }}</p>

            <p>Nous souhaitons vous informer que le document suivant nécessite votre attention :</p>

            <div class="alert-details">
                <p>📄 <span>Nom du document :</span> {{ $document->type }}</p>
                <p>📅 <span>Date d’expiration :</span> {{ $document->date_fin }}</p>
                <p>🔄 <span>Action à réaliser :</span> [Renouveler / Planifier / Télécharger le document, etc.]</p>
            </div>

            <p>Que faire maintenant ? Consultez les détails complets ici :</p>
            <a href="{{ $actionUrl }}" class="button">{{ $actionText }}</a>

            <p>Besoin d’aide ? Nous sommes là pour vous :</p>
            <p>📧 Contactez-nous : <a href="mailto:support@fixi.ma">support@fixi.ma</a></p>
            <p>🌐 Consultez notre FAQ : <a href="https://fixi.ma/faq">FAQ</a></p>
            <p>Merci de faire confiance à FIXI pour simplifier la gestion de vos documents et opérations. 🚀</p>
            <p>Cordialement,</p>
            <p>L'équipe FIXI+ et <a href="https://fixi.ma/">Fixi.ma</a></p>
        </main>
        <footer>
            <p><a href="https://fixi.ma/">Fixi.ma</a> &copy; {{ date('Y') }}</p>
            <p>Suivez-nous sur <a href="https://www.facebook.com/FIXI.MAROC" target="_blank">Facebook</a> | <a href="https://fixi.ma/conditions-generales/" target="_blank">Conditions générales d'utilisation</a></p>
        </footer>
    </div>
</body>

</html>

 