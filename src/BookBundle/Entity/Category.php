<?php


namespace BookBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * The categories of the books
 *
 * @author Daniela Cruceanu
 *
 * @ORM\Entity(repositoryClass="BookBundle\Repository\CategoryRepository")
 * @ORM\Table(name="category")
 * @ORM\HasLifecycleCallbacks()
 */
class Category extends AbstractEntity
{

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Category", mappedBy="Book")
     */
    protected $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length = 160)
     */
    protected $name;

    /**
     * @return ArrayCollection
     */
    public function getBooks()
    {
        return $this->books;
    }

    /**
     * @param ArrayCollection $books
     *
     * @return $this
     */
    public function setBooks($books)
    {
        $this->books = $books;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }


}
