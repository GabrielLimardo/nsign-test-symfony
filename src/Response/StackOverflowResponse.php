<?php

namespace App\Response;

class StackOverflowResponse
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getItems(): array
    {
        return $this->data['items'] ?? [];
    }

    public function getFirstItemOwnerDisplayName(): ?string
    {
        $firstItem = $this->getItems()[0] ?? null;
        return $firstItem['owner']['display_name'] ?? null;
    }

    public function getFirstItemScore(): ?int
    {
        $firstItem = $this->getItems()[0] ?? null;
        return $firstItem['score'] ?? null;
    }

    public function getFirstItemCreationDate(): ?int
    {
        $firstItem = $this->getItems()[0] ?? null;
        return $firstItem['creation_date'] ?? null;
    }

    public function getFirstItemPostType(): ?string
    {
        $firstItem = $this->getItems()[0] ?? null;
        return $firstItem['post_type'] ?? null;
    }

    public function getFirstItemLink(): ?string
    {
        $firstItem = $this->getItems()[0] ?? null;
        return $firstItem['link'] ?? null;
    }
}
