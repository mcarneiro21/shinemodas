<?php

declare(strict_types=1);

function homeConteudo(): array
{
    return [
        'title' => 'Moda Plus Size',
        'sections' => [
            [
                'type' => 'image',
                'src' => './_imagens/people_04.jpg',
                'title' => 'Foto_Capa_01',
                'alt' => '[Foto_Capa_01]',
            ],
            [
                'type' => 'text',
                'text' => 'A moda plus size é um conceito que abrange o design e a produção de roupas e acessórios para pessoas que usam tamanhos maiores. É uma abordagem inclusiva e diversificada que reconhece a variedade de corpos e promove a aceitação e a celebração de todos os tipos de corpos.',
            ],
            [
                'type' => 'text',
                'text' => 'O objetivo da moda plus size é oferecer opções estilosas e contemporâneas para pessoas que usam tamanhos acima das normas tradicionais da indústria da moda. Ela busca romper com os estereótipos de beleza restritivos e proporcionar roupas que se ajustem bem e valorizem as curvas, garantindo conforto e confiança para quem as usa.',
            ],
            [
                'type' => 'image',
                'src' => './_imagens/people_02.jpg',
                'title' => 'Foto_Capa_02',
                'alt' => '[Foto_Capa_02]',
            ],
            [
                'type' => 'text',
                'text' => 'Segundo Isabella Potter do portal ONDM a moda Plus Size vem cada vez mais ganhando força no Brasil! O termo Plus Size foi criado na década de 70 nos Estados Unidos, dentro da própria indústria de moda, para designar os manequins acima de 44, porém, começou a ganhar conhecimento na década de 90. As mulheres que são consideradas Plus Size atualmente, já foram o ideal de corpo feminino em diversos períodos históricos. Apesar de muitas pessoas falarem que estar acima do peso faz mal para a saúde, a moda plus size não surgiu para incentivar o excesso de peso e sim, para valorizar a diversidade e a curva dos corpos, indo contra os padrões de beleza e a ditadura da magreza.',
            ],
            [
                'type' => 'text',
                'text' => 'Um aspecto importante do conceito de moda plus size é o empoderamento. Ele visa capacitar as pessoas a abraçarem seus corpos e expressarem sua individualidade através das roupas. A moda plus size oferece uma ampla gama de estilos, desde peças clássicas e elegantes até tendências modernas, permitindo que cada pessoa crie seu próprio estilo único.',
            ],
            [
                'type' => 'text',
                'text' => 'Além disso, a moda plus size promove a inclusão e a representatividade. Ela reconhece a diversidade de corpos e busca eliminar a marginalização das pessoas que usam tamanhos maiores. Isso é alcançado por meio da inclusão de modelos plus size nas campanhas publicitárias, da diversidade de tamanhos nas opções de vestuário e do diálogo sobre a importância da aceitação e do respeito por todos os tipos de corpos.',
            ],
        ],
    ];
}

function renderHome(array $data): string
{
    $title = htmlspecialchars((string)$data['title'], ENT_QUOTES, 'UTF-8');

    $html = '<main>';
    $html .= '<h1>' . $title . '</h1>';

    foreach (($data['sections'] ?? []) as $s) {
        $type = (string)($s['type'] ?? '');

        if ($type === 'image') {
            $src   = htmlspecialchars((string)($s['src'] ?? ''), ENT_QUOTES, 'UTF-8');
            $ititle = htmlspecialchars((string)($s['title'] ?? ''), ENT_QUOTES, 'UTF-8');
            $alt   = htmlspecialchars((string)($s['alt'] ?? ''), ENT_QUOTES, 'UTF-8');

            $html .= '<img title="' . $ititle . '" alt="' . $alt . '" src="' . $src . '" />';
            continue;
        }

        if ($type === 'text') {
            $text = trim((string)($s['text'] ?? ''));
            $text = preg_replace("/\s+/", " ", $text);
            $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');

            $html .= '<p>' . $text . '</p>';
            continue;
        }
    }

    $html .= '</main>';
    return $html;
}
