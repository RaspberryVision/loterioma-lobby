<?php

namespace App\Controller\Web;

use App\Entity\User;
use App\Message\UserRegistration;
use App\Model\DTO\Network\NetworkRequest;
use App\Model\DTO\User\UserDTO;
use App\NetworkHelper\DataStore\DataStoreHelper;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="web_register")
     */
    public function register(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder
    ): Response {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

//            $this->dispatchMessage(
//                new UserRegistration(json_encode((new UserDTO($user->getEmail(), $user->getPassword()))->dto()))
//            );

            return $this->redirectToRoute('web_register_success');
        }

        return $this->render(
            'registration/register.html.twig',
            [
                'registrationForm' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/register/success", name="web_register_success")
     */
    public function success(Request $request): Response
    {
        return $this->render(
            'registration/success.html.twig',
            [
            ]
        );
    }
}
