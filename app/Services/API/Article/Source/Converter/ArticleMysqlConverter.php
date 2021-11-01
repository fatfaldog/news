<?php

namespace App\Services\API\Article\Source\Converter;

class ArticleMysqlConverter implements ArticleConverterInterface
{
    /**
     * Convert json to Array
     * @return mixed
     */
    public function convert(string $json): array
    {
        $response = json_decode($json, true);

        return $response['articles'];
    }
}
