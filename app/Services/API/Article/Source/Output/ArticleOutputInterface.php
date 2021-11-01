<?php

namespace App\Services\API\Article\Source\Converter;

interface ArticleOutputInterface
{
    /**
     * Save Articles
     * @return mixed
     */
    public function execute($array);
}
