<?php

namespace App\Services\API\Article\Source\Input;

use App\Services\API\Article\Source\Converter\ArticleConverterInterface;

class ArticleMySqlConverter implements ArticleConverterInterface
{
    /**
     * Convert json to Array
     * @return mixed
     */
    public function convert(string $json): array
    {
        $response = json_decode($json, true);

        return $response;
    }
}
