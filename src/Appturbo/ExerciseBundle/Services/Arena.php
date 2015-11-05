<?php
namespace Appturbo\ExerciseBundle\Services;
use Appturbo\ExerciseBundle\Entity\Knight;
use Appturbo\ExerciseBundle\Model\FightInterface;


/**
 * Created by PhpStorm.
 * User: Bachir
 * Date: 05/11/2015
 * Time: 01:14
 */
class Arena
{


    public static function fight(\Appturbo\ExerciseBundle\Entity\FightInterface $fighter1,\Appturbo\ExerciseBundle\Entity\FightInterface $fighter2)
    {

        if($fighter1->calculatePowerLevel()==$fighter2->calculatePowerLevel())
        {
            return 0;
        }
        else if($fighter1->calculatePowerLevel()>$fighter2->calculatePowerLevel())
        {
            return $fighter1;
        }
        else
        {
            return $fighter2;
        }

    }




}