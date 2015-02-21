<?php

namespace Shop\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class OrderStatus {


    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $status;

    /**
     * @ORM\OneToMany(targetEntity="Order", mappedBy="status")
     */
    protected $order;


    //---------------------------------------------------- Id

    public function getId()
    {
        return $this->id;
    }

    //---------------------------------------------------- Status

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    //---------------------------------------------------- Order

    public function getOrder()
    {
        $this->order;
    }

    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }
}