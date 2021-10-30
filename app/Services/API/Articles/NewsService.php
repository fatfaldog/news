<?php

namespace App\Services\API\Articles;

use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Facades\Http;

class NewsService implements ArticlesInterface
{
    /**
     * Update Article from API
     * @return mixed
     */
    public function download()
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
                    $article = new News();

                    $article->title = $item['title'];
                    $article->source = $item['source']['name'];
                    $article->author = $item['author'];
                    $article->description = $item['description'];
                    $article->url = $item['url'];
                    $article->urlToImage = $item['urlToImage'];


                    $article->publishedAt = new \DateTime('@' . strtotime($item['publishedAt'])); //TZ time format
                    $article->content = $item['content'];

                    $article->category_id = $category->id;
                    $article->save();
                }
            }
        }

    }

}
