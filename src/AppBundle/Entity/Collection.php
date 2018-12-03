<?php
/**
 * Collection entity.
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Collection.
 *
 * @ORM\Table(
 *     name="collections"
 * )
 * @ORM\Entity(
 *     repositoryClass="AppBundle\Repository\CollectionRepository"
 * )
 * @UniqueEntity(
 *     groups={"collection-default"},
 *     fields={"name"}
 * )
 */
class Collection
{
    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     * See http://symfony.com/doc/current/best_practices/configuration.html#constants-vs-configuration-options
     */
    const NUM_ITEMS = 5;

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
     *     mappedBy="collection",
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
     *     length=11,
     *     nullable=false,
     * )
     *
     * @Assert\NotBlank(
     *     groups={"collection-default"}
     * )
     * @Assert\Length(
     *     groups={"collection-default"},
     *     min="3",
     *     max="11",
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
     * @return Collection
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
     * @return Collection
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
}
