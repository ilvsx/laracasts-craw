<?php
namespace App;

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SetCookie;
use Symfony\Component\DomCrawler\Crawler;

class VideoLink
{

    private $client;

    private $uri;

    private $config;

    private $options;

    private $video_link;


    public function __construct($uri)
    {
        if (! $uri) {
            return;
        }

        $this->uri     = $uri;
        $this->client  = new Client([
            'cookie'          => true,
            'allow_redirects' => false,
            'base_uri'        => 'https://laracasts.com',
        ]);
        $this->config  = require 'config.php';
        $this->options = [
            'headers' => [
                'Accept'                    => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                'Accept-Encoding'           => 'gzip, deflate, sdch',
                'Accept-Language'           => 'zh-CN,zh;q=0.8,en;q=0.6,ja;q=0.4,zh-TW;q=0.2',
                'Cache-Control'             => 'no-cache',
                'Connection'                => 'keep-alive',
                'Pragma'                    => 'no-cache',
                'Cookie'                    => $this->config['cookie'],
                'Upgrade-Insecure-Requests' => '1',
                'Referer'                   => "https://laracasts.com/",
                'User-Agent'                => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36',
            ],
            'proxy'   => $this->config['proxy'],
        ];

        $this->video_link = $this->getDownLink();
    }


    public function getDownLink()
    {
        $res = $this->get($this->uri);

        $crawler   = new Crawler((string) $res->getBody());
        $down_link = $crawler->filter('.utility-naked-list >li >a')->attr('href');

        $res      = $this->get($down_link);
        $redirect = $res->getHeader('Location')[0];

        $res      = $this->get($redirect);
        $redirect = $res->getHeader('Location')[0];

        return $redirect;
    }

    public function getFIleName()
    {
        $p = parse_url($this->video_link)['query'];
        parse_str($p, $t);

        return trim($t['filename']);
    }


    // HTTP GET request.
    private function get($uri)
    {
        return $this->client->get($uri, $this->options);
    }


    public function __toString()
    {
        return $this->video_link;
    }

}
