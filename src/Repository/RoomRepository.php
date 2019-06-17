<?php

namespace App\Repository;

use App\Entity\Room;
use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Room|null find($id, $lockMode = null, $lockVersion = null)
 * @method Room|null findOneBy(array $criteria, array $orderBy = null)
 * @method Room[]    findAll()
 * @method Room[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoomRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Room::class);
    }

    public function roomOccupied($checkinDate, $checkoutDate)
    {
        $query = $this->_em->createQueryBuilder();

        $occupied = $this->_em->createQueryBuilder()
            ->select('identity(reservation.room)')
            ->from(Reservation::class, 'reservation')
            ->where('reservation.checkinDate BETWEEN :from AND :to')
            ->orWhere('reservation.checkoutDate BETWEEN :from AND :to')
            ->orWhere(':from BETWEEN reservation.checkinDate AND reservation.checkoutDate')
            ->orderBy('reservation.checkinDate', 'ASC')
            ->setParameters(['from' => $checkinDate, 'to' => $checkoutDate])
            ->getDQL();


        return $query->select('room')
            ->from(Room::class, 'room')
            ->where($query->expr()->notIn('room.id', $occupied))->getQuery()
            ->setParameters(['from' => $checkinDate, 'to' => $checkoutDate])->getResult();
    }
}
