<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\User;
use App\Form\EditCarType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    #[Route('/dashboard/car', name: 'app_car')]
    public function index(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        return $this->render('car/car.html.twig', [
            'cars' => $user->getCars(),
        ]);
    }

}