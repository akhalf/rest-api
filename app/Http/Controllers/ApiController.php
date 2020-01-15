<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    private $status_code = 200;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->status_code;
    }

    /**
     * @param mixed $status_code
     * @return ApiController
     */
    protected function setStatusCode($status_code)
    {
        $this->status_code = $status_code;
        return $this;
    }

    public function respondNotFound($message = 'Not found!')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    public function respondInvalidRequest($message = 'Invalid request!')
    {
        return $this->setStatusCode(400)->respondWithError($message);
    }

    public function respondInternalError($message = 'Internal Error!')
    {
        return $this->setStatusCode(502)->respondWithError($message);
    }

    public function respondCrated($message = 'lesson created')
    {
        return $this->setStatusCode(401)->respondWithSuccess($message);
    }

    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message
            ]
        ]);
    }

    public function respondWithSuccess($message)
    {
        return $this->respond([
            'success' => [
                'message' => $message
            ]
        ]);
    }
}
