<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GrahamCampbell\GitHub\Facades\GitHub;

class ConnectToGithubCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'github:connect';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command just connect to github';

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
     * @return mixed
     */
    public function handle()
    {

       $commits = GitHub::api('repo')->commits()->all('nodejs', 'node', array('sha' => 'master'));
       print_r(count($commits)); exit;
    }
}
