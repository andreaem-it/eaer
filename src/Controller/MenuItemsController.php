<?php

namespace App\Controller;

use App\Entity\MenuItems;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MenuItemsController extends AbstractController {

    /**
     * @Route("blocks/menu/", name="block_menu")
     */
    public function blockMenu() {
        return $this->render('FrontEnd/Template/menu.html.twig', [
            'items' => $this->getDoctrine()->getRepository(MenuItems::class)->findBy(['active' => true],['position' => 'ASC'])
        ]);
    }
    public function listAction() {
        return $this->blockMenu();

    }

}