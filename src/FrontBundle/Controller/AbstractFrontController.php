<?php
namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AbstractFrontController
 * @package FrontBundle\Controller
 */
abstract class AbstractFrontController extends Controller
{
    /**
     * @var array
     */
    private $navigation;

    /**
     * AbstractFrontController constructor.
     */
    public function __construct()
    {
        $this->navigation = [
            "Accueil" => 'front_homepage',
            "Le 4l trophy" => 'front_presentation',
            "Enfants du desert" => 'front_enfantsdudesert',
            "Pauline & Margaux" => 'front_trip',
            "Préparation" => 'front_preparation',
            "Témoignages" => 'front_testimony',
        ];
    }

    /**
     * Doest the exact same thing than the default render method, but add the navigation informations in arguments
     *
     * @param string   $view       The view name
     * @param array    $parameters An array of parameters to pass to the view
     * @param Response $response   A response instance
     *
     * @return Response A Response instance
     */
    public function render($view, array $parameters = [], Response $response = null)
    {
        $parameters['navigation'] = $this->navigation;

        return parent::render($view, $parameters, $response);
    }
}
