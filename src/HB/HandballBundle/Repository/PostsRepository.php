<?php

namespace HB\HandballBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PostsRepository extends EntityRepository
{
    public function getPostWithCategory($id, $first)
    {
        //Jointure entre Categories et Posts
        $qb = $this
            ->createQueryBuilder('p')
            ->leftJoin('p.category', 'c')
            ->addSelect('c')
        ;
        
        //  Recupère seulement les posts correspondants à l'id de la catégorie donnée
        $qb
            ->where('c.id = :id')
            ->setParameter('id', $id)
            ->setMaxResults(5)
            ->setFirstResult($first);
        
        return $qb
            ->getQuery()
            ->getResult()
        ;
    }
     
    public function searchPost($search, $first)
    {
        //Jointure entre Categories et Posts
        $qb = $this
            ->createQueryBuilder('p')
            ->leftJoin('p.category', 'c')
            ->addSelect('c')
        ;
        
        //  Recupère seulement les posts correspondants à la recherche
        $qb
           ->where('p.title LIKE :search OR c.name LIKE :search')
           ->setParameter('search', $search)
            ->setMaxResults(5)
            ->setFirstResult($first);
        
        return $qb
            ->getQuery()
            ->getResult()
        ;
    }

    public function testSearch($search)
    {
        //Jointure entre Categories et Posts
        $qb = $this
            ->createQueryBuilder('p')
            ->leftJoin('p.category', 'c')
            ->addSelect('c')
        ;
        
        //  Recupère seulement les posts correspondants à la recherche
        $qb
           ->where('p.title LIKE :search OR c.name LIKE :search')
           ->setParameter('search', $search);
        
        return $qb
            ->getQuery()
            ->getResult()
        ;
    }

    public function totalPosts($id)
    {       
        //Jointure entre Categories et Posts
        $qb = $this
            ->createQueryBuilder('p')
            ->leftJoin('p.category', 'c')
            ->addSelect('c')
            ->where('c.id = :id')
            ->setParameter('id', $id);

        $qb->select($qb->expr()->count('p'));

        return $qb
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    public function totalPostSearch($search)
    {       
        //Jointure entre Categories et Posts
        $qb = $this
            ->createQueryBuilder('p')
            ->leftJoin('p.category', 'c')
            ->addSelect('c');

        $qb
           ->where('p.title LIKE :search OR c.name LIKE :search')
           ->setParameter('search', $search);

        $qb->select($qb->expr()->count('p'));

        return $qb
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
}
