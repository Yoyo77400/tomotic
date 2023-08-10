<?php

namespace App\Repository;

use App\Entity\FooterContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FooterContent>
 *
 * @method FooterContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method FooterContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method FooterContent[]    findAll()
 * @method FooterContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FooterContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FooterContent::class);
    }

//    /**
//     * @return FooterContent[] Returns an array of FooterContent objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FooterContent
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
