<?php
// src/OC/PlatformBundle/Entity/Application.php

namespace HB\HandballBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table(name="handball_category")
 * @ORM\Entity(repositoryClass="HB\HandballBundle\Repository\CategoryRepository")
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
   * @ORM\OneToMany(targetEntity="HB\HandballBundle\Entity\Posts", mappedBy="category", cascade={"remove"})
   * @ORM\JoinColumn(nullable=false)
   */
  private $posts;
  
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     * @Assert\NotBlank
     */
    private $name;

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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
