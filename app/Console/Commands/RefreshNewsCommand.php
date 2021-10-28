<?php

namespace App\Console\Commands;

use App\Services\API\News;
use Illuminate\Console\Command;

class RefreshNewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh news';

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
     * @param \App\Services\API\News $news
     * @return mixed
     */
    public function handle(News $news)
    {
        $news->updateNews();
    }
}
