<?php


namespace Shop\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class Review {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $author;

    /**
     * @ORM\ManyToOne(targetEntity="Movie", inversedBy="reviews")
     */
    protected $movie;




    public function getId()
    {
        return $this->id;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getMovie()
    {
        $this->movie;
    }

    public function setMovie($movie)
    {
        $this->movie = $movie;
        return $this;
    }


    public function __toString()
    {
        return $this->getContent();
    }
}