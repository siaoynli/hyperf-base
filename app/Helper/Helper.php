<?php

declare(strict_types=1);

use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;

if (!function_exists("ping")) {
    function ping(): string
    {
        return "pong";
    }
}

if (!function_exists("responseApiException")) {
    function responseApiException(string $message, int $code, ResponseInterface $response,int $httpStatus=200): ResponseInterface
    {
        $data = json_encode([
            'code' => $code,
            'message' => $message,
        ], JSON_UNESCAPED_UNICODE);

        return $response->withStatus($httpStatus)->withBody(new SwooleStream($data));
    }
}