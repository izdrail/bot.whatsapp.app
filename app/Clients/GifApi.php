<?php


namespace App\Clients;


use GuzzleHttp\Client;

class GifApi extends Client
{

    protected $url = 'https://api.giphy.com/v1/gifs/search?api_key=kPtar2nrkHSh0QJSxrHFufsflqMQxc8W&q=love&limit=25&offset=0&rating=G&lang=en';

    /**
     * @method getRandomLoveGif()
     */
    public function getRandomLoveGif():array {

        $r = $this->get($this->url);

        $response =  (json_decode($r->getBody(), true));

        return ($response['data']);

    }

}
