<?php

namespace App\Services\API\Article\Source\Output;

use App\Models\Author;
use App\Models\News;


class ArticleMySqlOutput implements ArticleOutputInterface
{
    /**
     * Save Articles
     * @param array $array Array
     * @param integer $category_id Category
     *
     * @return mixed
     * @throws \Exception
     */
    public function execute(array $array, string $category_id)
    {
        foreach ($array as $item) {
            $article = new News();

            $article->title = $item['title'];
            $article->source = $item['source']['name'];

            if ($item['author']) {
                $author = Author::updateOrCreate(['name' => $item['author']]);
                $article->author_id = $author->id;
            }


            $article->description = $item['description'];
            $article->url = $item['url'];
            $article->urlToImage = $item['urlToImage'];

            $article->category_id = $category_id;
            $article->publishedAt = new \DateTime('@' . strtotime($item['publishedAt'])); //TZ time format
            $article->content = $item['content'];

            $article->save();
        }
    }
}
