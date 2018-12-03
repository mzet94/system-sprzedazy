<?php
/**
 * Location entity.
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Location.
 *
 * @ORM\Table(
 *     name="locations"
 * )
 * @ORM\Entity(
 *     repositoryClass="AppBundle\Repository\LocationRepository"
 * )
 */
class Location
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
     * Spectacles.
     *
     *
     * @ORM\OneToMany(
     *     targetEntity="Spectacle",
     *     mappedBy="location",
     *      cascade = {"persist", "remove"}
     * )
     */
    private $spectacles;

    /**
     * City name.
     *
     * @var string $city
     *
     * @ORM\Column(
     *     name="city",
     *     type="string",
     *     length=30,
     *     nullable=false,
     * )
     *
     * @Assert\NotBlank(
     *     groups={"location-default"},
     *      message="To pole nie może być puste!"
     * )
     * @Assert\Length(
     *     groups={"location-default"},
     *     min="3",
     *     max="30",
     *     minMessage = "Nazwa miasta nie może mieć mniej niż {{ limit }} litery.",
     *     maxMessage = "Zbyt długa nazwa. Długość nie może przekraczać{{ limit }} liter.",
     * )
     */
    protected $city;
    /**
     * Street name.
     *
     * @var string $street
     *
     * @ORM\Column(
     *     name="street",
     *     type="string",
     *     length=25,
     *     nullable=false,
     * )
     *
     * @Assert\NotBlank(
     *     groups={"location-default"},
     *      message="To pole nie może być puste!"
     * )
     * @Assert\Length(
     *     groups={"location-default"},
     *     min="3",
     *     max="25",
     *     minMessage = "Nazwa ulicy nie może mieć mniej niż {{ limit }} litery.",
     *     maxMessage = "Zbyt długa nazwa. Długość nie może przekraczać{{ limit }} liter.",
     * )
     */
    protected $street;

    /**
     * Street number.
     *
     * @var string $number
     *
     * @ORM\Column(
     *     name="number",
     *     type="integer",
     *     nullable=false,
     *     options={"unsigned"=true},
     * )
     *
     * @Assert\NotBlank(
     *     groups={"location-default"},
     *      message="To pole nie może być puste!"
     * )
     * @Assert\GreaterThan(
     *     groups={"location-default"},
     *     value = 0,
     *     message = "Wpisz poprawny numer. Pamiętaj, że musi być liczbą dodatnią."
     * )
     */
    protected $number;

    /**
     * Name of location.
     *
     * @var string $name
     *
     * @ORM\Column(
     *     name="name",
     *     type="string",
     *     length=25,
     *     nullable=false,
     * )
     *
     * @Assert\NotBlank(
     *     groups={"location-default"},
     *      message="To pole nie może być puste!"
     * )
     * @Assert\Length(
     *     groups={"location-default"},
     *     min="3",
     *     max="25",
     *     minMessage = "Nazwa teatru nie może mieć mniej niż {{ limit }} litery.",
     *     maxMessage = "Zbyt długa nazwa. Długość nie może przekraczać {{ limit }} liter.",
     * )
     */
    protected $name;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->spectacles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set city
     *
     * @param string $city
     *
     * @return Location
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return Location
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return Location
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set name of location
     *
     * @param string $name
     *
     * @return Location
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name of location
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add spectacle
     *
     * @param \AppBundle\Entity\Spectacle $spectacles
     *
     * @return Location
     */
    public function addSpectacle(\AppBundle\Entity\Spectacle $spectacles)
    {
        $this->spectacles[] = $spectacles;

        return $this;
    }

    /**
     * Remove spectacles
     *
     * @param \AppBundle\Entity\Spectacle $spectacles
     */
    public function removeSpectacle(\AppBundle\Entity\Spectacle $spectacles)
    {
        $this->spectacles->removeElement($spectacles);
    }

    /**
     * Get spectacles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpectacle()
    {
        return $this->spectacles;
    }

    /**
     * Get spectacles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpectacles()
    {
        return $this->spectacles;
    }
}
