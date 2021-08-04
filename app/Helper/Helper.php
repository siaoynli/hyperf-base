<?php

declare(strict_types=1);


use Psr\Http\Message\ResponseInterface;

if (!function_exists("ping")) {
    function ping(): string
    {
        return "pong";
    }
}

if (!function_exists("responseApiMessage")) {
    function responseApiMessage(
        ResponseInterface $response,
        string $message,
        int $code = 1,
        int $httpStatus = 200
    ): ResponseInterface {
        return $response->json([
            'code' => $code,
            'message' => $message,
        ])->withStatus($httpStatus);
    }
}


if (!function_exists("responseApiData")) {
    function responseApiData(
        ResponseInterface $response,
        array $data,
        int $code = 1,
        int $httpStatus = 200
    ): ResponseInterface {

        return $response->json([
            'code' => $code,
            'data' => $data,
        ])->withStatus($httpStatus);
    }
}