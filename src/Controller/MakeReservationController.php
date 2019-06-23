<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReservationRepository;
use App\Repository\RoomRepository;
use App\Entity\Reservation;
use App\Entity\Room;
use App\Form\MakeReservationType;
use App\Form\BookType;

class MakeReservationController extends AbstractController
{
    /**
     * @Route("/makereservation", name="make_reservation")
     */
    public function index(RoomRepository $roomRepository, Request $request) : Response
    {
        $form = $this->createForm(MakeReservationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $checkinDate = date_format($form->getData()->GetCheckinDate(), 'Y-m-d');
            $checkoutDate = date_format($form->getData()->GetCheckoutDate(), 'Y-m-d');

            return $this->redirectToRoute('result_room', ['checkindate' => $checkinDate, 'checkoutdate' => $checkoutDate]);
        }

        return $this->render('make_reservation/index.html.twig', [
            'form' => $form->createview(),
        ]);
    }

    /**
     * @Route("/result/checkindate={checkindate}&checkoutdate={checkoutdate}", name="result_room")
     */
    public function roomSearch(RoomRepository $roomRepository, Request $request, $checkindate, $checkoutdate) : Response
    { 
        return $this->render('make_reservation/result.html.twig' ,[
            'rooms' => $roomRepository->roomOccupied($checkindate, $checkoutdate),
            'checkindate' => $checkindate,
            'checkoutdate' => $checkoutdate,
        ]);
    }

    /**
     * @Route("/result/checkindate={checkindate}&checkoutdate={checkoutdate}/view/{id}", name="view")
     */
    public function overview($checkindate, $checkoutdate, RoomRepository $roomRepository, Request $request, $id) : Response
    {

        return $this->render('make_reservation/reservation_overview.html.twig', [
            'rooms' => $roomRepository->findBy(['id' => $id]),
            'total_days' => date_diff(date_create($checkindate), date_create($checkoutdate))->format("%d"),
            'checkindate' => $checkindate,
            'checkoutdate' => $checkoutdate,
        ]);

    }

        /**
     * @Route("/result/checkindate={checkindate}&checkoutdate={checkoutdate}/view/{id}/book/price={total_price}", name="final")
     */
    public function book($checkindate, $checkoutdate, $total_price, $id) : Response
    {
        {
                $format = 'Y-m-d';
                $room = $this->getDoctrine()->getRepository(Room::class)->find($id);
                $user = $this->get('security.token_storage')->getToken()->getUser();


                $reservation = new Reservation();
                $reservation->setCheckinDate(DateTime::createFromFormat($format, $checkindate));
                $reservation->setCheckoutDate(DateTime::createFromFormat($format, $checkoutdate));
                $reservation->setRoom($room);
                $reservation->setUser($user);
                $reservation->setPrice($total_price);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($reservation);
                $entityManager->flush();


            return $this->render('make_reservation/final.html.twig', [
                           ]);
        }
    }
}
