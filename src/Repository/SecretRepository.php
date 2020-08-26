<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Secret;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class SecretRepository
{
    public function __construct(AdapterInterface $cache)
    {
        $this->cache = $cache;
    }

    public function findOne(string $id): ?Secret
    {
        $cacheItem = $this->cache->getItem($id);
        return $cacheItem->get();
    }

    public function insertOne(Secret $secret): string
    {
        $id = $secret->getId();

        $cacheItem = $this->cache->getItem($id);

        $cacheItem->set($secret);

        $saved = $this->cache->save($cacheItem);

        if (!$saved) {
            throw new Exception('boom');
        }

        return $id;
    }
}
