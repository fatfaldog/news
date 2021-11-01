<?php

namespace App\Services\API\Article\Source\Output;

use App\Models\News;


class ArticleMySqlOutput implements  ArticleOutputInterface
{
    /**
     * Save Articles
     * @return mixed
     */
    public function execute($array){
        foreach ($array as $item) {
            if (isset($item['source']['name'])) {
                $article = new News();

                $article->title = $item['title'];
                $article->source = $item['source']['name'];
                $article->author = $item['author'];
                $article->description = $item['description'];
                $article->url = $item['url'];
                $article->urlToImage = $item['urlToImage'];


                $article->publishedAt = new \DateTime('@' . strtotime($item['publishedAt'])); //TZ time format
                $article->content = $item['content'];

                $article->save();
            }
        }
    }
}
