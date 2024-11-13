<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixi</title>
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

        .header img {
            display: block;
            margin: 0 auto;
            width: 150px;
            height: 50px;
        }

        .header h1 {
            text-align: center;
            font-size: 1.5em;
            color: #1f2937;
        }

        p {
            margin: 1em 0;
        }

        a.button {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            background-color: #1f2937;
            border: 1px solid transparent;
            border-radius: 24px;
            font-weight: 600;
            font-size: 0.75rem;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            text-decoration: none;
            transition: all 0.15s ease-in-out;
            text-align: center;
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
        <header class="header">
            <img src="http://127.0.0.1:8000/images/fixi.png" alt="Fixi">
            <h1>Fixi</h1>
        </header>
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
