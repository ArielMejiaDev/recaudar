<?php

namespace App\Console\Commands;

use App\Models\Team;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Validation\Rule;

class CreateApplicationAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It creates admin users by terminal';

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
     * @return void
     */
    public function handle()
    {
        $team = Team::whereName('recaudar')->first();
        $this->line('creating an admin for team ' . $team->name . ' ...');

        $name = $this->ask('User name');
        $email = $this->ask('user email');
        $password = $this->secret('user password');
        $password_confirmation = $this->secret('confirm user password');

        $validation = \Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password_confirmation,
        ], [
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'min:3', Rule::unique('users')],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        if($validation->fails()) {
            return $this->error($validation->errors()->first());
        }

        if($this->confirm('Are you sure that you want to create an admin user?')) {
            $this->output->progressStart(3);

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
            ]);
            $this->output->progressAdvance();

            $user->teams()->attach($team, ['role_name' => 'app_admin']);
            $this->output->progressAdvance();

            $user->sendEmailVerificationNotification();
            $this->output->progressAdvance();

            $this->output->progressFinish();
            $this->info('User created successfully now user can logged in with email: ' . $email . ' on ' . route('login'));
        }
    }
}
