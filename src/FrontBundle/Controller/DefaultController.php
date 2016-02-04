<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontBundle:Default:index.html.twig');
    }

    public function testApiAction()
    {
        $facebookCatcher = $this->container->get('utils.facebook.feed_catcher');

        $graphEdge = $facebookCatcher->getFeed();

        return $this->render('FrontBundle:Default:test.html.twig', [
            'graphEdge' => $graphEdge,
        ]);
    }
}
