<?php

namespace App\Services\API\Article\Source\Output;

interface ArticleOutputInterface
{
    /**
     * Save Articles
     * @param array $array Array
     * @param integer $category_id Category
     *
     * @return mixed
     */
    public function execute(array $array, string $category_id);
}
