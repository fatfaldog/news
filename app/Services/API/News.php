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
        $response = Http::post('http://example.com/users', [
            'name' => 'Steve',
            'role' => 'Network Administrator',
        ]);
    }
}
