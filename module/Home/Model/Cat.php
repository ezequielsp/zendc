<?php
namespace Home\Model;

class Cat
{
    public $total;

    public function analyse($word)
    {
        $total  = self::getCat($word);

        return $total;
    }

    public function getCat($page) 
    {
        $security = array(
        	"crack", "serial", "warez", "keygen", "cracked", 
        	"full", "version", "hack", "activation", "unlock", "code", 
            "patch", "hacked", "release", "doubleclick"
        );
        $securityTotal  = self::catTotal($security, $page);

        $potentialLiable = array(
        	'Keylogger', 'captures', 'keystroke', 'stealth', 'hacker', 'hackear',
        	'trojans', 'keyloggers', 'worms', 'malwares', 'virus', 'phishing', 
        	'exploit', 'shells', 'defacer', 'injection', 'stealer'
        );
        $potentialLiableTotal  = self::catTotal($potentialLiable, $page);

        $bandwidth = array(
        	'download', 'baixar', 'avi', 'rmvb', 'dvdrip', 
        	'ts', 'tsrip', 'torrent', 'bittorrent', 'upload',
        	'compartilhamento', 'sharing', 'reproduzir', 'transfer',
        	"watch"
        );
        $bandwidthTotal  = self::catTotal($bandwidth, $page);

        $personal = array(
            'destaques',  'enquete', 'esportes', 'noticias', 'noticia', 'economia', 
            'especiais', 'esporte', 'mulher',
            'jornais', 'revistas', 'biblioteca', 'classificados', 'compras', 'computador', 
            'corpo', 'saude', 'moda', 'carros', 'cinema', 'crianças', 'diversao', 'arte', 
            'economia', 'educação', 'internet', 'jogos', 'novelas', 'radio', 'tv', 'tempo', 
            'mapas', 'transito', 'viagem', 'jornalismo', 'informacao', 
            'cultura', 'entretenimento', 'lazer', 'opiniao', 'analise', 
            'internet', 'televisao', 'fotografia', 'imagem', 'som', 'audio', 
            'tecnologia', 'vestibular', 'empregos', 'humor', 'musica',
            'esporte', 'esportes', 'libertadores', 'gloeada', 'gol', 'jogos', 'penalti', 
            'futebol', 'brasileirao', 'fotologs', 'entretenimento', 'humor', 'tirinhas', 
            'memes', 'jogos', 'diversao', 
            'musicas', 'bandas', 'lol', 'dicas', 'manual', 
            'tutorial', 'vlog', 'piadas', 'bate-papo', 'chat', 'conversa', 'papo', 'salas',
            'blog', 'blogs', 'vlog', 'webmail', 'email', 'gratis', 'voce', 'amigos', 
            'you', 'friends', 'seu', 'sua', 'teu', 'tua'
        );
		
		$personalTotal  = self::catTotal($personal, $page);

        $controversial = array(
            'porn', 'sex', 'xxx', 'foda', 'sexy', 'porno', 'pelada', 'putaria', 
            'nudez', 'peladas', 'nuas', 'sexo', 'pornstars', 'brasileirinhas', 
            'bucetas', 'buceta', 'bundas', 'seios', 'tetas', 'peitos', 'chupetas', 'flagras', 
            'amadoras', 'gringas', 'transa', 'fodas', 'swing', 'lesbicas', "adulto",
            'menage', 'suruba', "casino", "gambling", "poker", "blackjack", "cigar", "cigars",
            "cannabis", "cocaine", "drugs", "drug", "crack", 'youporn', "yobt",
            "backdoorbox", "binaked", "onsexchat", "yourpornhere", "givemegay", 
            "xxxgr", "pornerbros", "hotfucker", "pornjaws", "tub-e", "n1tube", 
            "your-pornworld", "itubexxx", "buttcam", "sexasianx", "anal",
            "pornofilm", "sexfilm", "videofilm", "sex", "porno", "bondage", "bukkake", "cumshot", 
            "erotik", "erotisk", "sexbutik", "sexshop", "anal", "fetish", "pigesex", "lesbisk", 
            "oral", "blowjob", "cumshot", "gay", "adult", "masturbating", "milf", "milfs", "fucking",
            "milfthing", "cum", "cock", "orgasmus", "dildos", "vaginal", "gangbang", "brunette",
            "pornoamateur", "fetisch", "nude", "mature", "teens", "pussy", "amatuer", "brunettes",
            "pornography", "erotico", "amadorastube", "lesbicas", "gozadas", "facial",
            "bucetinha", "putinha", "puta", "putaria", "gostosas", "bunda", "xoxota", "trepada",
            "ninfetas", "orgias"
        );
        
        $controversialTotal  = self::catTotal($controversial, $page);

        $business = array(
        	'compra', 'loja', 'store', 'buy', 'compras', 'comprar', 'vender',
        	'confira', 'aproveite', 'imperdivel', 'frete', 'juros',
        	'vende', 'aluga', 'imoveis', 'ofertas', 
        	'produto', 'produtos', 'vendidos', 'compre', 'preco', 'pagando',
        	'desconto', 'presentes', 'televendas', 'atendimento', 'credito',
        	'boleto', 'cartao', 'paypal', 'debito', 'pagamento',
        	'product', 'support', 'business', 'security', 'banco', 'bank',
        	'economia', 'entrega', 'garantida', 'garantia', 'promocoes', 'negocios',
        	'negocio', 'publicidade', 'paid', 'promote', 'affiliate', 'promotion',
        	'empresa', 'comercio', 'comercio', 'sale', 'venda', 'locacao',
        	'advertise', 'advertisers'
        );
        
        $businessTotal  = self::catTotal($business, $page);

        $sum = $securityTotal['total'] +  
        	$potentialLiableTotal['total'] + 
        	$personalTotal['total'] +
        	$bandwidthTotal['total'] +
        	$controversialTotal['total'] + 
        	$businessTotal['total'];

        if(0 < $sum) {
        	$result['security-risk'] = 100 * $securityTotal['total'] / $sum;
        	$result['potential-liable'] = 100 * $potentialLiableTotal['total'] / $sum;
        	$result['general-interest-personal'] = 100 * $personalTotal['total'] / $sum;
        	$result['bandwidth-consuming'] = 100 * $bandwidthTotal['total'] / $sum;
        	$result['controversial'] = 100 * $controversialTotal['total'] / $sum;
        	$result['general-interest-business'] = 100 *  $businessTotal['total'] / $sum;
    	} else {
    		$result['general-interest-personal'] = 100;
    	}

        arsort($result);
        return $result;

    }

