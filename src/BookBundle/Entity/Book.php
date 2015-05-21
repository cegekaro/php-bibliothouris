<?php


namespace BookBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use BookBundle\Validator\Constraints as CustomConstraint;
use BookBundle\Entity\Category as Category;
use BookBundle\Entity\BooksCategories as BooksCategories;


/**
 * The basic book that is available in the library.
 *
 * @package BookBundle\Entity
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 *
 * @ORM\Entity(repositoryClass="BookBundle\Repository\BookRepository")
 * @ORM\Table(name="book")
 * @ORM\HasLifecycleCallbacks()
 */
class Book extends AbstractEntity
{

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Category")
     */
    protected $categories;

    public function __construct() {
        $this->categories = new ArrayCollection();
    }

    /**
     * @var string
     *
     * @ORM\Column(name="isbn", type="string", length=160)
     * @CustomConstraint\ValidIsbn
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
     * @var integer
     *
     * @ORM\Column(name="pages", type="integer")
     */
    protected $pages;

    /**
     * @var datetime
     *
     * @ORM\Column(name="publication_date", type="datetime")
     */
    protected $publication_date;

    /**
     * @var string
     *
     * @ORM\Column(name="publisher", type="string", length=160)
     */
    protected $publisher;

    /**
     * @return mixed
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param mixed $pages
     *
     * @return $this
     */
    public function setPages($pages)
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublicationDate()
    {
        return $this->publication_date;
    }

    /**
     * @param \DateTime $publication_date
     *
     * @return $this
     */
    public function setPublicationDate($publication_date)
    {
        $this->publication_date = $publication_date;

        return $this;
    }

    /**
     * @return string
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param string $publisher
     *
     * @return $this
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;

        return $this;
    }

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

    /**
     * @return ArrayCollection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param ArrayCollection $categories
     *
     * @return $this
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }


}
