<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $navigation = array(
            "Accueil",
            "Présentation",
            "Pauline & Margaux",
            "Préparation",
            "Témoignages"
        );
        return $this->render(
            'FrontBundle:Default:index.html.twig',
            array(
                "navigation" => $navigation
            )
        );
    }
}