    public function clean($word) {
        $word = trim($word);
        $word = preg_replace("/\n/", ' ', $word);
        $word = preg_replace("/\s+/", ' ', $word);
        $word = preg_replace("/;/", '', $word);
        $word = preg_replace("/\"/", '', $word);
        $word = preg_replace("/\./", '', $word);
        $word = preg_replace("/\?/", '', $word);
        $word = preg_replace("/\(/", '', $word);
        $word = preg_replace("/\)/", '', $word);
        $word = preg_replace("/,/", '', $word);
        $word = preg_replace("/-/", '', $word);
        $word = preg_replace("/\'/", '', $word);
        $word = preg_replace("/:/", '', $word);
        $word = preg_replace("/\d/", '', $word);
        $word = preg_replace("/%/", '', $word);
        $word = preg_replace("/\W+>/", '', $word);
        $word = trim($word);
        $word = strtolower($word);
        $word = preg_replace("/Ãª/i", 'e', $word);
        $word = preg_replace("/ç/i", 'c', $word);
        $word = preg_replace("/ã/i", 'a', $word);
        $word = preg_replace("/õ/i", 'o', $word);
        $word = preg_replace("/ó/i", 'o', $word);
        $word = preg_replace("/ô/i", 'o', $word);
        $word = preg_replace("/í/i", 'i', $word);
        $word = preg_replace("/é/i", 'e', $word);
        $word = preg_replace("/ê/i", 'e', $word);
        $word = preg_replace("/ú/i", 'u', $word);
        $word = preg_replace("/Ã§/i", 'c', $word);
        $word = preg_replace("/Ã©/i", 'e', $word);
        $word = preg_replace("/Ã¡/i", 'a', $word);
        $word = preg_replace("/Ã¢/i", 'a', $word);
        $word = preg_replace("/Ã³/i", 'u', $word);
        
        

        if (!empty($word)) {
            $word = $word;
        }
        $word = self::remove($word);

        return $word;

    }

    public function remove($word) 
    {
        $preposicao = array(
            ' a ', ' por ', ' com ', ' em ', ' de ', 
            ' da ', ' o ', ' do ', ' dos ', ' das ', ' e ',
            ' na ', ' no ', ' de ', ' para ', ' um ',
            ' uma ', ' as ', ' os ', ' ao ', ' se ',
            ' nao ', ' ja ', ' que ', ' tem ', ' mas ',
            ' sem ', ' sao '
        );

        $word = trim($word);
        foreach ($preposicao as $p) {
           $word = preg_replace("/$p/", ' ', $word);
           $p = trim($p);
           $word = preg_replace("/^$p /", ' ', $word);
           $word = preg_replace("/ $p$/", ' ', $word);
        }

        if (!empty($word)) {
            $word = $word;
        }

       // var_dump($word);

        return $word;
    }

