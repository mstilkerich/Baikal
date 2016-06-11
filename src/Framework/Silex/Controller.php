<?php

namespace Baikal\Framework\Silex;

use Silex\Application;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig_Environment;

/**
 * Base class for controllers to provide some often used methods
 *
 * @package Baikal\Framework\Silex
 */
abstract class Controller
{
    /**
     * @var Twig_Environment $twig
     */
    private $twig;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @param Twig_Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    function __construct(Twig_Environment $twig, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param string $name
     * @param array $context
     * @return string
     */
    function render($name, $context = [])
    {
        return new Response($this->twig->render($name, $context));
    }

    /**
     * @param string $namedRoute
     * @param array $parameters
     * @return Response
     */
    function redirect($namedRoute, $parameters = [])
    {
        $url = $this->urlGenerator->generate($namedRoute, $parameters);

        return new RedirectResponse($url);
    }
}