<?php

declare(strict_types=1);

function h(string $value): string
{
  return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function renderNavbar(string $active): string
{
  $is = fn(string $k) => $active === $k ? 'active' : '';

  return '
  <header class="navbar">
    <div class="navbar-container">
      <nav class="navbar-menu">
        <a href="./index.php" class="' . $is('home') . '">Home</a>
        <a href="./sobre.php" class="' . $is('sobre') . '">Sobre</a>
        <a href="./produtos.php" class="' . $is('produtos') . '">Produtos</a>
        <a href="./contato.php" class="' . $is('produtos') . '">Contato</a>
      </nav>

      <div class="navbar-logo">
        <a href="./index.php" title="Shine Modas">
          <img src="./_imagens/logoshine.png" alt="Shine Modas">
        </a>
      </div>
    </div>
  </header>';
}

function renderFooter(): string
{
  return '
  <footer>
    <h3>Moda com respeito, estilo e elegância</h3>
    <h2>http://www.shinemodas.com.br</h2>
    <ul>
      <li><a target="_blank" title="twitter da Shinemodas" href="//twitter.com/shinemodas">
        <img title="twitter da securitylabs" alt="twitter da shinemodas" src="./_imagens/twrlogo.jpg" />
      </a></li>
      <li><a target="_blank" title="Perfil da ShineModas no Facebook" href="//facebook.com/shinemodas">
        <img title="Pagina da securitylabs no facebook" alt="Pagina da shinemodas no facebook" src="./_imagens/fbklogo.jpg" />
      </a></li>
    </ul>
  </footer>';
}
