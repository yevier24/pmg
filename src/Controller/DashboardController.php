<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use App\Repository\TrabajadorRepository;

use App\Entity\Item;
use App\Repository\ItemRepository;

class DashboardController extends AbstractController
{
    /**
     * @Route("/Dashboard", name="app_dashboard")
     */
    public function index(TrabajadorRepository $trabajadorRepository): Response
    {
        $usuario = $this->getUser();       
        //dump($usuario);exit;
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'usuario' => $usuario,
            'trabajadors' => $trabajadorRepository->findAll(),
        ]);
    }
}
