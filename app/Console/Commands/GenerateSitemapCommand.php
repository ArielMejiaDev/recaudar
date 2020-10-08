<?php

namespace App\Console\Commands;

use App\Models\Team;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;

class GenerateSitemapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It generates the sitemap xml file';

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
     * @return int
     */
    public function handle()
    {
        $sitemap = Sitemap::create(config('app.url'));

        Team::chunk(100, function($teams) use ($sitemap){
            foreach ($teams as $team) {
                $sitemap->add(
                    route('profile-page', $team)
                );
            }

        });

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
