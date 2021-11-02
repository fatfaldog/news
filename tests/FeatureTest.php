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

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testArticlesSearchQueryTypeName()
    {
        $this->get('api/articles/search?typename=news');

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
    public function testArticlesSearchQueryFromDate()
    {
        $this->get('api/articles/search?from_date=2021-08-11&from_date=2021-10-11');

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
     * Refresh news command test
     *
     * @return void
     */
    public function testArtisanCommand()
    {
        $this->assertEquals($this->artisan('article:refresh'),0);
    }



    /**
     * GraphQL query test
     *
     * @return void
     */
    public function testGraphQL()
    {
        $this->get('/graphql',
            [
                'query' => 'query
{
  allnews
{
  title
  content
  category
  {
      name
  }
  author
  {
      name
  }
  source
  url
  publishedAt
}
}'

            ]);

        $this->seeStatusCode(200);

    }

}
