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
   * @ORM\OneToMany(targetEntity="HB\HandballBundle\Entity\Posts", mappedBy="category")
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
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add post
     *
     * @param \HB\HandballBundle\Entity\Posts $post
     *
     * @return Category
     */
    public function addPost(\HB\HandballBundle\Entity\Posts $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \HB\HandballBundle\Entity\Posts $post
     */
    public function removePost(\HB\HandballBundle\Entity\Posts $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
