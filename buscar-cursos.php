<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client(['verify' => false]);
$resposta = $client->request('GET', 'https://www.alura.com.br/cursos-online-programacao/php');

$html = $resposta->getBody();

$crawler = new Crawler();
$crawler->addHtmlContent($html); //Adicionando html ao leitor do dom

//tag e classe no html onde vem os cursos
$cursos = $crawler->filter('span.card-curso__nome');

foreach ($cursos as  $curso) {
    //lendo o texto do html selecionado
    echo $curso->textContent . PHP_EOL;
}