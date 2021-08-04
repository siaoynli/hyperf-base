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

namespace App\Controller;


use App\Model\User;
use Hyperf\Di\Annotation\Inject;
use App\Services\IndexService;
use Hyperf\HttpMessage\Exception\NotFoundHttpException;
use Hyperf\HttpServer\Contract\RequestInterface;
use Psr\Http\Message\ResponseInterface;


class UserController extends AbstractController
{

    /**
     * @Inject
     * @var IndexService
     */
    private IndexService $service;

    /**
     * @param  int  $id
     * @return ResponseInterface
     */
    public function index(int $id): ResponseInterface
    {
        $user = $this->service->getUser($id);
        if (!$user) {
            throw new NotFoundHttpException();
        }
        return responseApiData($this->response, [$user]);
    }

    /**
     * @param  RequestInterface  $request
     * @return ResponseInterface
     */
    public function update(RequestInterface $request): ResponseInterface
    {

        $user_name=$request->input("user_name","lee");

        if($user_name) {
            $user= User::where("id",1)->first();
            $user->user_name=$user_name;
            $user->save();
        }

        return responseApiMessage($this->response,"更新成功");
    }
}
