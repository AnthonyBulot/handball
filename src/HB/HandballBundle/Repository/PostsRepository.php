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
        
        //  Recupère seulement les catégories correspondants au nom donné
        $qb
           ->where('c.id = :id')
           ->setParameter('id', $id);
        
        return $qb
            ->getQuery()
            ->getResult()
        ;
    }
}
