<?php

namespace Shop\MainBundle\Component\Name;

class NameProvider
{
	protected $session;	

	public function __construct($session)
	{
		$this->session = $session; 
	}
	
	public function getName()
	{
		return $this->session->get('my_name');
	}
}