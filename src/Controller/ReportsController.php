<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ReportsController extends AbstractController
{
    /**
     * @Route("/reports", name="reports")
     */
    public function index()
    {
        return $this->render('FrontEnd/comingsoon.html.twig', [
            'controller_name' => 'ReportsController',
        ]);
    }
}
