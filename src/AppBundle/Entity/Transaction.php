<?php
/**
 * Transaction entity.
 *
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\User;
use AppBundle\Entity\Status;
use AppBundle\Entity\Collection;
use AppBundle\Entity\PaymentMethod;
use AppBundle\Entity\Spectale;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AcmeAssert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Transaction.
 *
 * @ORM\Table(
 *     name="transactions"
 * )
 * @ORM\Entity(
 *     repositoryClass="AppBundle\Repository\TransactionRepository"
 * )
 *
 */
class Transaction
{
    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     * See http://symfony.com/doc/current/best_practices/configuration.html#constants-vs-configuration-options
     */

    const NUM_ITEMS = 10;

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
     * Collection
     *
     * @ORM\ManyToOne(targetEntity="Collection", inversedBy="transactions")
     * @ORM\JoinColumn(name="collectionId", referencedColumnName="id", nullable=false)
     */
    private $collection;

    /**
     * Payment Method
     *
     * @ORM\ManyToOne(targetEntity="PaymentMethod", inversedBy="transactions")
     * @ORM\JoinColumn(name="paymentMethodId", referencedColumnName="id", nullable=false)
     */
    private $paymentmethod;

    /**
     * Status
     *
     * @ORM\ManyToOne(targetEntity="Status", inversedBy="transactions")
     * @ORM\JoinColumn(name="statusId", referencedColumnName="id", nullable=false)
     */
    protected $status;


    /**
     * Fos User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="transactions", cascade={"persist"})
     * @ORM\JoinColumn(name="userId", referencedColumnName="id", nullable=false)
     */
    protected $user;

    /**
     * Date.
     *
     * @var \DateTime $date
     *
     * @ORM\Column(
     *     name="date",
     *     type="datetime",
     *     nullable=false,
     * )
     * @Gedmo\Timestampable(
     *     on="create",
     * )
     * @Assert\NotBlank(
     *     groups={"spectacle-default"},
     *      message="To pole nie może być puste!"
     * )
     */
    protected $date;

    /**
     * Spectacle
     *
     * @ORM\ManyToOne(
     *     targetEntity="Spectacle",
     *     inversedBy="transaction",
     *     cascade={"persist"}
     *)
     * @ORM\JoinColumn(
     *     name="spectacleId",
     *     referencedColumnName="id",
     *     nullable=false
     *)
     */
    protected $spectacle;

    /**
     * Single ticket price.
     *
     * @var int $singleTicketPrice
     *
     * @ORM\Column(
     *     name="singleTicketPrice",
     *     type="integer",
     *     nullable=false,
     *     options={"unsigned"=true},
     * )
     *
     * @Assert\NotBlank(
     *     groups={"transaction-default"},
     *      message="To pole nie może być puste!"
     * )
     *
     */
    private $singleTicketPrice;

    /**
     * Number of tickets.
     *
     * @var int $numberOfTickets
     *
     * @ORM\Column(
     *     name="numberOfTickets",
     *     type="integer",
     *     nullable=false,
     *     options={"unsigned"=true},
     * )
     *
     * @Assert\NotBlank(
     *     groups={"transaction-default"},
     *     message="To pole nie może być puste!"
     * )
     * @Assert\GreaterThan(
     *     groups={"transaction-default"},
     *     value = 0,
     *     message = "error-greater"
     * )
     */
    private $numberOfTickets;
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
     * @return Transaction
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
     * Set collection
     *
     * @param \AppBundle\Entity\Collection $collection
     *
     * @return Transaction
     */
    public function setCollection(\AppBundle\Entity\Collection $collection)
    {
        $this->collection = $collection;

        return $this;
    }

    /**
     * Get collection
     *
     * @return \AppBundle\Entity\Collection
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Set paymentmethod
     *
     * @param \AppBundle\Entity\PaymentMethod $paymentmethod
     *
     * @return Transaction
     */
    public function setPaymentmethod(\AppBundle\Entity\PaymentMethod $paymentmethod)
    {
        $this->paymentmethod = $paymentmethod;

        return $this;
    }

    /**
     * Get paymentmethod
     *
     * @return \AppBundle\Entity\PaymentMethod
     */
    public function getPaymentmethod()
    {
        return $this->paymentmethod;
    }

    /**
     * Set status
     *
     * @param \AppBundle\Entity\Status $status
     *
     * @return Transaction
     */
    public function setStatus(\AppBundle\Entity\Status $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \AppBundle\Entity\Status
     */
    public function getStatus()
    {
        return $this->status;
    }


    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Transaction
     */
    public function setUser(\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set numberOfTickets
     *
     * @param integer $numberOfTickets
     *
     * @return Transaction
     */
    public function setNumberOfTickets($numberOfTickets)
    {
        $this->numberOfTickets = $numberOfTickets;

        return $this;
    }

    /**
     * Get numberOfTickets
     *
     * @return integer
     */
    public function getNumberOfTickets()
    {
        return $this->numberOfTickets;
    }

    /**
     * Set spectacle
     *
     * @param \AppBundle\Entity\Spectacle $spectacle
     *
     * @return Transaction
     */
    public function setSpectacle(\AppBundle\Entity\Spectacle $spectacle = null)
    {
        $this->spectacle = $spectacle;

        return $this;
    }

    /**
     * Get spectacle
     *
     * @return \AppBundle\Entity\Spectacle
     */
    public function getSpectacle()
    {
        return $this->spectacle;
    }

    /**
     * Set singleTicketPrice
     *
     * @param integer $singleTicketPrice
     *
     * @return Transaction
     */
    public function setSingleTicketPrice($singleTicketPrice)
    {
        $this->singleTicketPrice = $singleTicketPrice;

        return $this;
    }

    /**
     * Get singleTicketPrice
     *
     * @return integer
     */
    public function getSingleTicketPrice()
    {
        return $this->singleTicketPrice;
    }
}