    public function catTotal($arrayName, $page) 
    {
        $total = 0;
        $other = 0;

        $clean = self::remove($page->getTitle());
        $words = explode(' ', $clean);

        if(is_array($words)) {
        	foreach ($words as $word) {
        		$word = self::linkCleaner($word);
            	if(in_array($word, $arrayName)) {
                	$total +=6;
            	}
        	}
    	}

        $words = explode('-', $clean);
        if(is_array($words)) {
            foreach ($words as $word) {
            	$word = self::linkCleaner($word);
            	if(in_array($word, $arrayName)) {
                	$total +=6;
            	}
            }
        }

        $clean = self::clean($page->getMeta('description'));
        $words = explode(' ', $clean);

        foreach ($words as $word) {
            if(in_array($word, $arrayName)) {
                $total +=5;
            }
        }

        $clean = self::clean($page->getMeta('keywords'));
        $words = explode(' ', $clean);

        foreach ($words as $word) {
            if(in_array($word, $arrayName)) {
                $total +=2;
            }
        }

        foreach ($page->getH1() as $terms) {
            $clean = self::clean($terms);
            $words = explode(' ', $clean);

            foreach ($words as $word) {
                if(in_array($word, $arrayName)) {
                    $total +=5;
                }
            }
        }

        
        foreach ($page->getH2() as $terms) {
            $clean = self::clean($terms);
            $words = explode(' ', $clean);

            foreach ($words as $word) {
                if(in_array($word, $arrayName)) {
                    $total +=4;
                }
            }
        }

        foreach ($page->getH3() as $terms) {
            $clean = self::clean($terms);
            $words = explode(' ', $clean);

            foreach ($words as $word) {
                if(in_array($word, $arrayName)) {
                    $total +=3;
                }
            }
        }

        foreach ($page->getH4() as $terms) {
            $clean = self::clean($terms);
            $words = explode(' ', $clean);

            foreach ($words as $word) {
                if(in_array($word, $arrayName)) {
                    $total +=2;
                }
            }
        }

        foreach ($page->getH5() as $terms) {
            $clean = self::clean($terms);
            $words = explode(' ', $clean);

            foreach ($words as $word) {
                if(in_array($word, $arrayName)) {
                    $total +=1;
                }
            }
        }

        foreach ($page->getBold() as $terms) {
            $clean = self::clean($terms);
            $words = explode(' ', $clean);

            foreach ($words as $word) {
                if(in_array($word, $arrayName)) {
                    $total +=3;
                }
            }
        }

        foreach ($page->getStrong() as $terms) {
            $clean = self::clean($terms);
            $words = explode(' ', $clean);

            foreach ($words as $word) {
                if(in_array($word, $arrayName)) {
                    $total +=3;
                }
            }
        }

        foreach ($page->getLinks() as $link) {
            //$clean = self::clean($terms)
        	//var_dump($word);

            $word = self::hostCleaner($link);

            //var_dump($word);

            $words = explode('/', $word);
            if(is_array($words)) {
            	foreach ($words as $word) {
            		$words = explode('_', $word);
            		if(is_array($words)) {
            			foreach ($words as $word) {
            				if(in_array($word, $arrayName)) {
                				$total +=1;
            				}
            			}
            		} else {
            			if(in_array($word, $arrayName)) {
                			$total +=1;
            			}
            		}

            		$words = explode('-', $word);
            		if(is_array($words)) {
            			foreach ($words as $word) {
            				if(in_array($word, $arrayName)) {
                				$total +=1;
            				}
            			}
            		} else {
            			if(in_array($word, $arrayName)) {
                			$total +=1;
            			}
            		}

            	}
            
            } else {
            	$words = explode('_', $word);
            	if(is_array($words)) {
            		foreach ($words as $word) {
            			if(in_array($word, $arrayName)) {
                			$total +=1;
            			}
            		}
            	} else {
            		if(in_array($word, $arrayName)) {
                		$total +=1;
            		}
            	}

            	$words = explode('-', $word);
            		if(is_array($words)) {
            			foreach ($words as $word) {
            				if(in_array($word, $arrayName)) {
                				$total +=1;
            				}
            			}
            	} else {
            		if(in_array($word, $arrayName)) {
                		$total +=1;
            		}
            	}
            }   
        }

        // Analise de parametros dos links
        foreach ($page->getLinks() as $link) {
            //$clean = self::clean($terms)
        	//var_dump($word);

            $word = self::linkCleaner($link);

            //var_dump($word);

            $words = explode('/', $word);
            if(is_array($words)) {
            	foreach ($words as $word) {
            		$words = explode('_', $word);
            		if(is_array($words)) {
            			foreach ($words as $word) {
            				if(in_array($word, $arrayName)) {
                				$total +=1;
            				}
            			}
            		} else {
            			if(in_array($word, $arrayName)) {
                			$total +=1;
            			}
            		}

            		$words = explode('-', $word);
            		if(is_array($words)) {
            			foreach ($words as $word) {
            				if(in_array($word, $arrayName)) {
                				$total +=1;
            				}
            			}
            		} else {
            			if(in_array($word, $arrayName)) {
                			$total +=1;
            			}
            		}

            	}
            
            } else {
            	$words = explode('_', $word);
            	if(is_array($words)) {
            		foreach ($words as $word) {
            			if(in_array($word, $arrayName)) {
                			$total +=1;
            			}
            		}
            	} else {
            		if(in_array($word, $arrayName)) {
                		$total +=1;
            		}
            	}

            	$words = explode('-', $word);
            		if(is_array($words)) {
            			foreach ($words as $word) {
            				if(in_array($word, $arrayName)) {
                				$total +=1;
            				}
            			}
            	} else {
            		if(in_array($word, $arrayName)) {
                		$total +=1;
            		}
            	}
            }   
        }

        $result = array('total' => $total, 'other' => $other); 

        return $result;

    }

