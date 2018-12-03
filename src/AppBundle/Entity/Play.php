<?php
/**
 * Play entity.
 */
namespace AppBundle\Entity;

use AppBundle\Entity\Director;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Play.
 *
 * @ORM\Table(
 *     name="plays"
 * )
 * @ORM\Entity(
 *     repositoryClass="AppBundle\Repository\PlayRepository"
 * )
 * @UniqueEntity(
 *     groups={"play-default"},
 *     fields={"title"}
 * )
 *
 */
class Play
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
     * Many Plays have One Director.
     * @ORM\ManyToOne(
     *     targetEntity="Director",
     *     inversedBy="plays"
     * )
     * @ORM\JoinColumn(
     *     name="directorId",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    protected $director;


    /**
     * Title.
     *
     * @var string $title
     *
     * @ORM\Column(
     *     name="title",
     *     type="string",
     *     length=50,
     *     nullable=false,
     *     unique=true,
     * )
     *
     * @Assert\NotBlank(
     *     groups={"play-default"},
     *     message="empty_field"
     * )
     * @Assert\Length(
     *     groups={"play-default"},
     *     min="3",
     *     max="50",
     *     minMessage = "title_min {{ limit }}",
     *     maxMessage = "title_max {{ limit }}",
     * )
     *
     */
    protected $title;

    /**
     * Spectacles.
     * One Play has Many Spectacles.
     *
     * @ORM\OneToMany(
     *     targetEntity="Spectacle",
     *     mappedBy="play",
     *     cascade={"persist", "remove"}
     *)
     * @Assert\Type(type="AppBundle\Entity\Spectacles")
     * @Assert\Valid()
     */
    private $spectacles;

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
     * Set title
     *
     * @param string $title
     *
     * @return Play
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set director
     *
     * @param \AppBundle\Entity\Director $director
     *
     * @return Play
     */
    public function setDirector(\AppBundle\Entity\Director $director)
    {
        $this->director = $director;

        return $this;
    }

    /**
     * Get director
     *
     * @return \AppBundle\Entity\Director
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->spectacles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add spectacle
     *
     * @param \AppBundle\Entity\Spectacle $spectacle
     *
     * @return Play
     */
    public function addSpectacle(\AppBundle\Entity\Spectacle $spectacle)
    {
        $this->spectacles[] = $spectacle;

        return $this;
    }

    /**
     * Remove spectacle
     *
     * @param \AppBundle\Entity\Spectacle $spectacle
     */
    public function removeSpectacle(\AppBundle\Entity\Spectacle $spectacle)
    {
        $this->spectacles->removeElement($spectacle);
    }

    /**
     * Get spectacles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpectacles()
    {
        $this->spectacle;
    }
}
