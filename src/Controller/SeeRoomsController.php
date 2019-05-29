<?php

namespace App\Controller;

use App\Entity\Room;
use App\Entity\Extra;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SeeRoomsController extends AbstractController
{
    /**
     * @Route("/seerooms", name="see_rooms")
     */
    public function index()
    {
        $extras = $this->getDoctrine()->getRepository(Extra::class)->findall();
        $rooms = $this->getDoctrine()->getRepository(Room::class)->findall();
        return $this->render('see_rooms/index.html.twig', [
            'controller_name' => 'SeeRoomsController',
            'rooms' => $rooms,
            'extras' => $extras
        ]);
    }
}
