<?php

namespace App\Services;

use App\Contracts\CounterContract;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Cache\Factory as Cache;
use Illuminate\Contracts\Session\Session;

class Counter implements CounterContract
{
    private $cache;
    private $session;
    private $timeout;
    private $supportsTags;

    public function __construct(Cache $cache,Session $session,int $timeout)
    {
        $this->cache = $cache;
        $this->session = $session;
        $this->timeout = $timeout;
        $this->supportsTags = method_exists($cache, 'tags');
    }

    public function increament(string $key,array $tags = null): int
    {
        $sessionId = $this->session->getId();
        $counterKey = "{$key}-counter";
        $userKey = "{$key}-users";

        $cache = $this->supportsTags && null != $tags ? $this->cache->tags($tags) : $this->cache;

        $users = $cache->get($userKey, []);
        $usersUpdate = [];
        $diffrence = 0;
        $now = now();
        foreach ($users as $session => $lastTime) {
            if ($now->diffInMinutes($lastTime) >= 1) {
                $diffrence--;
            } else {
                $usersUpdate[$session] = $lastTime;
            }
        }

        if (!array_key_exists($sessionId, $users) || $now->diffInMinutes($users[$sessionId]) >= $this->timeout) {
            $diffrence++;
        }

        $usersUpdate[$sessionId] = $now;
        $cache->forever($userKey, $usersUpdate);

        if (!$cache->has($counterKey)) {
            $cache->forever($counterKey, 1);
        } else {
            $cache->increment($counterKey, $diffrence);
        }

        return $cache->get($counterKey);
    }
}
