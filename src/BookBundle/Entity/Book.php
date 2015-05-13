<?php


namespace BookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * The basic book that is available in the library.
 *
 * @package BookBundle\Entity
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 *
 * @ORM\Entity(repositoryClass="BookBundle\Repository\BookRepository")
 * @ORM\Table(name="book")
 */
class Book extends AbstractEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="isbn", type="string", length=160)
     */
    protected $isbn;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=160)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="author_first_name", type="string", length=160)
     */
    protected $authorFirstName;

    /**
     * @var string
     *
     * @ORM\Column(name="author_last_name", type="string", length=160)
     */
    protected $authorLastName;

    /**
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param string $isbn
     *
     * @return $this
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorFirstName()
    {
        return $this->authorFirstName;
    }

    /**
     * @param string $authorFirstName
     *
     * @return $this
     */
    public function setAuthorFirstName($authorFirstName)
    {
        $this->authorFirstName = $authorFirstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorLastName()
    {
        return $this->authorLastName;
    }

    /**
     * @param string $authorLastName
     *
     * @return $this
     */
    public function setAuthorLastName($authorLastName)
    {
        $this->authorLastName = $authorLastName;

        return $this;
    }


}
