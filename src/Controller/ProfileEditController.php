<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileEditController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/dashboard/profile/edit', name: 'app_profile_edit')]
    public function __invoke(Request $request): Response
    {
        /** @var User $user */
        $user = $this->getUser(); // получить текущего юзера
        $form = $this->createForm(EditProfileType::class, $user); // инициализация формы
        $form->handleRequest($request); // обработка реквеста после отправки формы
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush(); //Сохранение в БД
            return $this->redirectToRoute('app_profile');
        }
        return $this->render("profile_edit.html.twig", [
            "form" => $form->createView()
        ]);
    }
}