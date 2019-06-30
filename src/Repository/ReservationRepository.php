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

    public function stats_today($time, $time2)
    {
        $query = $this->_em->createQueryBuilder();

        return $query->select('reservation')
            ->from(Reservation::class, 'reservation')
            ->where('reservation.checkoutDate between :time  AND :time2 ')
            ->getQuery()
            ->setParameters(['time' => $time, 'time2' => $time2])->getResult();
    }

    public function stats_week($week, $week2)
    {
        $query = $this->_em->createQueryBuilder();

        return $query->select('reservation')
            ->from(Reservation::class, 'reservation')
            ->where('reservation.checkoutDate between :week AND :week2 ')
            ->getQuery()
            ->setParameters(['week' => $week, 'week2' => $week2])->getResult();
    }

}
