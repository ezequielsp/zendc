<?php

/*
 * This file is part of the SimplePageCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SimplePageCrawler;

use Zend\Http\Client;
use Zend\Http\Request;
use Zend\Stdlib\Exception\InvalidArgumentException;

class PageCrawler
{
    /**
     * The http client
     * @var Client
     */
    protected $httpClient;

    /**
     * Crawl & parse the uri
     * @param string $uri
     * @return Response
     */
    public function get($uri)
    {
        if($uri instanceof Request) {
            $uri = $uri->getUri();
        }
        if(!is_string($uri)) {
            throw new InvalidArgumentException(
                'Uri must a string or instance of HttpRequest'
            );
        }

        $options = array(
            'adapter'           =>      'Zend\Http\Client\Adapter\Curl',
            'maxredirects'      =>      3,
            'timeout'           =>      60,
            'strictredirects'   =>      false,
            'useragent'         =>      'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:16.0) Gecko/20100101 Firefox/16.0',
            'keep-alive'        =>      true,
            'curloptions'       =>      array(
                CURLOPT_SSL_VERIFYPEER          => false,
                // CURLOPT_ENCODING                =>      'gzip',
                CURLOPT_AUTOREFERER             => true,
                CURLOPT_FOLLOWLOCATION          => true
            )
        );


        $httpClient = new Client();
        $httpClient->setOptions($options);
        $httpClient->setUri($uri);

        $response = $httpClient->getResponse();

            //set content-type
        $response->getHeaders()->addHeaderLine('content-type', 'text/html; charset=utf-8'); 

        $source = $httpClient->send();
       // var_dump($source->getStatusCode());

        
        if(200 == $source->getStatusCode()) {
           // if ( !empty($source->getBody()) ) {
                $response = PageParser::fromPageSource($source->getBody(), $uri);
          //  } else {
             //   $response = 404;
           // }
        } else {
            $response = $source->getStatusCode();
        }
        return $response;

    }

}
