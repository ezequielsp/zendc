<?php

/*
 * This file is part of the SimplePageCrawler package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace SimplePageCrawler;

use ArrayObject;
use Zend\Stdlib\AbstractOptions;
use Zend\Stdlib\Exception;

class Response extends AbstractOptions
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var Response\Meta
     */
    protected $meta;

    /**
     * @var Response\Image
     */
    protected $images;

    /**
     * @var ArrayObject
     */
    protected $headingTags;

    /**
     * @var ArrayObject
     */
    protected $links;

    /**
     * @var ArrayObject
     */
    protected $b;

    /**
     * @var ArrayObject
     */
    protected $strong;

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getMeta($meta = null)
    {
        if(null === $this->meta) {
            $this->setMeta(new Response\Meta());
        }
        if($meta) {
            return $this->meta->getMeta($meta);
        }
        return $this->meta;
    }

    public function setMeta(Response\Meta $meta)
    {
        $this->meta = $meta;
        return $this;
    }

    public function getImages()
    {
        if(null === $this->images) {
            $this->setImages(new Response\Image());
        }
        return $this->images;
    }

    public function setImages(Response\Image $images)
    {
        $this->images = $images;
        return $this;
    }

    public function getHeadingTags()
    {
        if(null === $this->headingTags) {
            $this->setHeadingTags(new ArrayObject());
        }
        return $this->headingTags;
    }

    public function setHeadingTags($headingTags)
    {
        if(is_array($headingTags)) {
            $this->getHeadingTags()->exchangeArray($headingTags);
            return $this;
        }
        if(!$headingTags instanceof ArrayObject) {
            throw new Exception\InvalidArgumentException('Heading tags must be an array or an ArrayObject');
        }
        $this->headingTags = $headingTags;
        return $this;
    }

    public function getH1()
    {
        return $this->headingTags['h1'];
    }

    public function getH2()
    {
        return $this->headingTags['h2'];
    }

    public function getH3()
    {
        return $this->headingTags['h3'];
    }

    public function getH4()
    {
        return $this->headingTags['h4'];
    }

    public function getH5()
    {
        return $this->headingTags['h5'];
    }

    public function getBold()
    {
        return $this->headingTags['b'];
    }

    public function getStrong()
    {
        return $this->headingTags['strong'];
    }

    public function getScript()
    {
        return $this->headingTags['script'];
    }

    public function getFrames()
    {
        if(null === $this->frames) {
            $this->setFrames(new ArrayObject());
        }
        return $this->frames;
    }

    public function getLinks()
    {
        if(null === $this->links) {
            $this->setLinks(new ArrayObject());
        }
        return $this->links;
    }

    public function setLinks($links)
    {
        if(is_array($links)) {
            $this->getLinks()->exchangeArray($links);
            return $this;
        }
        if(!$links instanceof ArrayObject) {
            throw new Exception\InvalidArgumentException('Links must be an array or an ArrayObject');
        }
        $this->links = $links;
        return $this;
    }

    public function setFrames($frames)
    {
        if(is_array($frames)) {
            $this->getFrames()->exchangeArray($frames);
            return $this;
        }
        if(!$frames instanceof ArrayObject) {
            throw new Exception\InvalidArgumentException('Frames must be an array or an ArrayObject');
        }
        $this->frames = $frames;
        return $this;
    }

}
