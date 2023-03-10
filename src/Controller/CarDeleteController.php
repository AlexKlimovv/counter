<?php

namespace App\Controller;

use App\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class CarDeleteController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/dashboard/car/{car}/delete', name: 'app_car_delete')]
    public function __invoke (Request $request, Car $car): Response
    {
//        $this->denyAccessUnlessGranted();
        $this->entityManager->remove($car);
        $this->entityManager->flush();
        return $this->redirectToRoute("app_car");
    }
}