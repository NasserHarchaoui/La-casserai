<?php

namespace App\Repository;

use App\Entity\Dave;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Dave|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dave|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dave[]    findAll()
 * @method Dave[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DaveRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Dave::class);
    }

    // /**
    //  * @return Dave[] Returns an array of Dave objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dave
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
