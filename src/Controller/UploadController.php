<?php

namespace App\Controller;

use App\Entity\Item;
use App\Form\ItemType;
use App\Repository\ItemRepository;
use Symfony\Component\HttpFoundation\File\MimeType\ExtensionGuesser;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service\FileUploader;
use Psr\Log\LoggerInterface;

class UploadController extends AbstractController
{
    /**
     * @Route("/doUpload", name="upload")
     */
     public function index(Request $request, string $uploadDir, FileUploader $uploader, LoggerInterface $logger, ItemRepository $itemRepository)
    {
        ///// upload
        $token = $request->get("token");

        if (!$this->isCsrfTokenValid('upload', $token)) 
        {
            $logger->info("CSRF failure");

            return new Response("Operation not allowed",  Response::HTTP_BAD_REQUEST,
                ['content-type' => 'text/plain']);
        }        

        $file = $request->files->get('myfile');
        $nombre = $request->get('correo');
        //dump($nombre);exit;
        if (empty($file)) 
        {
            return new Response("No file specified",  
            Response::HTTP_UNPROCESSABLE_ENTITY, ['content-type' => 'text/plain']);
        }        

        //$filename = $file->getClientOriginalName();
        $Ext = $file->guessExtension();
        $filename = $nombre.".".$Ext;

        //$usuario = $this->getUser()->getId();
        ///insert Item
        $item = new Item();
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
        $item->setImage($filename);
        //$item->setUser($usuario);
        $entityManager->persist($item);
        $entityManager->flush();
        ///insert Item

        $ItemId = $itemRepository->findOneBy(array('image' => $filename));
        //dump($ItemId->getId());exit;        
        

        $uploader->upload($uploadDir, $file, $filename);
        return new Response($ItemId->getId(),  Response::HTTP_OK, ['content-type' => 'text/plain']); 
        //return new Response(Response::HTTP_OK);
        //return $this->redirectToRoute($request->getUri()); 
        //return new Response("File uploaded",  Response::HTTP_OK, ['content-type' => 'text/plain']); 
        //return $this->redirectToRoute('item_index');       
        ///// upload

        /*$email = (new Email())
            ->from('javieriuta@gmail.com')
            ->to('javieriuta@gmail.com')
            ->cc('javieriuta@gmail.com')
            ->bcc('javieriuta@gmail.com')
            ->replyTo('javieriuta@gmail.com')
            ->priority(Email::PRIORITY_HIGH)
            ->subject('Important Notification')
            ->text('Lorem ipsum...')
            ->html('<h1>Lorem ipsum</h1> <p>...</p>')
        ;*/

    }
}
