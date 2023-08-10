<?php

namespace App\Repository;

use App\Entity\ContactContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ContactContent>
 *
 * @method ContactContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactContent[]    findAll()
 * @method ContactContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactContent::class);
    }

//    /**
//     * @return ContactContent[] Returns an array of ContactContent objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ContactContent
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
