<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;


class BaseApiController extends FOSRestController
{
    const SUCCESS_CODE = "SUCCESS";
    const ERROR_CODE = "ERROR";
    const DEFAULT_SORT_ORDER = "ASC";

    /** @var array $errors */
    private $errors = [];

    /**
     * Create response object
     *
     * @param string $result
     * @param int $code
     * @param mixed $details
     * @param array $headers
     *
     * @return Response
     */
    private function response(string $result, int $code, $details = null, array $headers = [])
    {
        return new Response(json_encode([
            "result" => $result,
            "details" => $details
        ]), $code);
    }

    /**
     * Set error
     *
     * @param string $code
     * @param null $details
     *
     * @return $this
     */
    public function setError(string $code, $details = null)
    {
        $this->errors[] = [
            "code" => $code,
            "details" => $details
        ];

        return $this;
    }

    /**
     * Check for errors
     *
     * @return bool
     */
    public function hasErrors()
    {
        return (bool) count($this->errors);
    }

    /**
     * Create error response
     *
     * @param int $code
     * @param array $headers
     *
     * @return Response
     */
    public function errorResponse(int $code, array $headers = [])
    {
        return $this->response(self::ERROR_CODE, $code, $this->errors, $headers);
    }

    /**
     * Create success response
     *
     * @param int $code
     * @param null $details
     * @param array $headers
     *
     * @return Response
     */
    public function successResponse(int $code, $details = null, array $headers = [])
    {
        return $this->response(self::SUCCESS_CODE, $code, $details, $headers);
    }
}