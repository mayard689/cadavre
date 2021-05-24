<?php

namespace App\Repository;

use App\Entity\Newsletter;
use App\Entity\NewsletterEmail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NewsletterEmail|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewsletterEmail|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewsletterEmail[]    findAll()
 * @method NewsletterEmail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsletterEmailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NewsletterEmail::class);
    }

    public function findByNewsletter(Newsletter $newsletter)
    {
        return $this->createQueryBuilder('n')
            ->join('n.newsletterTrackers', 'tracker')
            ->andWhere('tracker.newsletter = :val')
            ->setParameter('val', $newsletter->getId())
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return NewsletterEmail[] Returns an array of NewsletterEmail objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NewsletterEmail
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
