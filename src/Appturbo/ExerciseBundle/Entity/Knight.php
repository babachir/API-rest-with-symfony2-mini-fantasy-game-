<?php

namespace Appturbo\ExerciseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Knight
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Knight extends  Human implements FightInterface
{


    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="strength", type="integer")
     */
    private $strength;

    /**
     * @var integer
     *
     * @ORM\Column(name="weaponPower", type="integer")
     */
    private $weaponPower;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get weaponPower
     *
     * @return integer
     */
    public function getWeaponPower()
    {
        return $this->weaponPower;
    }

    /**
     * Set weaponPower
     *
     * @param integer $weaponPower
     * @return Knight
     */
    public function setWeaponPower($weaponPower)
    {
        $this->weaponPower = $weaponPower;

        return $this;
    }


    /**
     * Set strength
     *
     * @param integer $strength
     * @return Knight
     */
    public function setStrength($strength)
    {
        $this->strength = $strength;
    
        return $this;
    }


    /**
     * Get strength
     *
     * @return integer
     */
    public function getStrength()
    {
        return $this->strength;
    }

    public function calculatePowerLevel()
    {
        return $this->getStrength()+$this->getWeaponPower();
    }

}
