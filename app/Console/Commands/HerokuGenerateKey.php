<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class HerokuGenerateKey extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'heroku:generatekey';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Outputs a key to use for OENCRYPT_KEY';
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
        $this->info(bin2hex(openssl_random_pseudo_bytes(64)));
    }
}
