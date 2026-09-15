<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Nouveau message de contact</title>
    </head>
    <body style="font-family: sans-serif; color: #0A0A0A; line-height: 1.6;">
        <p>Nouveau message reçu via le formulaire de contact du site.</p>

        <p>
            <strong>Nom :</strong> {{ $contactMessage->name }}<br>
            <strong>Email :</strong> {{ $contactMessage->email }}
        </p>

        <p><strong>Message :</strong></p>
        <p>{{ $contactMessage->message }}</p>

        <hr>

        <p style="color: #666; font-size: 12px;">
            Reçu le {{ $contactMessage->created_at->format('d/m/Y à H:i') }}.
        </p>
    </body>
</html>
