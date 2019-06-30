<?php

namespace App\Controller;

use App\Repository\ReservationRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class StaffController extends AbstractController
{
    /**
     * @Route("/staff", name="staff")
     */
    public function index(ReservationRepository $reservationRepository)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $time = new DateTime();
        $week = new DateTIme();
        $week->modify('+7 day');

        return $this->render('staff/index.html.twig', [
            'reservations_today' => $reservationRepository->stats_today(date_format($time, 'Y-m-d 00:00:00'), date_format($time, 'Y-m-d 23:59:59')),
            'reservations_week' => $reservationRepository->stats_week(date_format($time, 'Y-m-d 00:00:00'), date_format($week, 'Y-m-d 23:59:59')),
        ]);
    }

}
