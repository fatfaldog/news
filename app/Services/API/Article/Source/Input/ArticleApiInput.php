<?php

namespace App\Services\API\Article\Source\Input;

use App\Models\Category;
use App\Services\API\Article\Source\Converter\ArticleInputInterface;
use Illuminate\Support\Facades\Http;

class ArticleApiInput implements ArticleInputInterface
{
    /**
     * Download Article from API
     *
     * @param string $q Query string
     * @param string $date_from Date from  Y-m-d
     * @param string $date_to DateTo Y-m-d
     * @param string $sort_by Sort By
     *
     *
     * @return string Download Result
     */
    public function load(string $q, string  $date_from, string $date_to, string $sort_by): string
    {
        $apiRequest = Http::get('https://newsapi.org/v2/everything', [
            'from' => $date_from,
            'to' => $date_to,
            'sortBy' => $sort_by,
            'apiKey' => env('NEWS_API_KEY', true),
            'q' => $q,
        ]);

        return $apiRequest->getBody();
    }
}
