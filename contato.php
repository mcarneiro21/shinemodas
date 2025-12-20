<?php

declare(strict_types=1);

require_once __DIR__ . '/layout/index.php';
require_once __DIR__ . '/components/contato/index.php';

$content = contatoConteudo();

$errors = [];
$values = ['name' => '', 'email' => '', 'msg' => ''];
$sent = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    [$ok, $errors, $clean] = validarContato($_POST);
    $values = $clean;

    if ($ok) {
        $sent = true;
        $errors = [];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>SHINE Modas Corp. - Contato</title>
    <meta name="description" content="Entre em contato com a Shine Modas" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./_estilos/layout/index.css">
    <link rel="stylesheet" href="./_estilos/contato/index.css">
</head>

<body>
    <?= renderNavbar('contato') ?>

    <?= renderContato($content, $errors, $values, $sent) ?>

    <?= renderFooter() ?>

    <script src="./_js/script.js"></script>
</body>

</html>