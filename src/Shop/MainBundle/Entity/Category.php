<?php

namespace Shop\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

 /**
  * @ORM\Entity
  * @ORM\Table()
  */
class Category
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
	protected $name;
	
	/**
     * @ORM\ManyToOne(targetEntity="Movie", inversedBy="categories")
     */
    protected $movie;




	public function getId()
	{
		return $this->id;
	}

	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	public function getName()
	{
		return $this->name;
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
		return $this->getName();
	}
}