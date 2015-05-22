<?php


namespace BookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Contain a Member of the library
 *
 * @package BookBundle\Entity
 * @author  Daniela Cruceanu <daniela.cruceanu@cegeka.com>
 *
 * @ORM\Entity(repositoryClass="BookBundle\Repository\MemberRepository")
 * @ORM\Table(name="member")
 * @ORM\HasLifecycleCallbacks()
 */
class Member extends AbstractEntity
{

    /**
     * @var integer
     *
     * @ORM\Column(name="national_number", type="integer")
     */
    protected $nationalNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth_date", type="datetime")
     */
    protected $birthDate;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length = 160)
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length = 160)
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length = 16, nullable = true)
     */
    protected $street;

    /**
     * @var integer
     *
     * @ORM\Column(name="postal_code", type="integer", nullable = true)
     */
    protected $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length = 160, nullable = true)
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length = 160, nullable = true)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length = 50, nullable = true)
     */
    protected $phone;

    /**
     * @return int
     */
    public function getNationalNumber()
    {
        return $this->nationalNumber;
    }

    /**
     * @param int $nationalNumber
     *
     * @return $this
     */
    public function setNationalNumber($nationalNumber)
    {
        $this->nationalNumber = $nationalNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     *
     * @return $this
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     *
     * @return $this
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return int
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param int $postalCode
     *
     * @return $this
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }


}
