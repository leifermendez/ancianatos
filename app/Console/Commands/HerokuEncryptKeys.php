<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class HerokuEncryptKeys extends Command
{

    const CIPHER = 'aes-256-cbc';
    const IV = 'xiu2jsujeksieuc7';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'heroku:encryptkeys';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Encrypts the oauth keys, for storing in vcs';
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
        if (!env('OENCRYPT_KEY')) {
            $this->error('No OENCRYPT_KEY env found!');
            return false;
        }
        if (strlen(env('OENCRYPT_KEY')) < 64) {
            $this->error('OENCRYPT_KEY too short');
            return false;
        }

        if(!file_exists(storage_path('oauth-private.key'))) {
            $this->error(sprintf('Cannot find %s', storage_path('oauth-private.key')));
            return false;
        }

        if(!file_exists(storage_path('oauth-public.key'))) {
            $this->error(sprintf('Cannot find %s', storage_path('oauth-public.key')));
            return false;
        }
        $privateKey = file_get_contents(storage_path('oauth-private.key'));
        Storage::put('oauth-private.key.encrypted', $this->oEncrypt($privateKey));
        $publicKey = file_get_contents(storage_path('oauth-public.key'));
        Storage::put('oauth-public.key.encrypted', $this->oEncrypt($publicKey));

        $this->info('Encrypted keys');

    }

    private function oEncrypt($data)
    {
        if (in_array(self::CIPHER, openssl_get_cipher_methods())) {
            return openssl_encrypt($data, self::CIPHER, env('OENCRYPT_KEY'), $options = 0, self::IV);
        } else {
            $this->error('Could not find cipher '. self::CIPHER);
            return false;
        }

    }
}
