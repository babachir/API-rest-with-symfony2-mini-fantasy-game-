<?php

namespace Appturbo\ExerciseBundle\Model;

/**
 * Interface FightInterface
 *
 * Represents a Fighter.
 *
 * Each Fighter is ultimately identified by an ID
 * Each Fighter has a Power level depending of its stats
 *
 * @package Appturbo\ExerciseBundle\Model
 */
interface FightInterface
{
    /**
     * Get the ID
     *
     * @return int
     */
    public function getId();


    /**
     * Calculate the Power Level of the Fighter
     *
     * @return int
     */
    public function calculatePowerLevel();
}