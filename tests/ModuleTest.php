<?php

use App\Models\Author;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use \App\Models\News;
use \App\Models\Category;

class ModuleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $author = new Author();
        $author->name = 'DemoAuthor';
        $author->save();

        $category = new Category();
        $category->name = 'demoCategory';
        $category->save();

        $news = new News();
        $news->title = 'DemoTitle';
        $news->source = 'url';
        $news->author_id = $author->id;
        $news->description = 'DemoDescription';
        $news->url = 'demo.url?message=sdsdsdfsdkfjal;dkj;lkjalkdjsad;lgsajd;ldkgjsal;gkjas;dl';
        $news->urlToImage = 'demo.url?message=sdsdsdfsdkfjal;dkj;lkjsdsddsdsssssssssssssssssalkdjsad;lgsajd;ldkgjsal;gkjas;dl';

        $news->category_id = $category->id;
        $news->publishedAt = new \DateTime('@' . strtotime('2021-10-28T12:21:33z')); //TZ time format
        $news->content = 'content                     cv                          end';

        $news->save();



        $news2 = News::with(['author', 'category'])->where('title', 'DemoTitle')->first();

        $this->assertEquals($news2->typename,'news');
        $this->assertEquals($news2->author->name,'DemoAuthor');
        $this->assertEquals($news2->category->name,'demoCategory');

        $news2->delete();
        $author->delete();
        $category->delete();
    }
}
