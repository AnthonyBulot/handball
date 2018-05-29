<?php

namespace HB\HandballBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HBHandballBundle:Default:index.html.twig');
    }
}
