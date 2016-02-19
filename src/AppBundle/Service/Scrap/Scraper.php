<?php

namespace AppBundle\Service\Scrap;

use AppBundle\Service\KeyValueStorageInterface;
use AppBundle\Service\PageParser;
use GuzzleHttp\Psr7\Response;

class Scraper
{
    /**
     * @var PageParser
     */
    private $parser;

    /**
     * @var KeyValueStorageInterface
     */
    private $storage;

    /**
     * Scraper constructor.
     * @param $parser
     * @param $storage
     */
    public function __construct(PageParser $parser, KeyValueStorageInterface $storage)
    {
        $this->parser = $parser;
        $this->storage = $storage;
    }

    public function scrap($key, $path)
    {
        $client = $this->getClient();

        /* @var $response Response */
        $response = $client->get($path);

        $this->storage->set(
            $key,
            json_encode($this->parser->parse($response->getBody()->getContents()))
        );
    }

    /**
     * @return \GuzzleHttp\Client
     */
    protected function getClient()
    {
        return new \GuzzleHttp\Client([
            'base_uri'      => 'http://wikibusiness.org/'
        ]);
    }
}