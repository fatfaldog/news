<?php

namespace App\Services\API\Article\Source\Converter;

interface ArticleConverterInterface
{
    /**
     * Convert json to Array
     * @return mixed
     */
    public function convert(string $json): array;
}
