<?php

namespace App\Search;

use Doctrine\ORM\Mapping as ORM;

class SearchArticle
{

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
     public $mots ='';

     /**
     * @var Categories[]
     */
     public $Category =[];

    /**
     * @var boolean
     */
        public  $promo =false;

}