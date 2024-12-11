<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Notification' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f7;
            margin: 0;
            padding: 0;
            color: #51545e;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
        }

        .email-header {
            background-color: #1f2937;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        .email-body {
            padding: 30px 20px;
            font-size: 16px;
            line-height: 1.8;
            color: #333333;
        }

        .email-body p {
            margin: 0 0 20px;
        }

        a.button {
            display: inline-block;
            color: #fff;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #1f2937;
            text-decoration: none;
            border-radius: 24px;
            text-align: center;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        a.button:hover {
            background-color: #374151;
        }

        .email-footer {
            background-color: #f4f4f7;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #6b7280;
        }

        .email-footer a {
            color: #1f2937;
            text-decoration: none;
        }

        .email-footer a:hover {
            color: #374151;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
          {{ $title ?? 'Notification' }}
        </div>
        <div class="email-body">
          <p>Bonjour {{ $user->name }},</p>
          <p>Nous vous informons que l'un de vos documents a expiré ou est sur le point d'expirer. Voici les détails :</p>
          <p>{{ $body ?? 'Nous avons une notification importante pour vous.' }}</p>
          <p>Pour éviter tout désagrément, nous vous recommandons de mettre à jour ce document dès que possible. Vous pouvez consulter les détails et effectuer les actions nécessaires en cliquant sur le bouton ci-dessous :</p>
          @if(isset($actionText) && isset($actionUrl))
            <a href="{{ $actionUrl }}" class="button">{{ $actionText }}</a>
          @endif
          <p>Si vous avez des questions ou besoin d'assistance, notre équipe est à votre disposition. N'hésitez pas à nous contacter à l'adresse suivante : <a href="mailto:contact@fixi.ma">contact@fixi.ma</a>.</p>
          <p>Merci d'avoir choisi Fixi. Nous sommes là pour vous aider à rester organisé et à jour avec vos documents !</p>
        </div>
      
        <div class="email-footer">
            <p>Merci de rester connecté avec nous !</p>
            <p>Pour plus d'informations, visitez notre <a href="{{ config('app.url') }}">plateforme</a>.</p>
        </div>
    </div>
</body>

</html>

