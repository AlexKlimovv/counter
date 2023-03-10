<?php

namespace App\Controller;

use App\Dto\CarDto;
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
        $form = $this->createForm(CreateCarType::class, $this->mapEntityToDto($car));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CarDto $carDto */
            $carDto = $form->getData();
            $car
                ->setCarBrand($carDto->carBrand)
                ->setCarModel($carDto->carModel)
                ->setRegNumber($carDto->regNumber)
                ->setVin($carDto->vin)
                ->setProdYear($carDto->prodYear)
                ->setTypeOfFuel($carDto->typeOfFuel)
                ->setCapacity($carDto->capacity)
            ;
            $this->entityManager->flush();

            return $this->redirectToRoute("app_car");
        }
        return $this->render("car/create.html.twig", [
            "form" => $form->createView()
        ]);
    }

    private function mapEntityToDto(Car $car): CarDto
    {
        $carDto = new CarDto();
        $carDto->carBrand = $car->getCarBrand();
        $carDto->carModel = $car->getCarModel();
        $carDto->regNumber = $car->getRegNumber();
        $carDto->prodYear = $car->getProdYear();
        $carDto->capacity = $car->getCapacity();
        $carDto->vin = $car->getVin();
        $carDto->typeOfFuel = $car->getTypeOfFuel();
        return $carDto;
    }
}