<?php
declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Cache\Adapter\AdapterInterface;

class CryptoService
{
    /**
     * @var string
     */
    private $encrypt_password;

    /**
     * @var AdapterInterface
     */
    private $cache;

    public function __construct (string $encrypt_password, AdapterInterface $cache)
    {
        $this->cache = $cache;
        $this->encrypt_password = $encrypt_password;

        $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

        $nonceCache = $this->cache->getItem('nonce');

        if (!$nonceCache->isHit()) {
            $nonceCache->set($nonce);
            $this->cache->save($nonceCache);
        }
    }

    public function encrypt(string $content): string
    {
        $nonceCache = $this->cache->getItem('nonce');
        $nonce = $nonceCache->get();

        return sodium_crypto_secretbox($content, $nonce, $this->encrypt_password);
    }

    public function decrypt(string $content): string
    {
        $nonceCache = $this->cache->getItem('nonce');
        $nonce = $nonceCache->get();

        return sodium_crypto_secretbox_open($content, $nonce, $this->encrypt_password);
    }
}
