<?php

declare(strict_types=1);

function contatoConteudo(): array
{
    return [
        'title' => 'Fale com a Shine Modas',
        'subtitle' => 'Envie sua mensagem. Vamos responder o mais rápido possível.',
        'fields' => [
            ['name' => 'name',  'label' => 'Nome',    'type' => 'text',  'required' => true,  'max' => 80],
            ['name' => 'email', 'label' => 'E-mail',  'type' => 'email', 'required' => true,  'max' => 120],
            ['name' => 'msg',   'label' => 'Mensagem', 'type' => 'textarea', 'required' => true, 'max' => 800],
        ],
    ];
}


function validarContato(array $input): array
{
    $errors = [];
    $clean = [];

    $name  = trim((string)($input['name'] ?? ''));
    $email = trim((string)($input['email'] ?? ''));
    $msg   = trim((string)($input['msg'] ?? ''));

    if ($name === '') $errors['name'] = 'Nome é obrigatório.';
    if ($email === '') $errors['email'] = 'E-mail é obrigatório.';
    if ($msg === '') $errors['msg'] = 'Mensagem é obrigatória.';

    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'E-mail inválido.';
    }

    if (mb_strlen($name) > 80) $errors['name'] = 'Nome muito longo.';
    if (mb_strlen($email) > 120) $errors['email'] = 'E-mail muito longo.';
    if (mb_strlen($msg) > 800) $errors['msg'] = 'Mensagem muito longa.';

    $clean['name']  = $name;
    $clean['email'] = $email;
    $clean['msg']   = $msg;


    return [count($errors) === 0, $errors, $clean];
}

function renderContato(array $content, array $errors = [], array $values = [], bool $sent = false): string
{
    $title = htmlspecialchars((string)$content['title'], ENT_QUOTES, 'UTF-8');
    $subtitle = htmlspecialchars((string)$content['subtitle'], ENT_QUOTES, 'UTF-8');

    $alert = '';
    if ($sent) {
        $alert = '<div class="alert success">Mensagem enviada com sucesso! ✅</div>';
    } elseif (!empty($errors)) {
        $alert = '<div class="alert error">Revise os campos destacados.</div>';
    }

    $nameVal  = htmlspecialchars((string)($values['name']  ?? ''), ENT_QUOTES, 'UTF-8');
    $emailVal = htmlspecialchars((string)($values['email'] ?? ''), ENT_QUOTES, 'UTF-8');
    $msgVal   = htmlspecialchars((string)($values['msg']   ?? ''), ENT_QUOTES, 'UTF-8');


    $nameErr  = $errors['name']  ?? '';
    $emailErr = $errors['email'] ?? '';
    $msgErr   = $errors['msg']   ?? '';

    $nameClass  = $nameErr  ? 'field invalid' : 'field';
    $emailClass = $emailErr ? 'field invalid' : 'field';
    $msgClass   = $msgErr   ? 'field invalid' : 'field';

    return '
    <main>
      <h1>' . $title . '</h1>
      <p class="subtitle">' . $subtitle . '</p>

      ' . $alert . '

      <form class="card" method="post" action="./contato.php" novalidate>
        <div class="' . $nameClass . '">
          <label for="name">Nome</label>
          <input id="name" name="name" type="text" maxlength="80" value="' . $nameVal . '" required>
          ' . ($nameErr ? '<small class="error-text">' . htmlspecialchars($nameErr, ENT_QUOTES, 'UTF-8') . '</small>' : '') . '
        </div>

        <div class="' . $emailClass . '">
          <label for="email">E-mail</label>
          <input id="email" name="email" type="email" maxlength="120" value="' . $emailVal . '" required>
          ' . ($emailErr ? '<small class="error-text">' . htmlspecialchars($emailErr, ENT_QUOTES, 'UTF-8') . '</small>' : '') . '
        </div>

        <div class="' . $msgClass . '">
          <label for="msg">Mensagem</label>
          <textarea id="msg" name="msg" maxlength="800" rows="6" required>' . $msgVal . '</textarea>
          ' . ($msgErr ? '<small class="error-text">' . htmlspecialchars($msgErr, ENT_QUOTES, 'UTF-8') . '</small>' : '') . '
        </div>

        <button class="btn" type="submit">Enviar</button>
      </form>
    </main>';
}
