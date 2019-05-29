<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MakeReservationController extends AbstractController
{
    /**
     * @Route("/makereservation", name="make_reservation")
     */
    public function index()
    {
        return $this->render('make_reservation/index.html.twig', [
            'controller_name' => 'MakeReservationController',
        ]);
    }
}
