<?php

declare(strict_types=1);

namespace App\Caches;


use App\Model\User;
use Hyperf\Cache\Annotation\Cacheable;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Cache\Annotation\CacheEvict;

class UserCache
{

    /**
     * @Cacheable(prefix="user",ttl=900,value="_#{id}", listener="user-update")
     * @param  int  $id
     * @return array|null
     */
    public function getUser(int $id)
    {
        $user = User::where("id", $id)->first();
        if ($user) {
            return $user->toArray();
        }

        return null;
    }


    /**
     * @CacheEvict(prefix="user", value="_#{id}")
     */
    public function clearUser(int $id)
    {
        return true;
    }




}