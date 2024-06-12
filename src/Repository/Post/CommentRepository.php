<?php

namespace App\Repository\Post;

use App\Entity\Post\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
/**
 * @extends ServiceEntityRepository<Comment>
 *
 * @method Comment|null find($id, $locklode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment [] findAll()
 *  @method Comment [] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class CommentRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }
}