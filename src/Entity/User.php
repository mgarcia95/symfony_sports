<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="array")
     */
    private $roles;
    /**
      * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="owner")
      */
    private $events;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ticket", mappedBy="owner")
     */
     private $tickets;

    public function __construct() {
        $roles = array('ROLE_USER');
        $this->setRoles($roles);
        $this->owner = new ArrayCollection();
        $this->tickets = new ArrayCollection();
    }

    // other properties and methods
    /**
     * @return Collection|Ticket[]
     */
     public function getTickets()
     {
         return $this->tickets;
     }
    /**
     * @return Collection|Event[]
     */
      public function getEvents()
      {
          return $this->events;
      }
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getSalt()
    {
        // The bcrypt and argon2i algorithms don't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    public function getRoles()
    {
        $tmpRoles = $this->roles;
        if (in_array('ROLE_USER', $tmpRoles) === false) {
            $tmpRoles[] = 'ROLE_USER';
        }
        return $tmpRoles;
      }
      public function setRoles($roles)
        {
            $this->roles = $roles;
        }

    public function eraseCredentials()
    {
    }
}
