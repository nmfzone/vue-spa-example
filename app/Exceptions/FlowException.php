<?php

namespace App\Exceptions;

use League\Flysystem\Exception;
use Illuminate\Http\JsonResponse;

class FlowException extends Exception
{
    /**
     * The recommended response to send to the client.
     *
     * @var \Symfony\Component\HttpFoundation\Response|null
     */
    public $response;

    /**
     * Create a new exception instance.
     *
     * @param  array  $data
     * @return void
     */
    public function __construct(array $data)
    {
        parent::__construct('The given data can\'t be processed.');

        $this->response = new JsonResponse($data, 422);
    }

    /**
     * Get the underlying response instance.
     *
     * @return \Symfony\Component\HttpFoundation\Response|null
     */
    public function getResponse()
    {
        return $this->response;
    }
}
