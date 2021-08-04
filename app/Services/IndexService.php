<?php

declare(strict_types=1);

namespace App\Services;

use App\Caches\UserCache;
use Hyperf\Di\Annotation\Inject;


class IndexService
{
    /**
     * @Inject
     * @var UserCache
     */
    private $cache;

    /**
     * @param  int  $id
     * @return array|null
     */
    public function getUser(int $id)
    {
        return $this->cache->getUser($id);
    }

    /**
     * @param  int  $id
     * @return bool|mixed
     */
    public  function  clearCache(int $id){
        return $this->cache->clearUser($id);
    }
}