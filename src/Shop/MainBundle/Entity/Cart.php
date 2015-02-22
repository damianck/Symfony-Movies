<?php

namespace Shop\MainBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * Cart
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Cart
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var array
     * @ORM\Column(type="array")
     */
    protected $moviesId;


    /**
     * @var userId
     * @ORM\Column( type="integer")
     */
    protected $userId;


    public function __construct($userId)
    {
        $this->moviesId = [];
        $this->userId = $userId;
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

    //---------------------------------------------------- userId


    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId() {
        return $this->userId;
    }

    //---------------------------------------------------- movies

    /**
     * Get moviesId
     *
     * @return array
     */
    public function getMoviesId()
    {
        return $this->moviesId;
    }

    /**
     * Set moviesId
     *
     * @param array $moviesId
     * @return Cart
     */
    public function setMoviesId($moviesId)
    {
        $this->moviesId = $moviesId;
        return $this;
    }

    public function addMovieId($movieId) {
        array_push($this->moviesId, $movieId);
    }

    public function removeMovieId($movieId) {
        // Magic Number
        // Filmy indeksowane są od 1 a tablica od 0 więc trzeba to naprawić
        unset($this->moviesId[($movieId -1)]);
    }


}