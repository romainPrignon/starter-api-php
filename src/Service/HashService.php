<?php
declare(strict_types=1);

namespace App\Service;


class HashService
{
    /**
     * @var string
     */
    private $hash_algo;

    public function __construct (string $hash_algo)
    {
        $this->hash_algo = $hash_algo;
    }

    public function createId(string $content): string
    {
        return \hash($this->hash_algo, $content);
    }
}
