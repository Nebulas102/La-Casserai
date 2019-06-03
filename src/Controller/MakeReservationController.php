<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Reservation;

class MakeReservationController extends AbstractController
{
    /**
     * @Route("/makereservation", name="make_reservation")
     */
    public function index()
    {
        $reservations = $this->getDoctrine()->getRepository(Reservation::class)->occupiedFinder( '2019-05-05', '2019-05-09');
        $allReservations = $this->getDoctrine()->getRepository(Reservation::class)->findall();
        return $this->render('make_reservation/index.html.twig', [
                'reservations' => $reservations,
                'allReservations' => $allReservations,
        ]);
    }
}
