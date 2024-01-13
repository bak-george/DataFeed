<?php

namespace entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('products')]
class Product
{
    #[Id]
    #[Column, GeneratedValue]
    private int $id;
    #[Column(name: 'entity_id')]
    private int $entityId;
    #[Column(name: 'category_name')]
    private string $categoryName;
    #[Column]
    private string $sku;
    #[Column]
    private string $name;
    #[Column(type: Types::TEXT)]
    private string $description;
    #[Column(type: Types::TEXT)]
    private string $shortdesc;
    #[Column(type: Types::DECIMAL, precision: 10, scale: 4)]
    private float $price;
    #[Column]
    private string $link;
    #[Column]
    private string $image;
    #[Column]
    private string $brand;
    #[Column]
    private int $rating;
    #[Column(name: 'caffeine_type')]
    private string $caffeineType;
    #[Column]
    private int $count;
    #[Column]
    private string $flavored;
    #[Column]
    private string $seasonal;
    #[Column]
    private string $instock;
    #[Column]
    private int $facebook;
    #[Column(name: 'is_k_cup')]
    private int $isKcup;
    #[Column(name: 'file_name')]
    private string $fileName;

    public function getId(): int
    {
        return $this->id;
    }

    public function getEntityId(): int
    {
        return $this->entityId;
    }

    public function setEntityId(int $entityId): void
    {
        $this->entityId = $entityId;
    }

    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): void
    {
        $this->categoryName = $categoryName;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getField(): string
    {
        return $this->field;
    }

    public function setField(string $field): void
    {
        $this->field = $field;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getShortdesc(): string
    {
        return $this->shortdesc;
    }

    public function setShortdesc(string $shortdesc): void
    {
        $this->shortdesc = $shortdesc;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    public function getCaffeineType(): string
    {
        return $this->caffeineType;
    }

    public function setCaffeineType(string $caffeineType): void
    {
        $this->caffeineType = $caffeineType;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): void
    {
        $this->count = $count;
    }

    public function getFlavored(): string
    {
        return $this->flavored;
    }

    public function setFlavored(string $flavored): void
    {
        $this->flavored = $flavored;
    }

    public function getSeasonal(): string
    {
        return $this->seasonal;
    }

    public function setSeasonal(string $seasonal): void
    {
        $this->seasonal = $seasonal;
    }

    public function getInstock(): string
    {
        return $this->instock;
    }

    public function setInstock(string $instock): void
    {
        $this->instock = $instock;
    }

    public function getFacebook(): int
    {
        return $this->facebook;
    }

    public function setFacebook(int $facebook): void
    {
        $this->facebook = $facebook;
    }

    public function getIsKcup(): int
    {
        return $this->isKcup;
    }

    public function setIsKcup(int $isKcup): void
    {
        $this->isKcup = $isKcup;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): void
    {
        $this->fileName = $fileName;
    }
}