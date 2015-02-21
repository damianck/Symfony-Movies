<?php


namespace Shop\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\OneToMany(targetEntity="Shop\MainBundle\Entity\Order", mappedBy="userId")
     */
    protected $orders;

    /**
     * @ORM\Column(type="text")
     */
    protected $avatar;

    /**
     *
     * @var movie
     */
    public $cart;


    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->cart = new ArrayCollection();
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
            $this->orders = new ArrayCollection();
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
        if( is_null($this->orders))
        {
            $this->orders = new ArrayCollection();
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

    //---------------------------------------------------- Cart

    /**
     * Set cart
     *
     * @param ArrayCollection $cart
     * @return User
     */
    public function setCart($cart)
    {
        $this->cart = $cart;

        return $this;
    }
    /**
     * Add to cart
     *
     * @param movie $movie
     * @return User
     */
    public function addToCart($movie)
    {
        if( is_null($this->cart))
        {
            $this->cart = new ArrayCollection();
        }
        $this->cart->add($movie);

        return $this;
    }
    /**
     * Get cart
     *
     * @return ArrayCollection
     */
    public function getCart()
    {
        if( is_null($this->cart))
        {
            $this->cart = new ArrayCollection();
        }
        return $this->cart;
    }
    /**
     * Get cartCount
     *
     * @return integer
     */
    public function getCartCount()
    {
        if( is_null($this->cart))
        {
            $this->cart = new ArrayCollection();
        }
        return $this->cart->count();
    }

}