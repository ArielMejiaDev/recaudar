<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class DeleteUsersWithoutTeamsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:users-without-teams';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It deletes users that has at least 6 months without teams';

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
        try {
            User::doesntHave('teams')
                ->whereMonth('created_at', now()->subMonths(6))
                ->delete();
            $this->info('Users deleted!');
        } catch (\Exception $exception) {
            $this->info('No user deleted');
        }
    }
}
