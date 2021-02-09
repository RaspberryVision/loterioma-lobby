<?php

namespace App\Repository;

use App\Entity\DiceRound;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DiceRound|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiceRound|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiceRound[]    findAll()
 * @method DiceRound[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiceRoundRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiceRound::class);
    }

    // /**
    //  * @return DiceRound[] Returns an array of DiceRound objects
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
    public function findOneBySomeField($value): ?DiceRound
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
