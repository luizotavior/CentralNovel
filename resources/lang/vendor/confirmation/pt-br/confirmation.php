<?php

return [
    'email-title' => 'Verificação de Email',
    'email-intro'=> 'Para validar seu email clique no botão abaixo',
    'email-button' => 'Verificação de Email',
    'message' => 'Obrigado por inscrever-se! Por favor verifique seu email.',
    'success' => 'Você verificou sua conta com sucesso! Agora você pode fazer o <a href="'.route('login').'">login</a>.',
    'again' => 'Você deve verificar seu e-mail antes de poder acessar o site.' .
                '<br>Se você não recebeu o email de confirmação, verifique sua pasta de spam.'.
                '<br>Para obter um novo e-mail de confirmação, por favor, <a href="' . url('confirmation/resend') . '" class="alert-link">clique aqui</a>.',
    'resend' => 'Uma mensagem de confirmação foi enviada. Por favor verifique seu email.'
];
