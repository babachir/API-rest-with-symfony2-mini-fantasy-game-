<?php

namespace Appturbo\ExerciseBundle\Controller;

use Appturbo\ExerciseBundle\Entity\Knight;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class KnightController extends Controller
{
    public function getKnightsAction()
    {
        /*$arena = $this->container->get('appturbo_exercise.services');*/
        $knights = $this->getDoctrine()->getRepository("AppturboExerciseBundle:Knight")->findAll();

        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($knights, 'json');
        return new Response($reports);


    }

    public function getKnightAction($id)
    {
        /*$arena = $this->container->get('appturbo_exercise.services');*/
        $knights = $this->getDoctrine()->getRepository("AppturboExerciseBundle:Knight")->findById($id);

        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($knights, 'json');
        return new Response($reports);


    }

    public function postKnightAction()
    {
        /*$arena = $this->container->get('appturbo_exercise.services');*/
        $request = $this->get('request');


        if ($request->getMethod() == 'POST') {

            $knight = new Knight();


            $AllRequest = $request->request->all();
            $name = $AllRequest['name' ];
           if(preg_match("/^[a-zאהגיטךכןמצפשüû\s]*$/i", $name))
           {
               var_dump(preg_match("/^[a-zאהגיטךכןמצפשüû\s]*$/i", $name));
                exit();
           }

        }




    }






}
