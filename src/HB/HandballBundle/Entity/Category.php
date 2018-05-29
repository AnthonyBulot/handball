<?php
// src/OC/PlatformBundle/Entity/Application.php

namespace HB\HandballBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table(name="handball_category")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Entity\CategoryRepository")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
  /**
   * @ORM\OneToOne(targetEntity="HB\HandballBundle\Entity\Posts", inversedBy="category")
   * @ORM\JoinColumn(nullable=false)
   */
  private $posts;

    /**
    * Get id
    *
    * @return int
    */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set posts
     *
     * @param \HB\HandballBundle\Entity\Posts $posts
     *
     * @return Category
     */
    public function setPosts(\HB\HandballBundle\Entity\Posts $posts)
    {
        $this->posts = $posts;

        return $this;
    }

    /**
     * Get posts
     *
     * @return \HB\HandballBundle\Entity\Posts
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
