<?php

namespace App\Console\Commands;

use App\Services\API\Article\ArticleService;
use Illuminate\Console\Command;

class RefreshArticlesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'article:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh articles';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param \App\Services\API\Article\ArticleService $news
     * @return mixed
     */
    public function handle(ArticleService $news)
    {
        $news->handle();
    }
}
