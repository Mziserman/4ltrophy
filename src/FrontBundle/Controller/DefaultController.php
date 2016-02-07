<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $navigation = array(
            array(
                "name" => "Accueil",
                "slug" => "front_homepage"
            ),
            array(
                "name" => "Présentation",
                "slug" => "front_presentation"
            ),
            array(
                "name" => "Pauline & Margaux",
                "slug" => "front_trip"
            ),
            array(
                "name" => "Préparation",
                "slug" => "front_preparation"
            ),
            array(
                "name" => "Témoignages",
                "slug" => "front_testimony"
            )
        );
        $current = "Accueil";
        return $this->render(
            'FrontBundle:Default:index.html.twig',
            array(
                "navigation" => $navigation,
                "current" => $current
            )
        );
    }

    public function testimonyAction() {
        $navigation = array(
            array(
                "name" => "Accueil",
                "slug" => "front_homepage"
            ),
            array(
                "name" => "Présentation",
                "slug" => "front_presentation"
            ),
            array(
                "name" => "Pauline & Margaux",
                "slug" => "front_trip"
            ),
            array(
                "name" => "Préparation",
                "slug" => "front_preparation"
            ),
            array(
                "name" => "Témoignages",
                "slug" => "front_testimony"
            )
        );
        $current = "Témoignages";
        return $this->render(
            'FrontBundle:Default:testimony.html.twig',
            array(
                "navigation" => $navigation,
                "current" => $current
            )
        );
    }

    public function presentationAction() {
        $navigation = array(
            array(
                "name" => "Accueil",
                "slug" => "front_homepage"
            ),
            array(
                "name" => "Présentation",
                "slug" => "front_presentation"
            ),
            array(
                "name" => "Pauline & Margaux",
                "slug" => "front_trip"
            ),
            array(
                "name" => "Préparation",
                "slug" => "front_preparation"
            ),
            array(
                "name" => "Témoignages",
                "slug" => "front_testimony"
            )
        );
        $current = "Présentation";
        return $this->render(
            'FrontBundle:Default:presentation.html.twig',
            array(
                "navigation" => $navigation,
                "current" => $current
            )
        );
    }

    public function tripAction() {
        $navigation = array(
            array(
                "name" => "Accueil",
                "slug" => "front_homepage"
            ),
            array(
                "name" => "Présentation",
                "slug" => "front_presentation"
            ),
            array(
                "name" => "Pauline & Margaux",
                "slug" => "front_trip"
            ),
            array(
                "name" => "Préparation",
                "slug" => "front_preparation"
            ),
            array(
                "name" => "Témoignages",
                "slug" => "front_testimony"
            )
        );
        $current = "Pauline & Margaux";
        return $this->render(
            'FrontBundle:Default:trip.html.twig',
            array(
                "navigation" => $navigation,
                "current" => $current
            )
        );
    }

    public function preparationAction() {
        $navigation = array(
            array(
                "name" => "Accueil",
                "slug" => "front_homepage"
            ),
            array(
                "name" => "Présentation",
                "slug" => "front_presentation"
            ),
            array(
                "name" => "Pauline & Margaux",
                "slug" => "front_trip"
            ),
            array(
                "name" => "Préparation",
                "slug" => "front_preparation"
            ),
            array(
                "name" => "Témoignages",
                "slug" => "front_testimony"
            )
        );
        $current = "Préparation";
        return $this->render(
            'FrontBundle:Default:preparation.html.twig',
            array(
                "navigation" => $navigation,
                "current" => $current
            )
        );
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
