<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Exception\Handler;

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Exception\NotFoundHttpException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class ApiExceptionHandler extends ExceptionHandler
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
        if ($throwable instanceof NotFoundHttpException) {
            $this->logger->info(sprintf('[路由错误] %s File: %s Line:%s', $throwable->getMessage(),
                $throwable->getFile(), $throwable->getLine()));
            // 阻止异常冒泡
            $this->stopPropagation();
            return responseApiException($throwable->getMessage(), $throwable->getCode(), $response, 404);
        }
        return $response;
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
