<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Reservation;

class BookingController extends AbstractController
{
    /**
     * @Route("/booking", name="booking")
     */
    public function index()
    {
        $user = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(Reservation::class);
        $reservations = $repository->findBy(['user' => $user->GetId()]);

        return $this->render('booking/index.html.twig', [
            'user' => $user,
            'reservations' => $reservations,
        ]);
    }
}
