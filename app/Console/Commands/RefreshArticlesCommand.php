<?php

namespace App\Console\Commands;

use App\Services\API\Articles\News;
use Illuminate\Console\Command;

class RefreshArticlesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:articles';

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
     * @param \App\Services\API\Articles\News $news
     * @return mixed
     */
    public function handle(News $news)
    {
        $news->updateArticles();
    }
}