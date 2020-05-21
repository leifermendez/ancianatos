<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class HerokuInstallKey extends Command
{

    const CIPHER = 'aes-256-cbc';
    const IV = 'xiu2jsujeksieuc7';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'heroku:installkeys';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs the oauth keys, for Heroku builds';
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

        if(!file_exists(storage_path('app/oauth-private.key.encrypted'))) {
            $this->error(sprintf('Cannot find %s', storage_path('app/oauth-private.key.encrypted')));
            return false;
        }

        if(!file_exists(storage_path('app/oauth-public.key.encrypted'))) {
            $this->error(sprintf('Cannot find %s', storage_path('app/oauth-public.key.encrypted')));
            return false;
        }

        if(file_exists(storage_path('oauth-public.key')) || file_exists(storage_path('oauth-private.key'))) {
            $this->error(sprintf('Refusing to overwrite existing keys'));
            return false;
        }

        $privateKey = file_get_contents(storage_path('app/oauth-private.key.encrypted'));
        file_put_contents(storage_path('oauth-private.key'), $this->oDecrypt($privateKey));
        chmod(storage_path('oauth-private.key'), 0600);

        $publicKey = file_get_contents(storage_path('app/oauth-public.key.encrypted'));
        file_put_contents(storage_path('oauth-public.key'), $this->oDecrypt($publicKey));
        chmod(storage_path('oauth-public.key'), 0600);

        $this->info('Keys installed');

    }

    private function oDecrypt($data)
    {
        if (!env('OENCRYPT_KEY')) {
            $this->error('No OENCRYPT_KEY env found!');
            return false;
        }
        if (in_array(self::CIPHER, openssl_get_cipher_methods())) {
            $plainText = openssl_decrypt($data, self::CIPHER, env('OENCRYPT_KEY'), $options = 0, self::IV);
            return $plainText;
        } else {
            $this->error('Could not find cipher '. self::CIPHER);
            return false;
        }

    }
}
