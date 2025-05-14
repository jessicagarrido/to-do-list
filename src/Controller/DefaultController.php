<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage', methods: ['GET'])]
    
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }
}
