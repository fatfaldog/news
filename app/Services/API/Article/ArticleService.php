<?php

namespace App\Services\API\Article;

use App\Models\Article;
use App\Models\News;
use App\Models\Category;
use App\Services\API\Article\Source\Input\ArticleApiInput;
use App\Services\API\Article\Source\Converter\ArticleMysqlConverter;
use App\Services\API\Article\Source\Output\ArticleMySqlOutput;
use Illuminate\Support\Facades\Http;

class ArticleService implements ArticlesInterface
{
    private $converter;
    private $input;
    private $output;

    public function __construct(ArticleMysqlConverter $converter, ArticleMySqlOutput $output, ArticleApiInput $input)
    {
        $this->converter = $converter;
        $this->input = $input;
        $this->output = $output;
    }

    /**
     * Update Article from API
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {
        $date = date('Y-m-d');

        $categories = Category::all();

        Article::query()->delete();

        foreach ($categories as $category) {
            $result = $this->input->load($category->name, $date, $date, 'popularity');

            $arr = $this->converter->convert($result);

            $this->output->execute($arr, $category->id);
        }
    }

}
