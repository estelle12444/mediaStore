<?php

namespace App\Services\Cart;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\session;

class CartService{

    protected $session;

    public function __construct(SessionInterface $session){
        $this->session =$session;
    }


    public function add(int $id){
        $panier = $this->session->get('panier',[]);

        if(!empty($panier[$id])){
            $panier[$id]++;
        }
        else{
            $panier[$id]=1;
        }

        $this->session->set('panier', $panier);
    
    }
    
    public function remove(int $id){
        $panier = $this->session->get('panier',[]);

        if(!empty($panier[$id])){
            unset($panier[$id]);
        }
        $this->session->set('panier', $panier);
        
    }
//public function getFullCart(): array {}
    //public function getTotal(): float {}
}