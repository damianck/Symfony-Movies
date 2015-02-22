<?php


namespace Shop\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="`order`")
 */
class Order
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Shop\MainBundle\Entity\Movie")
     */
    protected $movies;


    /**
     * @ORM\ManyToOne(targetEntity="Shop\MainBundle\Entity\User", inversedBy="orders")
     */
    protected $userId;

    /**
     * @ORM\ManyToOne(targetEntity="Shop\MainBundle\Entity\OrderStatus", inversedBy="order")
     */
    protected $status;

    /**
     * @var dateOfCreateOrder
     * @ORM\Column( type="datetime")
     */
    protected $dateOfCreateOrder;

    /**
     * @var dateOfExecutionOrder
     * @ORM\Column( type="datetime", nullable=true)
     */
    protected  $dateOfExecutionOrder;

    //---------------------------------------------------- Constructor

    public function __construct( )
    {
        $this->movies = [];
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

    //---------------------------------------------------- movie

    public function getMovies()
    {
        return $this->movies;
    }


    public function setMovies($movies)
    {
        $this->movies = $movies;
        return $this;
    }

    public function addMovie($movie)
    {
        array_push($this->movies, $movie);
        return $this;
    }
    //---------------------------------------------------- user

    /**
     * Set user
     *
     * @param integer $userId
     * @return Order
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }
    /**
     * Get user
     *
     * @return userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    //---------------------------------------------------- status

    /**
     * Set status
     *
     * @param status $status
     * @return Order
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
    /**
     * Get status
     *
     * @return status
     */
    public function getStatus()
    {
        return $this->status;
    }

    //---------------------------------------------------- dateOfCreateOrder

    /**
     * Set dateOfCreateOrder
     *
     * @param datetime $dateOfCreateOrder
     * @return Order
     */
    public function setDateOfCreateOrder($dateOfCreateOrder)
    {
        $this->dateOfCreateOrder = $dateOfCreateOrder;

        return $this;
    }
    /**
     * Get dateOfCreateOrder
     *
     * @return datetime
     */
    public function getDateOfCreateOrder()
    {
        return $this->dateOfCreateOrder;
    }

    //---------------------------------------------------- dateOfExecutionOrder

    /**
     * Set dateOfCreateOrder
     *
     * @param datetime $dateOfExecutionOrder
     * @return Order
     */
    public function setDateOfExecutionOrder($dateOfExecutionOrder)
    {
        $this->dateOfExecutionOrder = $dateOfExecutionOrder;

        return $this;
    }
    /**
     * Get dateOfExecutionOrder
     *
     * @return datetime
     */
    public function getDateOfExecutionOrder()
    {
        return $this->dateOfExecutionOrder;
    }
}