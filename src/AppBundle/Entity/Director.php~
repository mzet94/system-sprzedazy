<?php
/**
 * Director entity.
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Director.
 *
 * @ORM\Table(
 *     name="directors"
 * )
 * @ORM\Entity(
 *     repositoryClass="AppBundle\Repository\DirectorRepository"
 * )
 * @UniqueEntity(
 *     groups={"director-default"},
 *     fields={"firstName", "surname"}
 * )
 */
class Director
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
     * One Director has Many Plays.
     *
     *
     * @ORM\OneToMany(
     *     targetEntity="Play",
     *     mappedBy="director",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $plays;

    /**
     * First name.
     *
     * @var string $firstName
     *
     * @ORM\Column(
     *     name="firstName",
     *     type="string",
     *     length=15,
     *     nullable=false,
     * )
     *
     * @Assert\NotBlank(
     *     groups={"director-default"},
     *      message="To pole nie może być puste!"
     * )
     * @Assert\Length(
     *     groups={"director-default"},
     *     min="3",
     *     max="15",
     *     minMessage = "Imię musi mieć przynajmniej {{ limit }} litery.",
     *     maxMessage = "Zbyt długie imię. Limit to {{ limit }} liter.",
     * )
     */
    protected $firstName;
    /**
     * Surname.
     *
     * @var string $surname
     *
     * @ORM\Column(
     *     name="surname",
     *     type="string",
     *     length=20,
     *     nullable=false,
     * )
     *
     * @Assert\NotBlank(
     *     groups={"director-default"},
     *      message="To pole nie może być puste!"
     * )
     * @Assert\Length(
     *     groups={"director-default"},
     *     min="3",
     *     max="20",
     *     minMessage = "Nazwisko musi mieć przynajmniej {{ limit }} litery.",
     *     maxMessage = "Zbyt długie nazwisko. Limit to {{ limit }} liter.",
     * )
     */
    protected $surname;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->plays = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Director
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return Director
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Add plays
     *
     * @param \AppBundle\Entity\Play $plays
     *
     * @return Director
     */
    public function addPlay(\AppBundle\Entity\Play $plays)
    {
        $this->plays[] = $plays;

        return $this;
    }

    /**
     * Remove plays
     *
     * @param \AppBundle\Entity\Play $plays
     */
    public function removePlay(\AppBundle\Entity\Play $plays)
    {
        $this->plays->removeElement($plays);
    }

    /**
     * Get plays
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlays()
    {
        $this->plays;
    }
}
