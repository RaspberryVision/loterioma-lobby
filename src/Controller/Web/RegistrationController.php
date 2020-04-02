<?php

namespace App\Controller\Web;

use App\Model\DTO\Network\NetworkRequest;
use App\NetworkHelper\DataStore\DataStoreHelper;
use App\Security\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="web_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, DataStoreHelper $dataStoreHelper): Response
    {
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

            $response = $dataStoreHelper->storeUser(new NetworkRequest(
                '/members',
                'POST',
                'sadasdas',
                [
                    'email' => $user->getEmail(),
                    'password' => $user->getPassword()
                ]
            ));

            return $this->redirectToRoute('web_register_success');
        }

        return $this->render('web/registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register/success", name="web_register_success")
     */
    public function success(Request $request): Response
    {
        return $this->render('web/registration/success.html.twig', [
        ]);
    }
}
