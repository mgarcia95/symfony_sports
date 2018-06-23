<?php

namespace App\Controller;
use App\Entity\Event;
use App\Entity\User;
use App\Entity\Ticket;
use App\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class EventController extends Controller
{
  /**
   * @Route("/event/create", name="create_event")
   */
   public function registerEvent(Request $request)
   {
      $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
      $event = new Event();
      $form = $this->createForm(EventType::class, $event);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
         $event = $form->getData();
         $user = $this->getUser();
         $event->setOwner($user);
         $em = $this->getDoctrine()->getManager();
         $em->persist($event);
         $em->flush();
         return $this->redirectToRoute('view_events');
      }
      return $this->render('create.html.twig', array(
         'form' => $form->createView()
      ));
   }
      /**
      * @Route("/event/all", name="view_events")
      */
      public function eventsView()
      {
         $number = 10;
         $events = $this->getDoctrine()
            ->getRepository(Event::class)
            ->findLastEvents($number);
         if (!$events) {
            $events = NULL;
         }
         return $this->render('events.html.twig', array(
            'events' => $events
         ));
      }
     /**
      * @Route("/event/{id}", name="view_event", requirements={"id"="\d+"})
      */
      public function eventView($id)
      {
         $event = $this->getDoctrine()
            ->getRepository(Event::class)
            ->find($id);
         if (!$event) {
            $event = NULL;
         }
         $tickets = $this->getDoctrine()
            ->getRepository(Ticket::class)
            ->findBy(
               ['event' => $event]
            );
         if (!$tickets) {
            $tickets = NULL;
         }
         return $this->render('event.html.twig', array(
            'event' => $event,
            'tickets' => $tickets
         ));
      }

      /**
      * @Route("/user/events", name="myevents")
      */
      public function myeventsView()
      {
         $number = 10;
         $user = $this->getUser();
         $events = $this->getDoctrine()
            ->getRepository(Event::class)
            ->findLastEvents($number);
         if (!$events) {
            $events = NULL;
         }
         return $this->render('myevents.html.twig', array(
            'events' => $events, 'user' => $user
         ));
      }

}
