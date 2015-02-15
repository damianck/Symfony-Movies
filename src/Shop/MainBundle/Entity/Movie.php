<?php
namespace Shop\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class Movie
{
	/**
	 * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
	/**
     * @ORM\Column(type="string", length=255)
     */
	protected $title;
	/**
	 * @ORM\Column(type="text")
	 */
	protected $description;
    /**
     * @ORM\Column(type="text")
     */
    protected $price;
    /**
     * @ORM\Column(type="text")
     */
    protected $cover;
    /**
     * @ORM\Column(type="text")
     */
    protected $stream;
	/**
     * @ORM\OneToMany(targetEntity="Shop\MainBundle\Entity\Category", mappedBy="movie")
     */
	protected $categories;
    /**
     * @ORM\OneToMany(targetEntity="Shop\MainBundle\Entity\Actor", mappedBy="movie")
     */
    protected $actors;
    /**
     * @ORM\OneToMany(targetEntity="Shop\MainBundle\Entity\Review", mappedBy="movie")
     */
    protected $reviews;



    //---------------------------------------------------- Constructor

    public function __construct( )
    {
        $this->categories = new ArrayCollection();
        $this->actors = new ArrayCollection();
        $this->reviews = new ArrayCollection();
    }


    //---------------------------------------------------- Id

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    //---------------------------------------------------- Title

    /**
     * Set title
     *
     * @param string $title
     * @return Movie
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

    //---------------------------------------------------- Description

    /**
     * Set description
     *
     * @param string $description
     * @return Movie
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    //---------------------------------------------------- Price

    /**
     * Set price
     *
     * @param string $price
     * @return Movie
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    //---------------------------------------------------- Cover

    /**
     * Set cover
     *
     * @param string $cover
     * @return Movie
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }
    /**
     * Get cover
     *
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    //---------------------------------------------------- Stream

    /**
     * Set stream
     *
     * @param string $stream
     * @return Movie
     */
    public function setStream($stream)
    {
        $this->stream = $stream;

        return $this;
    }

    /**
     * Get stream
     *
     * @return string
     */
    public function getStream()
    {
        return $this->stream;
    }

    //---------------------------------------------------- Categories

    public function getCategories()
    {
        return $this->categories;
    }

    public function setCategories($categories)
    {
        $this->categories = $categories;
        return $this;
    }

    //---------------------------------------------------- Actors

    public function getActors()
    {
        return $this->actors;
    }

    public function setActors($actors)
    {
        $this->actors = $actors;
        return $this;
    }

    //---------------------------------------------------- Reviews

    public function getReviews()
    {
        return $this->reviews;
    }

    public function setReviews($reviews)
    {
        $this->reviews = $reviews;
        return $this;
    }


    //---------------------------------------------------- ToString
	
	public function __toString()
	{
		return $this->title;
	}

}