    public function hostCleaner($word)
    {
    	$word = trim($word);
        $word = strtolower($word);
        $word = preg_replace("/^http\:\/\//", '', $word);
        $word = preg_replace("/www\./", '', $word);
        $word = preg_replace("/w{0,3}\d+\./", '', $word);
        $word = preg_replace("/\d+w{0,3}\./", '', $word);
        $word = preg_replace("/^\.\.\//", '', $word);
        $word = preg_replace("/\.htm.*/", '', $word);
        $word = preg_replace("/\.jpg$/", '', $word);
        $word = preg_replace("/\.png$/", '', $word);
        $word = preg_replace("/\.gif$/", '', $word);
        $word = preg_replace("/\.html.*/", '', $word);
        $word = preg_replace("/\.php.*/", '', $word);
        $word = preg_replace("/\.com.*/", '', $word);
        $word = preg_replace("/\.biz.*/", '', $word);
        $word = preg_replace("/\.it.*/", '', $word);
        $word = preg_replace("/\.org.*/", '', $word);
        $word = preg_replace("/\.tv.*/", '', $word);
        $word = preg_replace("/\.net.*/", '', $word);
        $word = preg_replace("/\.info.*/", '', $word);
        $word = preg_replace("/blog\./", '', $word);

        return $word;

    }

    public function linkCleaner($word)
    {
    	$word = trim($word);
        $word = strtolower($word);
        $word = preg_replace("/.*php./", '', $word);
        $word = preg_replace("/.*com./", '', $word);
        $word = preg_replace("/.*aspx./", '', $word);
        $word = preg_replace("/\.htm$/", '', $word);
        $word = preg_replace("/\.html$/", '', $word);
        $word = preg_replace("/id=\d+/", '', $word);

        $word = preg_replace("/Ãª/i", 'e', $word);
        $word = preg_replace("/ç/i", 'c', $word);
        $word = preg_replace("/ã/i", 'a', $word);
        $word = preg_replace("/õ/i", 'o', $word);
        $word = preg_replace("/ó/i", 'o', $word);
        $word = preg_replace("/ô/i", 'o', $word);
        $word = preg_replace("/í/i", 'i', $word);
        $word = preg_replace("/é/i", 'e', $word);
        $word = preg_replace("/ê/i", 'e', $word);
        $word = preg_replace("/ú/i", 'u', $word);
        $word = preg_replace("/Ã§/i", 'c', $word);
        $word = preg_replace("/Ã©/i", 'e', $word);
        $word = preg_replace("/Ã¡/i", 'a', $word);
        $word = preg_replace("/Ã¢/i", 'a', $word);
        $word = preg_replace("/Ã³/i", 'u', $word);

        return $word;

    }

}