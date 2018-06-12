<?php
  namespace App\Controller;

  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
  use Symfony\Bundle\FrameworkBundle\Controller\Controller;

  class EventController extends Controller {
    /**
      * @Route("/",name="create_event")
      */
    public function admin() {
      return $this->render('index.html.twig');
    }
  }
 ?>
