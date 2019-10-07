<?php

namespace App\Controller;

use App\Entity\Trabajador;
use App\Form\TrabajadorType;
use App\Form\TrabajadorEditType;
use App\Repository\TrabajadorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ItemRepository;

class TrabajadorController extends AbstractController
{
    /**
     * @Route("/Trabajador", name="trabajador_index", methods={"GET"})
     */
    public function index(TrabajadorRepository $trabajadorRepository): Response
    {
        $usuario = $this->getUser();
        return $this->render('trabajador/index.html.twig', [
            'trabajadors' => $trabajadorRepository->findAll(),
            'usuario' => $usuario
        ]);
    }
 
    /**
     * @Route("/NewTrabajador", name="trabajador_new", methods={"GET","POST"})
     */
    public function new(Request $request, ItemRepository $itemRepository): Response
    {
        $usuario = $this->getUser();
        $trabajador = new Trabajador();
        $form = $this->createForm(TrabajadorType::class, $trabajador);
        $form->handleRequest($request);
        $data = $request->request->get('trabajador');
        //dump($data['foto']);exit;
        if ($form->isSubmitted() && $form->isValid()) {
            $ItemId = $itemRepository->findOneBy(array('id' => $data['foto']));
            $entityManager = $this->getDoctrine()->getManager();
            $trabajador->setFoto($ItemId);
            $entityManager->persist($trabajador);
            $entityManager->flush();

            //return $this->redirectToRoute('trabajador_index');
        }

        return $this->render('trabajador/new.html.twig', [
            'trabajador' => $trabajador,
            'form' => $form->createView(),
            'usuario' => $usuario
        ]);
    }

    /**
     * @Route("/{id}/ShowTrabajador", name="trabajador_show", methods={"GET"})
     */
    public function show(Trabajador $trabajador): Response
    {
        $usuario = $this->getUser();
        return $this->render('trabajador/show.html.twig', [
            'trabajador' => $trabajador,
            'usuario' => $usuario
        ]);
    }

    /**
     * @Route("/{id}/EditTrabajador", name="trabajador_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Trabajador $trabajador): Response
    {
        $usuario = $this->getUser();
        $form = $this->createForm(TrabajadorEditType::class, $trabajador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('trabajador_index');
        }

        return $this->render('trabajador/edit.html.twig', [
            'trabajador' => $trabajador,
            'form' => $form->createView(),
            'usuario' => $usuario
        ]);
    }

    /**
     * @Route("/{id}/DeleteTrabajador", name="trabajador_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Trabajador $trabajador): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trabajador->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($trabajador);
            $entityManager->flush();
        }

        return $this->redirectToRoute('trabajador_index');
    }
}
