<?php

namespace HB\HandballBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PostsRepository extends EntityRepository
{
    public function getPostWithCategory($id)
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
           ->setParameter('id', $id);
        
        return $qb
            ->getQuery()
            ->getResult()
        ;
    }
     
    public function searchPost($search)
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
}
