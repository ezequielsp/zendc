<?php

namespace Home\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use SimplePageCrawler\SimplePageCrawler;
use Home\Form\UrlForm;
use Home\Model\Url;
use Home\Model\Cat;

class IndexController extends AbstractActionController
{

	protected $_pageCraw;

    public function indexAction() 
    {
        $crawler = $this->getCrawle();
        $form = new UrlForm();
        $form->get('submit')->setAttribute('value', 'Consultar');

        $request = $this->getRequest();
        if ($request->isPost()) {
        	$url = new Url;
            
        	$form->setInputFilter($url->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
            	$url->exchangeArray($form->getData());
                $page = $crawler->get($url->url);

                if(404 != $page) {
                $script = $page->getScript(); 

                foreach ($script as $s) {
                    if(preg_match('/.*(window|self).location(|\s+)=(|\s+)\"/i', $s)) {
                        $redirect = self::extractUrl($s);
                        $page = $crawler->get(urldecode($redirect));
                    }
                    
                }

                $frames = $page->getFrames();
                
                if(!empty($frames[0])) {
                    foreach ($frames as $f) {
                        if(preg_match('/^http/i', $f))
                        {
                           $pageFrame[] = $crawler->get(urldecode($f));

                           $framesUrls[] = urldecode($f);                        
                        }     
                    }
                    
                }

                $cat = new Cat;
            	return array(
        			'form' => $form,
                    'cat'  => $cat,
                    'pageFrame' => $pageFrame,
                    'framesUrls' => $framesUrls,
                    'cats' => $cat->getCat($page),
                    'metas' => $page->getMeta()->getOpenGraph(),
                    'url' => $url->url,
                    'urlRedirect' => $redirect,
            		'title' => $page->getTitle(),
            		'desc' => $page->getMeta('description'),
            		'keywords' => $page->getMeta('keywords'),
                    'links' => $page->getLinks(),
                    'bold' => $page->getBold(),
                    'strong' => $page->getStrong(),
            		'h1' => $page->getH1(),
            		'h2' => $page->getH2(),
            		'h3' => $page->getH3(),
            		'h4' => $page->getH4(),
            		'h5' => $page->getH5(),
                    'frames' => $page->getFrames(),
        		);
                } 
        	}
        }
        
        return array(
        	'form' => $form,
        );

    }

    public function extractUrl($s) 
    {
        $s = preg_replace('/\\r/', '', $s);
        $s = preg_replace('/\\t/', '', $s);
        $s = preg_replace('/\\n/', '', $s);
        $s = preg_replace('/\"/i', '', $s);
        $s = preg_replace('/;/i', '', $s);
        $s = preg_replace('/=/i', '', $s);
        $s = preg_replace('/\s+/i', '', $s);
        $s = preg_replace('/self.location/i', '', $s);
        $s = preg_replace('/window.location/i', '', $s);
        $s = preg_replace("/\\\\\//i", '/', trim($s));
        $url = trim($s);

        return $url;
    }

    public function getCrawle() 
    {
        if (!$this->_pageCraw) {
            $sm = $this->getServiceLocator();
            $this->_pageCraw = $sm->get('SimplePageCrawler');
        }
        return $this->_pageCraw;
    }

}
