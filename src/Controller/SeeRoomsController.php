<?php

namespace App\Controller;

use App\Entity\Room;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SeeRoomsController extends AbstractController
{
    /**
     * @Route("/seerooms", name="see_rooms")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Room::class);
        $rooms = $repository->findall();

        return $this->render('see_rooms/index.html.twig', [
            'controller_name' => 'SeeRoomsController',
            'rooms' => $rooms,
        ]);
    }
}
