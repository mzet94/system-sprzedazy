<?php
/**
 * Detail entity.
 *
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Detail.
 *
 * @ORM\Table(
 *     name="userDetails"
 * )
 * @ORM\Entity(
 *     repositoryClass="AppBundle\Repository\DetailRepository"
 * )
 * @UniqueEntity("fos_userId")
 *
 */
class Detail
{
    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     * See http://symfony.com/doc/current/best_practices/configuration.html#constants-vs-configuration-options
     */
    const NUM_ITEMS = 8;

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
     * User
     * @ORM\ManyToOne(
     *     targetEntity="UserBundle\Entity\User",
     *     inversedBy="details"
     * )
     * @ORM\JoinColumn(
     *     name="fos_userId",
     *     referencedColumnName="id",
     *     nullable=false,
     *     unique=true
     * )
     * @Assert\NotBlank(
     *     groups={"detail-default"}
     * )
     * @Assert\Type(type="UserBundle\Entity\User")
     * @Assert\Valid()
     */
    protected $fosUser;

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
     *     groups={"detail-default"},
     *      message="To pole nie może być puste!"
     * )
     * @Assert\Length(
     *     groups={"detail-default"},
     *     min="3",
     *     max="15",
     *     minMessage = "Imię musi mieć przynajmniej {{ limit }} litery.",
     *     maxMessage = "Zbyt długie imię. Limit to {{ limit }} liter.",
     * )
     *
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
     *     groups={"detail-default"},
     *     message="To pole nie może być puste!"
     * )
     * @Assert\Length(
     *     groups={"detail-default"},
     *     min="3",
     *     max="20",
     *     minMessage = "Nazwisko musi mieć przynajmniej {{ limit }} litery.",
     *     maxMessage = "Zbyt długie nazwisko. Limit to {{ limit }} liter.",
     * )
     */
    protected $surname;


    /**
     * Phone.
     *
     * @var string $phone
     *
     * @ORM\Column(
     *     name="phone",
     *     type="text",
     *     length=9,
     *     nullable=false,
     * )
     *
     * @Assert\NotBlank(
     *     groups={"detail-default"},
     *     message="To pole nie może być puste!"
     * )
     * @Assert\Length(
     *     groups={"detail-default"},
     *     min="9",
     *     max="9",
     * )
     * @Assert\Regex(
     *     groups={"address-default"},
     *     pattern="/^[0-9]{9}$/",
     *     match="false",
     *     message="Podaj poprawny numer!"
     * )
     */
    protected $phone;

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
     *     groups={"address-default"},
     *      message="empty_field"
     * )
     * @Assert\Length(
     *     groups={"address-default"},
     *     min="3",
     *     max="30",
     *     minMessage = "Name of the city must have {{ limit }} letters.",
     *     maxMessage = "Name of the city must have less than {{ limit }} letters.",
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
     *     groups={"address-default"},
     *      message="empty_field"
     * )
     * @Assert\Length(
     *     groups={"address-default"},
     *     min="3",
     *     max="25",
     *     minMessage = "Name of the street must have {{ limit }} letters.",
     *     maxMessage = "Name of the street must have less than {{ limit }} letters.",
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
     *     groups={"address-default"},
     *      message="empty_field"
     * )
     * @Assert\GreaterThan(
     *     groups={"address-default"},
     *     value = 0,
     *     message = "write_number"
     * )
     */
    protected $number;

    /**
     * Post.
     *
     * @var string $post
     *
     * @ORM\Column(
     *     name="post",
     *     type="text",
     *     nullable=false,
     * )
     *
     * @Assert\NotBlank(
     *     groups={"address-default"},
     *      message="empty_field"
     * )
     * @Assert\Regex(
     *     groups={"address-default"},
     *     pattern="/^[0-9]{2}-[0-9]{3}$/",
     *     match=true,
     *     message="invalid_post"
     * )
     * @Assert\Length(
     *     groups={"address-default"},
     *     min="6",
     *     max="6",
     *     minMessage = "post_invalid_min {{limit}}",
     *     maxMessage = "post_invalid_max {{limit}}",
     * )
     */
    protected $post;

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
     * @return Detail
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
     * @return Detail
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
     * Set phone
     *
     * @param integer $phone
     *
     * @return Detail
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Address
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
     * @return Address
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
     * @return Address
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
     * Set post
     *
     * @param integer $post
     *
     * @return Address
     */
    public function setPost($post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return integer
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set fosUser
     *
     * @param \UserBundle\Entity\User $fosUser
     *
     * @return Detail
     */
    public function setFosUser(\UserBundle\Entity\User $fosUser = null)
    {
        $this->fosUser = $fosUser;

        return $this;
    }

    /**
     * Get fosUser
     *
     * @return \UserBundle\Entity\User
     */
    public function getFosUser()
    {
        return $this->fosUser;
    }
}
