<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\User;
use App\Entity\Event;
use App\Entity\Ticket;
/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="events")
     * @ORM\JoinColumn(nullable=true)
     */
     private $owner;
    /**
      * @Assert\NotBlank()
      * @Assert\DateTime()
      * @ORM\Column(type="datetime")
      */
    private $date;
    /**
      * @Assert\NotBlank()
      * @Assert\DateTime()
      * @ORM\Column(type="datetime")
      */
      private $created;
      /**
         * @ORM\Column(type="string", length=255)
         * @Assert\NotBlank()
         */
     private $place;
     /**
        * @ORM\Column(type="string", length=255)
        * @Assert\NotBlank()
        */
     private $sport;
     /**
     * @ORM\Column(type="integer")
     */
     private $maxslot;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ticket", mappedBy="event")
     */
     private $tickets;
      /**
       * @ORM\Column(type="string", length=200)
       */
       private $comments;
     public function __construct()
      {
        $this->setCreated(new \DateTime('now'));
        $this->tickets = new ArrayCollection();
      }
    /**
     * @return Collection|Ticket[]
     */
     public function getTickets()
     {
          return $this->tickets;
     }
    public function getOwner(): User
    {
        return $this->owner;
    }
    public function setOwner(User $owner)
    {
        $this->owner = $owner;
    }
    public function getSport()
    {
      return $this->sport;
    }
    public function setSport($sport)
    {
        $this->sport = $sport;
    }
    public function getmaxslot()
    {
      return $this->maxslot;
    }
    public function setmaxslot($maxslot)
    {
        $this->maxslot = $maxslot;
    }
    public function getPlace()
    {
      return $this->place;
    }
    public function setPlace($place)
    {
        $this->place = $place;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function setDate($date)
    {
        $this->date = $date;
    }
    public function getCreated()
    {
        return $this->created;
    }
    public function setCreated($created)
    {
        $this->created = $created;
    }
    public function getComments()
    {
        return $this->comments;
    }
    public function setComments($comments)
    {
        $this->comments = $comments;
        return $this;
    }
}
