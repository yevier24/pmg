<?php

namespace App\Controller;

use App\Entity\Tienda;
use App\Form\TiendaType;
use App\Repository\TiendaRepository;

use App\Entity\Empresa;
use App\Repository\EmpresaRepository;
use App\Repository\ZonaRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TiendaController extends AbstractController
{
    /**
     * @Route("/Tienda", name="tienda_index", methods={"GET"})
     */
    public function index(TiendaRepository $tiendaRepository): Response
    {
        $usuario = $this->getUser();
        return $this->render('tienda/index.html.twig', [
            'tiendas' => $tiendaRepository->findAll(),
            'usuario' => $usuario
        ]);
    }

    /**
     * @Route("/NewTienda", name="tienda_new", methods={"GET","POST"})
     */
    public function new(Request $request, EmpresaRepository $EmpresaRepository, ZonaRepository $ZonaRepository): Response
    {
        $usuario = $this->getUser();
        $tienda = new Tienda();
        $form = $this->createForm(TiendaType::class, $tienda);
        $form->handleRequest($request);
        $data = $request->request->get('tienda');
        //dump($data['zona']);exit;
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $EmpresaId = $EmpresaRepository->findOneBy(array('id' => $data['empresa']));
            $ZonaId = $ZonaRepository->findOneBy(array('id' => $data['zona']));
            //dump($ZonaId);exit;
            $tienda->setEmpresa($EmpresaId);
            $tienda->setZona($ZonaId);
            $entityManager->persist($tienda);
            $entityManager->flush();

            return $this->redirectToRoute('tienda_index');
        }

        return $this->render('tienda/new.html.twig', [
            'tienda' => $tienda,
            'form' => $form->createView(),
            'usuario' => $usuario
        ]);
    }

    /**
     * @Route("/{id}/ShowTienda", name="tienda_show", methods={"GET"})
     */
    public function show(Tienda $tienda): Response
    {
        $usuario = $this->getUser();
        return $this->render('tienda/show.html.twig', [
            'tienda' => $tienda,
            'usuario' => $usuario
        ]);
    }

    /**
     * @Route("/{id}/EditTienda", name="tienda_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tienda $tienda): Response
    {
        $usuario = $this->getUser();
        $form = $this->createForm(TiendaType::class, $tienda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tienda_index');
        }

        return $this->render('tienda/edit.html.twig', [
            'tienda' => $tienda,
            'form' => $form->createView(),
            'usuario' => $usuario
        ]);
    }

    /**
     * @Route("/{id}/DeleteTienda", name="tienda_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Tienda $tienda): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tienda->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tienda);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tienda_index');
    }
}
