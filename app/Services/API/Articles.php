<?php

namespace App\Services\API;

use Illuminate\Support\Facades\Http;

class Articles implements ArticlesInterface
{
    /**
     * Update Article from API
     * @return mixed
     */
    public function updateArticles(){
        $date = date('Y-m-d');

        $apiRequest = Http::get('https://newsapi.org/v2/everything', [
            'from' => $date,
            'to' => $date,
            'sortBy' => 'popularity',
            'apiKey' => env('NEWS_API_KEY', true),
            'q' => 'CRON'
        ]);

        $response = json_decode($apiRequest->getBody());

        dd($response);
    }

}
