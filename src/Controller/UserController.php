<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserController extends AbstractController
{
    /**
     * @Route("/User", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        $usuario = $this->getUser();
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
            'usuario' => $usuario
        ]);
    }

    /**
     * @Route("/NewUser", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $usuario = $this->getUser();
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'usuario' => $usuario
        ]);
    }

    /**
     * @Route("/ShowUser/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        $usuario = $this->getUser();
        return $this->render('user/show.html.twig', [
            'user' => $user,
            'usuario' => $usuario
        ]);
    }

    /**
     * @Route("/EditUser/{id}", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $usuario = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $userInfo = $form->getData();
            $id = $userInfo->getId();
            $email = $userInfo->getEmail();
            $name = $userInfo->getName();
            $plainPassword = $userInfo->getPassword();
            $user = $em->getRepository(User::class)->findOneBy(['id' => $id]);
            if ($user === null) {
                $this->addFlash('danger', 'Invalid email');
                return $this->redirectToRoute('user_index');
            } else {
                $this->addFlash('success', 'Article Created! Knowledge is power!');
            }
            //dump($user);exit;
            //$password = $encoder->encodePassword($user, $plainPassword);
            $user->setEmail($email);
            $user->setPassword($plainPassword);
            $user->setName($name);
            //$em = $this->getDoctrine()->getManager();
            $em->persist($user);
            //$em->flush();
            $em->flush();

            //$this->getDoctrine()->getManager()->flush();
            //return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'usuario' => $usuario
        ]);
    }
    

    /**
     * @Route("/DeleteUser/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
