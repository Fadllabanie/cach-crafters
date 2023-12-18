<?php

namespace App\Traits;

trait ApiResponder
{

    protected $statusCode = 200;
    protected $success = 1;
    protected $failure = 0;

    /**
     * Getter for statusCode
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
    /**
     * Getter for statusCode
     *
     * @return int
     */
    public function getSuccess()
    {
        return (bool) $this->success;
    }
    /**
     * Getter for statusCode
     *
     * @return int
     */
    public function getFailure()
    {
        return (bool) $this->failure;
    }

    /**
     * Setter for statusCode
     *
     * @param int $statusCode Value to set
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    protected function respond($data, $headers = [])
    {
        return response()->json($data, $this->statusCode, $headers);
    }

    public function successStatus($message = 'Success Request')
    {
        return $this->respond([
            'status' => $this->getSuccess(),
            'message' => $message,
        ]);
    }
    public function errorStatus($message = 'Failure Request')
    {
        return $this->respond([
            'status' => 0,
            'message' => $message,
        ]);
    }

    public function respondNoContent($message = 'No content')
    {
        return $this->setStatusCode(204)
            ->respond([
                'status' => $this->getFailure(),
                'message' => $message,
            ]);
    }

    public function respondWithItem($item, $message = 'Success Request')
    {
        return $this->respond([
            'status' => $this->getSuccess(),
            'message' => $message,
            'data' => $item,

        ]);
    }
    public function respondWithItemName($item_name, $item, $message = 'Success Request')
    {
        return $this->respond([
            'status' => $this->getSuccess(),
            'message' => $message,
            $item_name => $item,
        ]);
    }


    public function respondWithCollection($collection, $message = 'Success Request')
    {
        return $this->respond([
            'status' => $this->getSuccess(),
            'message' => $message,
            'data' => $collection,
        ]);
    }


    public function respondWithMessage($message)
    {
        return $this->setStatusCode(200)
            ->respond([
                'status' => $this->getSuccess(),
                'message' => $message
            ]);
    }



    public function respondCreated($data,$message = 'Resource created successfully')
    {
        return $this->setStatusCode(201)
            ->respond([
                'status' => $this->getSuccess(),
                'message' => $message,
                'data' => $data,

            ]);
    }

    protected function respondWithError($message)
    {
        if (!is_array($message)) {
            $message = [
                'body' => [$message]
            ];
        }

        return $this->respond([
            'http_code' => $this->getStatusCode(),
            'error' => [
                'message' => $message,
            ]
        ]);
    }

    /**
     * Generates a Response with a 403 HTTP header and a given message.
     *
     * @return Response
     */
    public function errorForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(403)
            ->respondWithError($message);
    }

    /**
     * Generates a Response with a 500 HTTP header and a given message.
     *
     * @return Response
     */
    public function errorInternalError($message = 'Internal Error')
    {
        return $this->setStatusCode(500)
            ->respondWithError($message);
    }

    /**
     * Generates a Response with a 404 HTTP header and a given message.
     *
     * @return Response
     */
    public function errorNotFound($message = 'Resource Not Found')
    {
        return $this->setStatusCode(404)
            ->respond([
                'status' => $this->getFailure(),
                'message' => $message,
            ]);
    }

    /**
     * Generates a Response with a 401 HTTP header and a given message.
     *
     * @return Response
     */
    public function errorUnauthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(401)
            ->respondWithError($message);
    }

    /**
     * Generates a Response with a 400 HTTP header and a given message.
     *
     * @return Response
     */
    public function errorWrongArgs($message)
    {
        return $this->setStatusCode(400)
            ->respondWithError($message);
    }
}
