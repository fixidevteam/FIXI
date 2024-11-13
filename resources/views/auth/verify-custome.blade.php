<!DOCTYPE html>
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

</html>
