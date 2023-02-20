<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CreateCarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarEditController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/dashboard/car/{car}/edit', name: 'app_car_edit')]
    public function __invoke(Request $request, Car $car): Response
    {
        $form = $this->createForm(CreateCarType::class, $car);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute("app_car");
        }
        return $this->render("car/create.html.twig", [
            "form" => $form->createView()
        ]);
    }
}