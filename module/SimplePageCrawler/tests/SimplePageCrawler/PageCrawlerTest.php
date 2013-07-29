<?php

/*
 * This file is part of the SimplePageCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SimplePageCrawlerTest;

use PHPUnit_Framework_TestCase as TestCase;

use SimplePageCrawler\PageCrawler;
use SimplePageCrawler\Response;

class PageCrawlerTest extends TestCase
{
    public function testCanCrawlPage()
    {
        $pageCrawler = new PageCrawler();
        $response = $pageCrawler->get('http://www.zend.com/fr/');

        $this->assertEquals(true, $response instanceof Response);
        $this->assertTrue(
            (boolean)preg_match("#^Serveur Web d'applications PHP#", $response->getTitle())
        );
        $this->assertTrue(
            (boolean)preg_match("#^Zend est le fournisseur de#", $response->getMeta('description'))
        );
        $this->assertTrue(in_array('Zend - The PHP Company', $response->getH1()));
        $this->assertTrue(in_array('http://static.zend.com/img/newfp/twitter_icon.png', $response->getImages()->getArrayCopy()));
        $this->assertTrue(in_array('/fr/user/logout', $response->getLinks()->getArrayCopy()));
        $this->assertFalse(in_array('#', $response->getLinks()->getArrayCopy()));
    }

    public function testCanGetOpenGraphMeta()
    {
        $pageCrawler = new PageCrawler();
        $response = $pageCrawler->get('http://au-coeur-de-zend-framework-2.fr');

        $metas = $response->getMeta()->getMeta();
        $openGraph = $response->getMeta()->getOpenGraph();

        $this->assertTrue($metas->offsetExists('description'));
        $this->assertTrue($openGraph->offsetExists('image'));

        $this->setExpectedException('Zend\Stdlib\Exception\InvalidArgumentException');
        $response->getMeta('image');
    }
}
