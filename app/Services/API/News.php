<?php

namespace App\Services\API;

use Illuminate\Support\Facades\Http;

class News implements NewsInterface
{
    /**
     * Update News from API
     * @return mixed
     */
    public function updateNews(){
        $news_api_key = env('NEWS_API_KEY', true);

        $response = Http::post('http://example.com/users', [
            'name' => 'Steve',
            'role' => 'Network Administrator',
        ]);
    }
}
