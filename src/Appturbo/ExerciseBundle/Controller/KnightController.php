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
        if(empty($knights))
        {
            $knights = array("status"=>"404");
        }
        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($knights, 'json');
        return new Response($reports);


    }

    public function getKnightAction($id)
    {
        /*$arena = $this->container->get('appturbo_exercise.services');*/

        $knights = $this->getDoctrine()->getRepository("AppturboExerciseBundle:Knight")->findById($id);
        if(empty($knights))
        {
            $knights = array("status"=>"404");
        }
        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($knights, 'json');
        return new Response($reports);


    }

    public function getKnightvsknightAction($id,$id2)
    {
        $arena = $this->container->get('appturbo_exercise.services');
        $knights = $this->getDoctrine()->getRepository("AppturboExerciseBundle:Knight")->findById($id);
        $knights2 = $this->getDoctrine()->getRepository("AppturboExerciseBundle:Knight")->findById($id2);

        if(empty($knights) || empty($knights2))
        {
            $resultat = array("status"=>"404");
        }

        $resultat = $arena->fight($knights[0],$knights2[0]);

    


        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($resultat, 'json');
        return new Response($reports);


    }

    public function postKnightAction()
    {
        /*$arena = $this->container->get('appturbo_exercise.services');*/
        $request = $this->get('request');


        if ($request->getMethod() == 'POST') {

            $knight = new Knight();


            $AllRequest = $request->request->all();
            /*to validate the post value*/
            if ($AllRequest['name'] != "" && isset($AllRequest['name']) && isset($AllRequest['name']) && isset($AllRequest['weaponPower'])) {
                $name = $AllRequest['name'];
                $strength = $AllRequest['strength'];
                $weaponPower = $AllRequest['weaponPower'];

                /*if name is a string and if strength and power is a int*/
                if (preg_match("/^[a-zאהגיטךכןמצפשüû\s]*$/i", $name) && preg_match("/^([0-9]+)$/", $strength) && preg_match("/^([0-9]+)$/", $weaponPower)) {
                    $knight = new Knight();
                    $knight->setName($name);
                    $knight->setStrength($strength);
                    $knight->setWeaponPower($weaponPower);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($knight);
                    $em->flush();
                    $jsonReturned = array("status"=> "200");


                } else {
                    $jsonReturned = array("status" => "400", "message" => "the name must be a string and strength or weaponPower must be a int");
                }
            } else {
                $jsonReturned = array("success" => "400", "message" => "name, strength or weaponPower can't be null");
            }
            $serializer = $this->container->get('serializer');


            $reports = $serializer->serialize($jsonReturned, 'json');
            return new Response($reports);

        }


    }


}
