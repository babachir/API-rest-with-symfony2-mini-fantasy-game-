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
            return (new Response())->setStatusCode(404,Response::$statusTexts[404]);
        }
        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($knights, 'json');
        return (new Response($reports))->setStatusCode(200,Response::$statusTexts[200]);
    }

    public function getKnightAction($id)
    {
        /*$arena = $this->container->get('appturbo_exercise.services');*/

        $knights = $this->getDoctrine()->getRepository("AppturboExerciseBundle:Knight")->findById($id);
        if(empty($knights))
        {
            return (new Response())->setStatusCode(404,Response::$statusTexts[404]);
        }
        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($knights, 'json');
        return  (new Response($reports))->setStatusCode(200,Response::$statusTexts[200]);


    }

    public function getKnightvsknightAction($id,$id2)
    {
        $arena = $this->container->get('appturbo_exercise.services');
        $knights = $this->getDoctrine()->getRepository("AppturboExerciseBundle:Knight")->findById($id);
        $knights2 = $this->getDoctrine()->getRepository("AppturboExerciseBundle:Knight")->findById($id2);

        if(empty($knights) || empty($knights2))
        {
            return (new Response())->setStatusCode(404,Response::$statusTexts[404]);
        }

        $resultat = $arena->fight($knights[0],$knights2[0]);




        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($resultat, 'json');
        return (new Response($reports))->setStatusCode(200,Response::$statusTexts[404]);


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
                    return (new Response())->setStatusCode(201,Response::$statusTexts[201]);


                } else {
                    return (new Response())->setStatusCode(400,Response::$statusTexts[400]);
                }
            } else {
                return (new Response())->setStatusCode(400,Response::$statusTexts[400]);;
            }
            $serializer = $this->container->get('serializer');


            $reports = $serializer->serialize($jsonReturned, 'json');
            return new Response($reports);

        }


    }


}
