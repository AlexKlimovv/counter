<?php

namespace App\Controller;

use App\Dto\CarDto;
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
            /** @var CarDto $carDto */
            $carDto = $form->getData();
            $car = new Car();
            $car
                ->setUser($user)
                ->setCarBrand($carDto->carBrand)
                ->setCarModel($carDto->carModel)
                ->setRegNumber($carDto->regNumber)
                ->setVin($carDto->vin)
                ->setProdYear($carDto->prodYear)
                ->setTypeOfFuel($carDto->typeOfFuel)
                ->setCapacity($carDto->capacity)
            ;

            $this->entityManager->persist($car);
            $this->entityManager->flush();

            return $this->redirectToRoute("app_car");
        }
        return $this->render("car/create.html.twig", [
            "form" => $form->createView()
        ]);
    }


}