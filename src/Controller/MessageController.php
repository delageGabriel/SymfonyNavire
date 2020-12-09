<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\GestionContact;
use App\Entity\Message;
use App\Form\MessageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
/**
 * @Route("/message", name="messagee_")
 */
class MessageController extends AbstractController {

    /**
     * @Route("/message", name="message")
     */
    public function index(): Response {
        return $this->render('message/index.html.twig', [
                    'controller_name' => 'MessageController',
        ]);
    }

    /**
     * @Route("/contact",name="contact")
     * @Template("message/contact.html.twig")
     * @return type
     */
    public function contact(Request $request){
        $message= new Message();
        $form=$this->createForm(MessageType::class,$message);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $message=$form->getData();          
            GestionContact::envoiMailContact($message);          
        }
       
        return array('form'=>$form->createView());
    }

}
