<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\User;
use App\Form\CreateCarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarCreateController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/dashboard/car/create', name: 'app_car_create')]
    public function __invoke(Request $request): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $form = $this->createForm(CreateCarType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Car $car */
            $car = $form->getData();
            $car->setUser($user);
            $this->entityManager->persist($car);
            $this->entityManager->flush();

            return $this->redirectToRoute("app_car");
        }
        return $this->render("car/create.html.twig", [
            "form" => $form->createView()
        ]);
    }


}