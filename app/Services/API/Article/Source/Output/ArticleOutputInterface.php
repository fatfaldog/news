<?php

namespace App\Services\API\Article\Source\Output;

interface ArticleOutputInterface
{
    /**
     * Save Articles
     * @return mixed
     */
    public function execute($array);
}
