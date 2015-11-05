<?php

namespace Appturbo\ExerciseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppturboExerciseBundle:Test:index.html.twig', array('name' => test));
    }



}
