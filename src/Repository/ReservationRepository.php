<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    public function roomOccupied($checkinDate, $checkoutDate)
    {
        $query = $this->_em->createQueryBuilder();

        $subquery = $this->_em->createQueryBuilder()
            ->select('identity(reservation.room_id)')
            ->from(Reservation::class, 'reservation')
            ->where('reservation.start_date BETWEEN :from AND :to')
            ->orWhere('reservation.end_date BETWEEN :from AND :to')
            ->orWhere(':from BETWEEN reservation.start_date and reservation.end_date')
            ->orderBy('reservation.start_date', 'ASC')
            ->setParameters(['from' => $checkinDate, 'to' => $checkoutDate])
            ->getDQL();


        return $query->select('room')
            ->from(Room::class, 'room')
            ->where($query->expr()->notIn('room.id', $subquery))->getQuery()
            ->setParameters(['from' => $checkinDate, 'to' => $checkoutDate])->getResult();
    }
}
