<?php

//classe que nao segue a psr4, não tem namespace

class Teste
{
    public static function teste()
    {
        echo "Teste";
    }
}

class Teste2
{
    public static function teste2(): void
    {
        echo "Teste2";
    }
}