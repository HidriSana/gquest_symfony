<?php

namespace App\Controller;

use App\Entity\Guild;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'app_registration')]
    public function index(UserPasswordHasherInterface $passwordHasher): Response
    {
        
        return $this->render('registration/index.html.twig', [
            'registration' => 'RegistrationController',
        ]);
    }

    public function createUser(Request $request, User $newUser, Guild $guild, String $message) :Response {
        
        //--> Need to figure out how to fetch POST data
        $newUser -> setFirstname("Placeholder: POST['firstname']");
        $newUser -> setLastname("Placeholder: POST['lastname']");
        $newUser -> setEmail("Placeholder: POST['email']");
        $newUser -> setPassword("Placeholder: POST['password']");
        //----> Needs password confirmation here, I'll figure it out later
        if ('Check: No guild') {
            $guild -> setGuildName("Placeholder: POST['guildname']");
            $newUser -> setGuild($guild);
            $newUser -> setRoles(['ROLES_ADMIN']);
        }
        else {
            $guild -> getGuildName("Placeholder: POST['guildname']");
            //--> sends an application to the guild's admin and waits for an approval 
            $newUser -> setRoles(['ROLES_USER']);
            //-->Needs an application status: "Waiting for approval"
            if ("Approval = 'Approved'") {
                $newUser -> setGuild($guild);
            }
            else {
                $newUser -> setGuild(null);
                $message = "Application to guildname denied!";
                return $message;
            }
        } 
        
        $form = $this->createForm(User::class, $newUser);
        return $this->render('task/new.html.twig', [
            'form' => $form,
        ]);
    }
}