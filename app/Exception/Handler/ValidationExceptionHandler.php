<?php

declare(strict_types=1);

namespace App\Exception\Handler;

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class ValidationExceptionHandler extends ExceptionHandler
{
    /**
     * @var StdoutLoggerInterface
     */
    protected StdoutLoggerInterface $logger;

    public function __construct(StdoutLoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(Throwable $throwable, ResponseInterface $response): ResponseInterface
    {
        if ($throwable instanceof ValidationException) {

            $message = $throwable->validator->errors()->first();
            $this->logger->info(sprintf('[表单校验错误] %s', $message));
            // 阻止异常冒泡
            $this->stopPropagation();

            return responseApiMessage($response, $message, $throwable->getCode(), 403);
        }

        return $response;
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof ValidationException;
    }
}

