<?php

namespace Shop\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

 /**
  * @ORM\Entity
  * @ORM\Table()
  */
class Tag
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
     * @ORM\ManyToOne(targetEntity="Movie", inversedBy="tags")
     */
    protected $feed;
	
	public function getFeed()
	{
		$this->feed;
	}
	
	public function setFeed($feed)
	{
		$this->feed = $feed;
		return $this;
	}
	
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
	
	public function __toString()
	{
		return $this->getName();
	}
}