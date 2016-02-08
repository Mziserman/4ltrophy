<?php

namespace FrontBundle\Controller;

/**
 * Class DefaultController
 * @package FrontBundle\Controller
 */
class DefaultController extends AbstractFrontController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('FrontBundle:Default:index.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testimonyAction() {
        return $this->render('FrontBundle:Default:testimony.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function presentationAction() {
        return $this->render('FrontBundle:Default:presentation.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function preparationAction() {
        return $this->render('FrontBundle:Default:preparation.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tripAction()
    {
        $facebookCatcher = $this->container->get('utils.facebook.feed_catcher');

        $timelineObject = $facebookCatcher->getFeed();

        return $this->render('FrontBundle:Default:trip.html.twig', [
            'timelineObject' => $timelineObject,
        ]);
    }
}
