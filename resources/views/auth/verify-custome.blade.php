{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérifier address email</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            color: #333;
            background-color: #fff;
            line-height: 1.8;
            max-width: 100%;
            overflow-x: hidden; /* Prevent horizontal scrolling */
        }

        .container {
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            padding: 20px;
            border-radius: 5px;
            box-sizing: border-box; /* Ensure padding is included in width */
        }

        p {
            margin: 1em 0;
        }

        a.button {
            display: inline-block;
            margin: 20px auto;
            padding: 10px 20px;
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

        a.button:focus {
            background-color: #374151;
        }

        a.button:active {
            background-color: #111827;
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
    </style>
</head>

<body>
    <div class="container">
        <main>
            <p>Bonjour, {{ $user->name }}</p>
            <p>Merci de vous être inscrit sur Fixi ! Pour déverrouiller toutes les fonctionnalités de votre compte, veuillez vérifier votre adresse email en cliquant sur le bouton ci-dessous.</p>
            <a href="{{ $url }}" class="button">Vérifiez votre adresse email</a>
            <p>Une fois votre email vérifié, vous pourrez ajouter les informations de votre voiture, vos documents personnels, ainsi que les papiers de votre voiture. Vous pourrez également suivre les dates d'expiration de vos documents pour ne rien manquer.</p>
            <p>Si vous avez des questions, n'hésitez pas à nous contacter à <a href="mailto:contact@fixi.ma">contact@fixi.ma</a>.</p>
        </main>
        <footer>
            <p><a href="https://fixi.ma/">Fixi.ma</a> &copy; {{ date('Y') }}</p>
        </footer>
    </div>
</body>

</html> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérifier votre adresse email</title>
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

        .features {
            list-style: none;
            padding: 0;
        }

        .features li {
            margin-bottom: 10px;
        }

        .features li::before {
            content: "✔";
            color: #1f2937;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        {{-- <header style="text-align: center; padding-bottom: 20px;">
            <img src="https://fixi.ma/wp-content/uploads/2024/02/logo-2-350-x-100-px.webp" alt="Fixi Logo" style="max-width: 150px;">
        </header> --}}
        <main>
            <h1>Bienvenue dans la communauté FIXI+ ! 🎉</h1>
            <p>Bonjour, {{ $user->name }}</p>
            <p>Félicitations et bienvenue dans la communauté FIXI+ et <a href="https://fixi.ma/" target="_blank">FIXI.MA</a> !</p>

            <h2>Présentation de nos services</h2>
            <ul class="features">
                <li><strong>🔧 FIXI+</strong></li>
                <li>Gérez vos documents personnels et ceux de votre véhicule en toute simplicité.</li>
                <li>Recevez des alertes pour les échéances importantes (assurances, permis, contrôles techniques, etc.).</li>
                <li>Restez à jour avec une interface intuitive et des rappels automatiques.</li>
                <li><strong>🚗 FIXI.MA</strong></li>
                <li>Trouvez des garages partenaires fiables près de chez vous, comparez les services et planifiez vos besoins en ligne.</li>
                <li>Comparez les services et tarifs des garages pour des décisions éclairées.</li>
                <li>Planifiez vos opérations (entretien, réparations, diagnostics) en ligne..</li>
            </ul>

            <p>Pour commencer à profiter de tous ces avantages, vérifiez votre adresse email en cliquant sur le bouton ci-dessous :</p>
            <a href="{{ $url }}" class="button">Vérifiez votre adresse email</a>

            <h2>Votre compte FIXI est prêt à l'emploi !</h2>
            <p>Voici comment commencer :</p>
            <ol>
                <li><strong>Connectez-vous</strong> : <a href="{{ route('dashboard') }}" target="_blank">Lien vers la plateforme FIXI+</a></li>
                <li><strong>Complétez votre profil</strong> : Ajoutez vos véhicules et documents personnels pour une expérience sur mesure.</li>
                <li><strong>Explorez nos services</strong> : Trouvez les garages partenaires et planifiez vos besoins.</li>
            </ol>

            <p>Besoin d'aide ? Nous sommes là pour vous :</p>
            <p>
                📧 Contactez-nous à : <a href="mailto:support@fixi.ma">support@fixi.ma</a><br>
                🌐 Visitez notre FAQ : <a href="https://fixi.ma/faq" target="_blank">FAQ</a>
            </p>
        </main>
        <footer>
            <p><a href="https://fixi.ma/">Fixi.ma</a> &copy; 2025</p>
            <p>Suivez-nous sur <a href="https://www.facebook.com/FIXI.MAROC" target="_blank">Facebook</a> | <a href="https://fixi.ma/conditions-generales/" target="_blank">Conditions générales d'utilisation</a></p>
        </footer>
    </div>
</body>

</html>

