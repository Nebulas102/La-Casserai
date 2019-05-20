<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\BookingRepository;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(BookingRepository $bookingRepository)
    {
        return $this->render('default/index.html.twig', [
            'bookingbetweens' => $bookingRepository->dateBetween('2019-05-21', '2019-05-30')
        ]);
    }
}
