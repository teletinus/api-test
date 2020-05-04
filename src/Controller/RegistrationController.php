<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user->setPassword(
                    $passwordEncoder->encodePassword($user, $user->getPassword())
                    );
            $em = $this->getDoctrine()->getManager();
//            print_r($user);die();
            $em->persist($user);
            $em->flush();
            
            $this->addFlash('register_success', 'User added successfully!');
            
            return $this->redirect($this->generateUrl('app_login'));
        }
        
        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
            'page_name'=>'Registration'
        ]);
    }
}
