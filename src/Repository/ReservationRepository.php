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

    public function occupiedFinder($begindate, $enddate)
    {
        return $this->createQueryBuilder('d')
            ->where('d.checkin_date BETWEEN :from AND :to')
            ->orWhere('d.checkout_date BETWEEN :from AND :to')
            ->orWhere(':from BETWEEN d.checkin_date and d.checkout_date ')
            ->orderBy('d.checkin_date', 'ASC')
            ->setParameter('from', $begindate)
            ->setParameter('to', $enddate)
            ->getQuery()->getResult();
    }
}
