<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\Column;

/**
 * @ORM\Entity(repositoryClass="\AppBundle\Repository\MangaRepository")
 * @ORM\Table(name="app_manga")
 */
class Manga
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=199)
     * @Assert\NotBlank()
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type = "string")
     * @Assert\NotBlank()
     * @Assert\Regex("/^[A-Z]\w{2,}$/", message="Merci de respecter le format demandé :P")
     * @var string
     */
    private $author;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Regex("/^[A-Z]\w{2,}$/", message="Merci de respecter le format demandé :P")
     * @var string
     */
    private $drawer;

    /**
     * @Column(type="text", length=666, nullable=true)
     * @var string
     */
    private $description;

    /** Constructor. */
    public function __construct(string $name = null, string $author = null)
    {
        $this->name = $name;
        $this->author = $author;
    }

    /**
     *
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     *
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     *
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * Set drawer
     *
     * @param string $drawer
     *
     * @return Manga
     */
    public function setDrawer($drawer)
    {
        $this->drawer = $drawer;

        return $this;
    }

    /**
     * Get drawer
     *
     * @return string
     */
    public function getDrawer()
    {
        return $this->drawer;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Manga
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
