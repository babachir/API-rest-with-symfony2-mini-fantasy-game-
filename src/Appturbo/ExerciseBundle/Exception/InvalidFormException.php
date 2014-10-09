<?php

namespace Appturbo\ExerciseBundle\Exception;

/**
 * Class InvalidFormException
 * @package Appturbo\ExerciseBundle\Exception
 */
class InvalidFormException extends \RuntimeException
{
    /**
     * @var null
     */
    protected $form;

    /**
     * @param string $message
     * @param null $form
     */
    public function __construct($message, $form = null)
    {
        parent::__construct($message);

        $this->form = $form;
    }

    /**
     * @return array|null
     */
    public function getForm()
    {
        return $this->form;
    }
}