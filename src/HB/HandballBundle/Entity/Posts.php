<?php

namespace HB\HandballBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Posts
 *
 * @ORM\Table(name="handball_posts")
 * @ORM\Entity(repositoryClass="HB\HandballBundle\Repository\PostsRepository")
 */
class Posts
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank
     */
    private $content;
    
    /**
    * @ORM\OneToOne(targetEntity="HB\HandballBundle\Entity\Image", cascade={"persist", "remove"})
    * @ORM\JoinColumn(nullable=false) 
    * @Assert\Valid()
    */
    private $image;
    
    /**
    * @ORM\ManyToOne(targetEntity="HB\HandballBundle\Entity\Category", cascade={"persist"}, inversedBy="posts")
    * @ORM\JoinColumn(nullable=false)
    * @Assert\Valid()
    */
    private $category;

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
     * Set title
     *
     * @param string $title
     *
     * @return Posts
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Posts
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set image
     *
     * @param \HB\HandballBundle\Entity\Image $image
     *
     * @return Posts
     */
    public function setImage(\HB\HandballBundle\Entity\Image $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \HB\HandballBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }



    /**
     * Set category
     *
     * @param \HB\HandballBundle\Entity\Category $category
     *
     * @return Posts
     */
    public function setCategory(\HB\HandballBundle\Entity\Category $category)
    {
        $this->category = $category;
        
        $category->addPost($this);

        return $this;
    }

    /**
     * Get category
     *
     * @return \HB\HandballBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
