<?php


namespace Shop\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Shop\MainBundle\Controller\UserController;

/**
 * @ORM\Entity
 * @ORM\Table(name="`fos_user`")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    protected $id;

    /**
     *  @var array
     * @ORM\Column(type="array")
     * @ORM\OneToMany(targetEntity="Shop\MainBundle\Entity\Order", mappedBy="userId")
     */
    protected $orders;

    /**
     * @ORM\Column(type="text")
     */
    protected $avatar;




    public function __construct()
    {
        $this->orders = [];
        $this->avatar = "http://i.imgur.com/A7Dy18f.png";
        parent::__construct();
        // your own logic
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

    //---------------------------------------------------- Orders

    /**
     * Set orders
     *
     * @param ArrayCollection $orders
     * @return User
     */
    public function setOrders($orders)
    {
        $this->orders = $orders;

        return $this;
    }
    /**
     * Get orders
     *
     * @return order
     */
    public function getOrders()
    {
        if( is_null($this->orders))
        {
            $this->orders = [];
        }
        return $this->orders;
    }

    /**
     * Add order
     *
     * @param order $order
     * @return User
     */
    public function addOrder($order)
    {
        if( is_null($this->orders) ||$this->orders != [])
        {
            $this->orders = [];
        }
        array_push($this->orders, $order);

        return $this;
    }


    //---------------------------------------------------- Avatar

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }
    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }



}