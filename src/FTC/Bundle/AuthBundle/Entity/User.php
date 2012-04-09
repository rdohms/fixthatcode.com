<?php

namespace FTC\Bundle\AuthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as FOSUSer;
/**
 * FTC\Bundle\AuthBundle\Entity\User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FTC\Bundle\AuthBundle\Entity\UserRepository")
 */
class User extends FOSUser
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $fullname
     *
     * @ORM\Column(name="fullname", type="string", length=255)
     */
    protected $fullname;

    /**
     * @var string $bio
     *
     * @ORM\Column(name="bio", type="text")
     */
    protected $bio;

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
     * Set fullname
     *
     * @param string $fullname
     * @return User
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
        return $this;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * @param string $bio
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
    }

    /**
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }
}