<?php

namespace App\Controller;

use App\Entity\Partners;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PartnersController extends AbstractController
{
    /**
     * @Route("/partners/{partner}", name="partners")
     */
    public function index($partner)
    {
        return $this->render('FrontEnd/Partners/page.html.twig', [
            'partner' => $this->getDoctrine()->getRepository(Partners::class)->findBy(['name' => $partner])
        ]);
    }
}
