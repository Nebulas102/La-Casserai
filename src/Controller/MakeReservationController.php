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

    /**
     * @Route("result/checkindate={checkindate}&checkoutdate={checkoutdate}", name="result_room")
     */
    public function roomSearch(RoomRepository $roomRepository, Request $request, $checkoutDate, $checkinDate)
    { 
        return $this->render('make_reservation/result.html.twig' ,[
            'rooms' => $roomRepository->roomOccupied($checkinDate, $checkoutDate),
            'checkindate' => $checkinDate,
            'checkoutdate' => $checkoutDate,
        ]);
    }

    /**
     * @Route("/result/checkindate={checkindate}&checkoutdate={checkoutdate}/view/{id}", name="view")
     */
    public function overview($checkinDate, $checkoutDate, RoomRepository $roomRepository, Request $request, $id)  : Response{
        $dateCheckin = date_create($checkinDate);
        $dateCheckout = date_create($checkoutDate);

        $total_days = date_diff($dateCheckin, $dateCheckout)->format("%d");
        $total_price = $roomRepository->createQueryBuilder('u')->select('u.price')->where('id', $id);
        return $this->render('default/overview.html.twig', [
            'rooms' => $roomRepository->findBy(['id' => $id]),
            'total_days' => $total_days,
            'checkindate' => $dateCheckin,
            'checkoutdate' => $dateCheckout,
            'total_price' => $total_price
        ]);

    }

        /**
     * @Route("/result/checkindate={checkindate}&checkoutdate={checkoutdate}/view/{id}/book", name="final")
     */
    public function book($checkinDate, $checkoutDate, RoomRepository $roomRepository, Request $request, $id)  : Response
    {
        {
                $user = $this->container->get('security.context')->getToken()->getUser();
                $format = 'd-m-Y';
                $room = $this->getDoctrine()->getRepository(Room::class)->find($id);
                $user = $this->container->get('security.context')->getToken()->getUser();

                $reservation = new Reservation();
                $reservation->setCheckinDate(DateTime::createFromFormat($format, $checkinDate));
                $reservation->setCheckoutDate(DateTime::createFromFormat($format, $checkoutDate));
                $reservation->setRoom($room);
                $reservation->setUser($user);
                $reservation->setPrice(2);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($reservation);
                $entityManager->flush();


            return $this->render('make_reservation/final.html.twig', [
                           ]);
        }
    }
}
