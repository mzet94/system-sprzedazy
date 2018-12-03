<?php
/**
 * Status entity.
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Status.
 *
 * @ORM\Table(
 *     name="status"
 * )
 * @ORM\Entity(
 *     repositoryClass="AppBundle\Repository\StatusRepository"
 * )
 * @UniqueEntity(
 *     groups={"status-default"},
 *     fields={"name"}
 * )
 */
class Status
{
    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     * See http://symfony.com/doc/current/best_practices/configuration.html#constants-vs-configuration-options
     */
    const NUM_ITEMS = 3;

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
     * Transactions.
     *
     *
     * @ORM\OneToMany(
     *     targetEntity="Transaction",
     *     mappedBy="status",
     * )
     */
    private $transactions;

    /**
     * Name.
     *
     * @var string $name
     *
     * @ORM\Column(
     *     name="name",
     *     type="string",
     *     length=15,
     *     nullable=false,
     * )
     *
     * @Assert\NotBlank(
     *     groups={"status-default"}
     * )
     * @Assert\Length(
     *     groups={"status-default"},
     *     min="3",
     *     max="15",
     * )
     */
    protected $name;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->transactions = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return status
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add transactions
     *
     * @param \AppBundle\Entity\Transaction $transactions
     *
     * @return status
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
     * @return \Doctrine\Common\statuss\status
     */
    public function getTransactions()
    {
        return $this->transactions;
    }
}
