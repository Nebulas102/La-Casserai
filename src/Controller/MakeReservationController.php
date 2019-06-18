<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\RoomRepository;
use App\Form\MakeReservationType;

class MakeReservationController extends AbstractController
{
    /**
     * @Route("/makereservation", name="make_reservation")
     */
    public function index(RoomRepository $roomRepository, Request $request)
    {
        $form = $this->createForm(MakeReservationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $checkinDate = $form->getData()->GetCheckinDate();
            $checkoutDate = $form->getData()->GetCheckoutDate();

            return $this->render('make_reservation/result.html.twig', [
                'rooms' => $roomRepository->roomOccupied($checkinDate, $checkoutDate),
            ]);
        }

        return $this->render('make_reservation/index.html.twig', [
            'form' => $form->createview(),
        ]);
    }
}
