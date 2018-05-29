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
        
        //  Recup�re seulement les cat�gories correspondants au nom donn�
        $qb
           ->where('c.id = :id')
           ->setParameter('id', $id);
        
        return $qb
            ->getQuery()
            ->getResult()
        ;
    }
}
