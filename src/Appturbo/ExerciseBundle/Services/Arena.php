<?php
namespace Appturbo\ExerciseBundle\Services;
use Appturbo\ExerciseBundle\Entity\Knight;


/**
 * Created by PhpStorm.
 * User: Bachir
 * Date: 05/11/2015
 * Time: 01:14
 */
class Arena
{
private $knight1;
private $knight2;

    /**
     * @param mixed $knight1
     */
    public function setKnight1($knight1)
    {
        $this->knight1 = $knight1;
    }

    /**
     * @param mixed $knight2
     */
    public function setKnight2($knight2)
    {
        $this->knight2 = $knight2;
    }





}