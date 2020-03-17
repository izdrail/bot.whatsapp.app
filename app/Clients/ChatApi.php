<?php


namespace App\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

class ChatApi extends Client
{
    protected $url = '';

    public function __construct(array $config = [], $url)
    {
        parent::__construct($config);

        $this->url = $url;

    }


    /**
     * @method execute()
     * @param $to
     * @param $message
     * @return bool
     */
    public function execute(string $to, string $message):bool
    {
        $container = [];

        $history = Middleware::history($container);

        $stack = HandlerStack::create();

        $stack->push($history);

        $client = new Client(['handler' => $stack, 'debug' => false]);

        $r= $client->request('POST', $this->url,[
            'json' =>  ([
                'phone' => intval($to),
                'body' => $message
            ])
        ]);

        $response = (json_decode($r->getBody(),200));

        return !($response['sent'] === false);

    }

}
