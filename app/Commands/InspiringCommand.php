<?php

namespace App\Commands;

use App\Clients\ChatApi;
use App\Client\GifApi;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Collection;
use LaravelZero\Framework\Commands\Command;

class InspiringCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'send {phone : The phone number to send the message to in international format (required)} {url : The url for the chat api (required)}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Sends a nice message to your choosing number';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Send a message to your somebody you love');

        $url = str_replace('url=', '', $this->argument('url'));

        $phone = str_replace('phone=', '', $this->argument('phone'));

        $client = new ChatApi([], $url);

        $gifClient = new \App\Clients\GifApi([]);

        $messages = new Collection($gifClient->getRandomLoveGif());

        $obj = $messages->random(1);

        $randomGif = ($obj->first()['url']);

        $response = $client->execute($phone, $randomGif);

        if($response === true){

            $this->info('Message Sent');

        }else{

            $this->info('Message not sent');
        }

    }

}
