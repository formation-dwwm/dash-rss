<?php

namespace App\Repository;

use App\Entity\GroupDash;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method GroupDash|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupDash|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupDash[]    findAll()
 * @method GroupDash[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupDashRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupDash::class);
    }

    // /**
    //  * @return GroupDash[] Returns an array of GroupDash objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GroupDash
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
