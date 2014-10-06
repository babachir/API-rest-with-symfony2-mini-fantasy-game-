<?php

namespace Appturbo\ExerciseBundle\Handler;

use FOS\RestBundle\View\View;

/**
 * Interface HandlerInterface
 *
 * Must be implemented in the handlers.
 *
 * @package Appturbo\ExerciseBundle\Handler
 */
interface HandlerInterface
{
    /**
     * Get a resource
     *
     * @param int $id
     * @return Object
     */
    public function get($id);

    /**
     * Get a collection of resources
     *
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function all($limit, $offset);

    /**
     * Register a resource
     * @param array $parameters
     * @return array|View|null
     */
    public function post(array $parameters);
}