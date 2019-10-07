<?php

namespace App\Controller;

use App\Entity\Zona;
use App\Form\ZonaType;
use App\Repository\ZonaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/zona")
 */
class ZonaController extends AbstractController
{
    /**
     * @Route("/", name="zona_index", methods={"GET"})
     */
    public function index(ZonaRepository $zonaRepository): Response
    {
        $usuario = $this->getUser();
        return $this->render('zona/index.html.twig', [
            'zonas' => $zonaRepository->findAll(),
            'usuario' => $usuario
        ]);
    }

    /**
     * @Route("/new", name="zona_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $usuario = $this->getUser();
        $zona = new Zona();
        $form = $this->createForm(ZonaType::class, $zona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($zona);
            $entityManager->flush();

            return $this->redirectToRoute('zona_index');
        }

        return $this->render('zona/new.html.twig', [
            'zona' => $zona,
            'form' => $form->createView(),
            'usuario' => $usuario
        ]);
    }

    /**
     * @Route("/{id}", name="zona_show", methods={"GET"})
     */
    public function show(Zona $zona): Response
    {
        $usuario = $this->getUser();
        return $this->render('zona/show.html.twig', [
            'zona' => $zona,
            'usuario' => $usuario
        ]);
    }

    /**
     * @Route("/{id}/edit", name="zona_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Zona $zona): Response
    {
        $usuario = $this->getUser();
        $form = $this->createForm(ZonaType::class, $zona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('zona_index');
        }

        return $this->render('zona/edit.html.twig', [
            'zona' => $zona,
            'form' => $form->createView(),
            'usuario' => $usuario
        ]);
    }

    /**
     * @Route("/{id}", name="zona_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Zona $zona): Response
    {
        if ($this->isCsrfTokenValid('delete'.$zona->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($zona);
            $entityManager->flush();
        }

        return $this->redirectToRoute('zona_index');
    }
}
