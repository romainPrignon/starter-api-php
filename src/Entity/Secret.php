<?php
declare(strict_types=1);

namespace App\Entity;

class Secret
{
    private $id;
    private $content;

    public function getId(): string
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}
