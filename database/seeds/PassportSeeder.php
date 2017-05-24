<?php

use Laravel\Passport\Client;
use Illuminate\Database\Seeder;

class PassportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Artisan::call('passport:install');

        $client = Client::find(2);

        updateDotEnv([
            'APP_CLIENT_ID' => $client->id,
            'APP_CLIENT_SECRET' => $client->secret,
        ]);
    }
}
