<?php

namespace App\Services\API\Articles;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Http;

class News implements ArticlesInterface
{
    /**
     * Update Article from API
     * @return mixed
     */
    public function updateArticles()
    {
        $date = date('Y-m-d');

        $categories = Category::all();
        foreach ($categories as $category) {
            $apiRequest = Http::get('https://newsapi.org/v2/everything', [
                'from' => $date,
                'to' => $date,
                'sortBy' => 'popularity',
                'apiKey' => env('NEWS_API_KEY', true),
                'q' => $category['name'],
            ]);

            $response = json_decode($apiRequest->getBody(), true);

            foreach ($response['articles'] as $item) {
                if (isset($item['source']['name'])) {
                    $article = new Article();

                    $article->title = $item['title'];
                    $article->title = $item['title'];
                    $article->title = $item['title'];
                    $article->title = $item['title'];
                }
            }
//        'title',
//        'source',
//        'author',
//        'description',
//        'url',
//        'urlToImage',
//        'publishedAt',
//        'content',
//        'category_id',
//        'article_type',
        }

    }

}
