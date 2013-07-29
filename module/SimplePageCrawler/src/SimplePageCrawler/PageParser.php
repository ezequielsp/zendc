<?php

/*
 * This file is part of the SimplePageCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SimplePageCrawler;

use Zend\Dom\Query as DomQuery;

class PageParser
{
    public static function fromPageSource($source)
    {
        $response = new Response();
        $domQuery = new DomQuery();
        $domQuery->setDocumentHtml($source);

        $metas = array();
        $nodes = $domQuery->queryXpath('//meta');
        foreach($nodes as $node) {
            if(!$node->hasAttribute('name') && !$node->hasAttribute('property')) {
                continue;
            }
            $name = $node->getAttribute('name') ?: $node->getAttribute('property');
            $name = strtolower($name);
            $content = $node->getAttribute('content');
            $metas[$name] = $content;
        }
        $response->getMeta()->exchangeArray($metas);

        $tags = $response->getHeadingTags();
        $h1 = array();
        $h2 = array();
        $h3 = array();
        $h4 = array();
        $h5 = array();
        $b = array();
        $strong = array();
        $script = array();
        $frame = array();

        $nodes = $domQuery->queryXpath('//h1');
        foreach($nodes as $node) {
            $h1[] = $node->textContent;
        }
        $nodes = $domQuery->queryXpath('//h2');
        foreach($nodes as $node) {
            $h2[] = $node->textContent;
        }
        $nodes = $domQuery->queryXpath('//h3');
        foreach($nodes as $node) {
            $h3[] = $node->textContent;
        }
        $nodes = $domQuery->queryXpath('//h4');
        foreach($nodes as $node) {
            $h4[] = $node->textContent;
        }
        $nodes = $domQuery->queryXpath('//h5');
        foreach($nodes as $node) {
            $h5[] = $node->textContent;
        }

        $nodes = $domQuery->queryXpath('//b');

        foreach($nodes as $node) {
            $b[] = $node->textContent;
        }

        $nodes = $domQuery->queryXpath('//strong');

        foreach($nodes as $node) {
            $strong[] = $node->textContent;
        }

        $nodes = $domQuery->queryXpath('//script');

        foreach($nodes as $node) {
            $script[] = $node->textContent;
        }

        $nodes = $domQuery->queryXpath('//frame');

        foreach($nodes as $node) {
            $frame[] = $node->textContent;
        }



        $tags->offsetSet('h1', $h1);
        $tags->offsetSet('h2', $h2);
        $tags->offsetSet('h3', $h3);
        $tags->offsetSet('h4', $h4);
        $tags->offsetSet('h5', $h5);
        $tags->offsetSet('b', $b);
        $tags->offsetSet('strong', $strong);
        $tags->offsetSet('script', $script);
        $tags->offsetSet('frame', $frame);

        $node = $domQuery->queryXpath('//title')->current();
        if($node) {
            $response->title = $node->textContent;
        }

        $img = array();
        $nodes = $domQuery->queryXpath('//img');
        foreach($nodes as $node) {
            $img[] = $node->getAttribute('src');
        }
        $response->getImages()->exchangeArray(array_unique($img));

        $links = array();
        $nodes = $domQuery->queryXpath('//a');
        foreach($nodes as $node) {
            if(!$node->hasAttribute('href')) {
                continue;
            }
            $href = $node->getAttribute('href');
            if(
                preg_match('/^#/', $href) ||
                preg_match('/^javascript/', $href)
            ) {
                continue;
            }
            $links[] = $href;
        }
        $response->links = array_unique($links);

        $frames = array();
        $nodes = $domQuery->queryXpath('//frame');
        foreach($nodes as $node) {
            if(!$node->hasAttribute('src')) {
                continue;
            }
            $src = $node->getAttribute('src');
            if(
                preg_match('/^#/', $src) ||
                preg_match('/^javascript/', $href)
            ) {
                continue;
            }
            $frames[] = $src;
        }
        $response->frames = array_unique($frames);

        return $response;
    }
}
