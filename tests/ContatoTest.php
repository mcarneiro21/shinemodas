<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../components/contato/index.php';

final class ContatoTest extends TestCase
{
    public function testContatoConteudoEstruturaCorreta(): void
    {
        $c = contatoConteudo();
        $this->assertArrayHasKey('title', $c);
        $this->assertArrayHasKey('subtitle', $c);
        $this->assertArrayHasKey('fields', $c);
        $this->assertIsArray($c['fields']);
        $this->assertNotEmpty($c['fields']);
    }

    public function testValidarContatoObrigatorios(): void
    {
        [$ok, $errors, $clean] = validarContato([]);
        $this->assertFalse($ok);
        $this->assertArrayHasKey('name', $errors);
        $this->assertArrayHasKey('email', $errors);
        $this->assertArrayHasKey('msg', $errors);
        $this->assertSame('', $clean['name']);
    }

    public function testValidarContatoEmailInvalido(): void
    {
        [$ok, $errors] = validarContato([
            'name' => 'Igor',
            'email' => 'email-invalido',
            'msg' => 'Olá',
        ]);

        $this->assertFalse($ok);
        $this->assertSame('E-mail inválido.', $errors['email']);
    }

    public function testValidarContatoOk(): void
    {
        [$ok, $errors, $clean] = validarContato([
            'name' => 'Igor',
            'email' => 'igor@email.com',
            'msg' => 'Mensagem normal',
        ]);

        $this->assertTrue($ok);
        $this->assertEmpty($errors);
        $this->assertSame('Igor', $clean['name']);
    }

    public function testRenderContatoEscapaHtml(): void
    {
        $html = renderContato(
            contatoConteudo(),
            [],
            ['name' => '<b>x</b>', 'email' => 'a@a.com', 'msg' => '<script>1</script>'],
            false
        );

        $this->assertStringNotContainsString('<script>', $html);
        $this->assertStringContainsString('&lt;b&gt;x&lt;/b&gt;', $html);
    }
}
