<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de mot de passe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }

        .content {
            padding: 20px;
            color: #333333;
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
            background-color: #374151; /* Couleur de survol */
        }

        .footer {
            background-color: #f3f4f6; /* Gris clair */
            text-align: center;
            padding: 10px;
            font-size: 0.9em;
            color: #6b7280; /* Gris */
        }

        .footer a {
            color: #1f2937; /* Gris foncé */
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Réinitialisez votre mot de passe</h1>
        </div>
        <div class="content">
            <p>Bonjour,</p>
            <p>Vous recevez cet email car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.</p>
            <a href="{{ $actionUrl }}" class="button">Réinitialiser le mot de passe</a>
            <p>Si vous n'avez pas demandé la réinitialisation de votre mot de passe, aucune autre action n'est requise.</p>
        </div>
        <div class="footer">
            <p>Si vous rencontrez des difficultés pour cliquer sur le bouton "Réinitialiser le mot de passe", copiez et collez l'URL ci-dessous dans votre navigateur :</p>
            <p><a href="{{ $actionUrl }}">{{ $actionUrl }}</a></p>
            <p>Merci,<br>L'équipe de {{ config('app.name') }}</p>
        </div>
    </div>
</body>

</html>
