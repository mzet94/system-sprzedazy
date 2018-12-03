<?php
/**
 * User entity.
 */
namespace UserBundle\Entity;

use Composer\DependencyResolver\Operation;
use FOS\UserBundle\Model\User as BaseUser;
use AppBundle\Entity\Detail;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class user
 *
 * @ORM\Entity
 * @ORM\Table(
 *     name="fos_user"
 * )
 */
class User extends BaseUser
{
    const NUM_ITEMS = 8;

    /**
     * Id
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
     * Transactions
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Transaction", mappedBy="user", cascade={"persist", "remove"})
     */
    private $transactions;
    /**
     * Details
     *
     *
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\Detail",
     *     mappedBy="fosUser",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $details;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->details = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add transactions
     *
     * @param \AppBundle\Entity\Transaction $transactions
     *
     * @return Transaction
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
     * Add detail
     *
     * @param \AppBundle\Entity\Detail $detail
     *
     * @return User
     */
    public function addDetail(\AppBundle\Entity\Detail $detail)
    {
        $this->details[] = $detail;

        return $this;
    }

    /**
     * Remove detail
     *
     * @param \AppBundle\Entity\Detail $detail
     */
    public function removeDetail(\AppBundle\Entity\Detail $detail)
    {
        $this->details->removeElement($detail);
    }

    /**
     * Get details
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDetails()
    {
        return $this->details;
    }
}
