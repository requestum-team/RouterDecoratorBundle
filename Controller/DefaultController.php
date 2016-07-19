<?php

namespace Requestum\RouterDecorationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RequestumRouterDecorationBundle:Default:index.html.twig');
    }
}
