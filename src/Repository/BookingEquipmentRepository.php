<?php

namespace App\Repository;

use App\Entity\BookingEquipment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|BookingEquipment find($id, $lockMode = null, $lockVersion = null)
 * @method null|BookingEquipment findOneBy(array $criteria, array $orderBy = null)
 * @method BookingEquipment[]    findAll()
 * @method BookingEquipment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingEquipmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookingEquipment::class);
    }

    // /**
    //  * @return BookingEquipment[] Returns an array of BookingEquipment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BookingEquipment
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
