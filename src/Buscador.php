<?php

require_once 'vendor/autoload.php';

namespace Alura\BuscadorDeCursos;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
    private $httpClient;
    private $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function buscar(string $url): array
    {
        $resposta = $this->httpClient->request('GET', $url);

        $html = $resposta->getBody();

        //O Crawler vai ler o dom do html
        $this->crawler->addHtmlContent($html);

        //span.card-curso__nome = item selecionado do html (uma classe dentro da tag span)
        $elementoCursos = $this->crawler->filter('span.card-curso__nome');

        //Para cada um dos elementos de curso eu adiciono no array de cursos
        //Não posso retornar elementos porque ele não é um array de string, ele é um array de elementos do dom
        $cursos = [];

        foreach ($elementoCursos as $elemento) {
            $cursos[] = $elemento->textContent;
        }

        return $cursos;
    }
}
