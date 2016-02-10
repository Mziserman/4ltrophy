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
    public function enfantsdudesertAction() {
        return $this->render('FrontBundle:Default:enfantsdudesert.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tripAction()
    {
        $facebookCatcher = $this->container->get('utils.facebook.feed_catcher');

        $timelineObject = $facebookCatcher->getFeed();

        $startingDate = new \DateTime($this->getParameter('starting_date'));
        $endingDate = new \DateTime($this->getParameter('ending_date'));

        $progressBar = $this->prepareProgressBarInformations($startingDate, $endingDate);

        return $this->render('FrontBundle:Default:trip.html.twig', [
            'timelineObject' => $timelineObject,
            'endingDate' => $endingDate,
            'startingDate' => $startingDate,
            'progressBar' => $progressBar,
        ]);
    }

    private function prepareProgressBarInformations(\Datetime $startingDate, \Datetime $endingDate)
    {
        $progressBar = [];

        $now = new \DateTime();

        // Between the beginning and the end of the event
        $totalIterval = $startingDate->diff($endingDate);
        // Between the beginning and now
        $alreadyDone = $startingDate->diff($now);

        $progressBar['total_interval'] = ($totalIterval->invert ? -1 * ($totalIterval->format('%a')) : $totalIterval->format('%a'));
        $progressBar['already_done'] = ($alreadyDone->invert ? -1 * ($alreadyDone->format('%a')) : $alreadyDone->format('%a'));
        $progressBar['current_interval'] = $progressBar['total_interval'] - $progressBar['already_done'];

        return $progressBar;
    }
}
