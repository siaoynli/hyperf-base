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


use App\Model\Article;
use Hyperf\HttpServer\Request;
use Hyperf\Utils\Str;
use Psr\Http\Message\ResponseInterface;

class ArticleController extends AbstractController
{
    /**
     * @param  Request  $request
     * @return ResponseInterface
     */
    public function index(Request $request): ResponseInterface
    {
        $query = $request->input("query", "");
        if ($query) {
            $result = Article::search($query)->get()->toArray();
        } else {
            $result = Article::all()->toArray();
        }

        return responseApiData($this->response, $result);
    }

    public function create(Request $request): ResponseInterface
    {
        $title = $request->input("title", Str::random(20));
        $content = $request->input("content", Str::random(100));

        $data["title"] = $title;
        $data["content"] = $content;

        Article::create($data);

        return responseApiMessage($this->response, "添加成功");
    }
}
