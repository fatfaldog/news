<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class FeatureTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testArticlesSearch()
    {
        $this->get('api/articles/search');

        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'data' => ['*' =>
                [
                    'title',
                    'content',
                    'description',
                ],
            ],

        ]);

    }



    /**
     * A basic test example.
     *
     * @return void
     */
    public function testArticlesSearchQuery()
    {
        $this->get('api/articles/search?q=NFT');

        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'data' => ['*' =>
                [
                    'title',
                    'content',
                    'description',
                ],
            ],

        ]);

    }
}
