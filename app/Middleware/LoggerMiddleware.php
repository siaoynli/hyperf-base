<?php

declare(strict_types=1);

namespace App\Middleware;


use Hyperf\Logger\LoggerFactory;
use Hyperf\Utils\Context;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;

class LoggerMiddleware implements MiddlewareInterface
{

    protected LoggerInterface $logger;

    public function __construct(LoggerFactory $loggerFactory)
    {
        // 第一个参数对应日志的 name, 第二个参数对应 config/autoload/logger.php 内的 key
        $this->logger = $loggerFactory->get('log', 'daily');
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        Context::set(ServerRequestInterface::class, $request);

        $this->logger->info("打印日志.");
        return $handler->handle($request);
    }
}