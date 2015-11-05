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
                    $jsonReturned = array("success" => "true", "message" => "the knight was  successfuly created");


                } else {
                    $jsonReturned = array("success" => "false", "message" => "the name must be a string and strength or weaponPower must be a int");
                }
            } else {
                $jsonReturned = array("success" => "false", "message" => "name, strength or weaponPower can't be null");
            }
            $serializer = $this->container->get('serializer');


            $reports = $serializer->serialize($jsonReturned, 'json');
            return new Response($reports);

        }


    }


}
