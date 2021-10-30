<?php

namespace App\GraphQL\Type;

use GraphQL;
use App\Models\Article;
use GraphQL\Type\Definition\Type;
use Nuwave\Lighthouse as GraphQLType;

class NewsArticleType extends GraphQLType {

    protected $attributes = [
        'name'          => 'news_article',
        'description'   => 'A news article',
        'model'         => Article::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user',
            ],
            'headline' => [
                'type' => Type::string(),
                'description' => 'The headline of the news article',
            ],
            'slug' => [
                'type' => Type::string(),
                'description' => 'The slug of the news article'
            ],
            'article' => [
                'type' => Type::string(),
                'description' => 'The body of the news article'
            ],
            'author' => [
                'type' => GraphQL::type('user'),
                'description' => 'The author of the news article'
            ],
        ];
    }
}
