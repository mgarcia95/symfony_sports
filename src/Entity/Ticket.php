<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\User;
use App\Entity\Event;
use App\Entity\Ticket;
/**
 * @ORM\Entity(repositoryClass="App\Repository\TicketRepository")
 */
class Ticket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="tickets")
     * @ORM\JoinColumn(nullable=true)
     */
     private $owner;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="tickets")
     * @ORM\JoinColumn(nullable=true)
     */
     private $event;
    /**
      * @Assert\NotBlank()
      * @Assert\DateTime()
      * @ORM\Column(type="datetime")
      */
      private $created;
    /**
     * @ORM\Column(type="boolean")
     */
     private $state;
      public function __construct()
       {
         $this->setCreated(new \DateTime('now'));
         $this->setState(true);
       }
       public function getId()
       {
           return $this->id;
       }
       public function getOwner(): User
       {
           return $this->owner;
       }
       public function setOwner(User $owner)
       {
           $this->owner = $owner;
       }
       public function getEvent(): Event
       {
            return $this->event;
       }
      public function setEvent(Event $event)
      {
            $this->event = $event;
      }
       public function getCreated()
       {
           return $this->created;
       }
       public function setCreated($created)
       {
           $this->created = $created;
       }
      public function getState()
      {
          return $this->state;
      }
      public function setState($state)
      {
          $this->state = $state;
      }
}
