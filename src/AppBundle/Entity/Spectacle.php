<?php
/**
 * Spectacle entity.
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AcmeAssert;

/**
 * Class Spectacle.
 *
 * @ORM\Table(
 *     name="spectacles"
 * )
 * @ORM\Entity(
 *     repositoryClass="AppBundle\Repository\SpectacleRepository"
 * )
 */
class Spectacle
{
    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     * See http://symfony.com/doc/current/best_practices/configuration.html#constants-vs-configuration-options
     */
    const NUM_ITEMS = 10;

    /**
     * Location.
     * Many Spectacles has One Location.
     *
     * @ORM\ManyToOne(
     *     targetEntity="Location",
     *     inversedBy="spectacles"
     * )
     * @ORM\JoinColumn(
     *     name="locationId",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     * @Assert\Type(type="AppBundle\Entity\Location")
     * @Assert\Valid()
     */
    private $location;

    /**
     * Play.
     * Many Spectacles has One Play.
     *
     * @ORM\ManyToOne(
     *     targetEntity="Play",
     *     inversedBy="spectacles"
     * )
     * @ORM\JoinColumn(
     *     name="playId",
     *     referencedColumnName="id",
     *     nullable=false
     *)
     * @Assert\Type(type="AppBundle\Entity\Play")
     * @Assert\Valid()
     */
    protected $play;

    /**
     * Transaction.
     *
     *
     * @ORM\OneToMany(
     *     targetEntity="Transaction",
     *     mappedBy="spectacle",
     *     cascade={"persist", "remove"}
     * )
     */
    private $transaction;


    /**
     * Primary key.
     *
     * @var int $id
     *
     * @ORM\Id
     * @ORM\Column(
     *     name="id",
     *     type="integer",
     *     nullable=false,
     *     options={"unsigned"=true},
     * )
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Spectacle repository.
     *
     * @var \AppBundle\Repository\SpectacleRepository|null Spectacle repository
     */
    protected $spectacleRepository = null;


    /**
     * Date.
     *
     * @var string $date
     *
     * @ORM\Column(
     *     name="date",
     *     type="datetime",
     *     nullable=false,
     * )
     * @Assert\NotBlank(
     *     groups={"spectacle-default"},
     *      message="To pole nie może być puste!"
     * )
     */
    protected $date;

    /**
     * Time.
     *
     * @var string $time
     *
     * @ORM\Column(
     *     name="time",
     *     type="time",
     *     nullable=false,
     * )
     *
     * @Assert\NotBlank(
     *     groups={"spectacle-default"},
     *      message="To pole nie może być puste!"
     * )
     */
    protected $time;

    /**
     * Seats.
     *
     * @var int $seats
     *
     * @ORM\Column(
     *     name="seats",
     *     type="integer",
     *     nullable=false,
     *     options={"unsigned"=true},
     * )
     *
     * @Assert\NotBlank(
     *     groups={"spectacle-default"},
     *      message="To pole nie może być puste!"
     * )
     * @Assert\GreaterThan(
     *     groups={"spectacle-default"},
     *     value = 0,
     *     message="Podaj liczbę większą od 0!"
     *)
     *
     */
    protected $seats;

    /**
     * Price.
     *
     * @var int $price
     *
     * @ORM\Column(
     *     name="price",
     *     type="integer",
     *     nullable=false,
     *     options={"unsigned"=true},
     * )
     *
     * @Assert\NotBlank(
     *     groups={"spectacle-default"},
     *      message="To pole nie może być puste!"
     * )
     *
     * @Assert\GreaterThan(
     *     groups={"spectacle-default"},
     *     value = 0,
     *     message="Podaj liczbę większą od 0!"
     *)
     */
    protected $price;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Spectacle
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set time
     *
     * @param \Time $time
     *
     * @return Spectacle
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \Time
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set seats
     *
     * @param integer $seats
     *
     * @return Spectacle
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;

        return $this;
    }

    /**
     * Get seats
     *
     * @return integer
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Spectacle
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set location
     *
     * @param \AppBundle\Entity\Location $location
     *
     * @return Spectacle
     */
    public function setLocation(\AppBundle\Entity\Location $location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \AppBundle\Entity\Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set play
     *
     * @param \AppBundle\Entity\Play $play
     *
     * @return Spectacle
     */
    public function setPlay(\AppBundle\Entity\Play $play = null)
    {
        $this->play = $play;

        return $this;
    }

    /**
     * Get play
     *
     * @return \AppBundle\Entity\Play
     */
    public function getPlay()
    {
        return $this->play;
    }

    /**
     * Add transactions
     *
     * @param \AppBundle\Entity\Transaction $transactions
     *
     * @return Spectacle
     */
    public function addTransaction(\AppBundle\Entity\Transaction $transactions)
    {
        $this->transactions[] = $transactions;

        return $this;
    }

    /**
     * Remove transactions
     *
     * @param \AppBundle\Entity\Transaction $transactions
     */
    public function removeTransaction(\AppBundle\Entity\Transaction $transactions)
    {
        $this->transactions->removeElement($transactions);
    }

    /**
     * Get transactions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTransactions()
    {
        return $this->transactions;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->transaction = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get transaction
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTransaction()
    {
        return $this->transaction;
    }
}
