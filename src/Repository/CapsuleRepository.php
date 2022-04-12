<?php

namespace App\Repository;

use App\Entity\Capsule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Capsule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Capsule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Capsule[]    findAll()
 * @method Capsule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CapsuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Capsule::class);
    }

    // /**
    //  * @return Capsule[] Returns an array of Capsule objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Capsule
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    


}