<?php $link = route('email-verification.check', $user->verification_token) . '?email=' . urlencode($user->email) ?>

<p>Olá,</p>
<p>Sua conta na plataforma foi criada com sucesso!</p>
<p style="font-size: large; font-weight: bold">
    Clique
    <a href="{{ $link }}" role="button"> aqui </a>
    para validar o seu e-mail.
</p>
<p>
    Caso não funcione, copie e cole o link a seguir no seu navegador:
    <br>
    <a href="{{ $link }}">{{ $link }}</a>
</p>
<br>
<p>Não responda este e-mail, pois ele foi gerado automaticamente.</p>