<?php

namespace App\Service;

class Product
{
    private int $id;
    private string $name;
    private int $price;
    private string $category;

    /**
     * @param int $id
     * @param string $name
     * @param int $price
     * @param string $category
     */
    public function __construct(int $id, string $name, int $price, string $category)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Product
     */
    public function setId(int $id): Product
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Product
     */
    public function setName(string $name): Product
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     * @return Product
     */
    public function setPrice(int $price): Product
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     * @return Product
     */
    public function setCategory(string $category): Product
    {
        $this->category = $category;

        return $this;
    }
}

class ProductService
{
    private array $productList = [];

    public function __construct(){
        $this->productList = [
            new Product(1, "Clavier", 5, "input"),
            new Product(2, "Souris", 7, "input"),
            new Product(3, "Disque dur 500 Go", 50, "storage"),
            new Product(4, "Scanner", 200, "input"),
            new Product(5, "Imprimante laser", 200, "output"),
            new Product(6, "Ecran 22 pouces", 300, "output"),
            new Product(7, "Casque bluetooth", 150, "output"),
        ];
    }

    /**
     * @return string
     */
    public function getServiceName(): string{
        return "ProductService";
    }

    /**
     * @param int $id
     * @return Product|null
     */
    public function getOneById(int $id): Product|null{
        $result = array_filter(
            $this->productList,
            function ($item) use ($id) {
                return $item->getId() === $id;
            }
        );

        if (count($result) > 0) {
            return array_shift($result);
        }

        return null;
    }

    /**
     * @return Product[]
     */
    public function getAll(): array{
        return $this->productList;
    }

    /**
     * @return Product[]
     */
    public function getAllByCategory(string $category): array{
        return array_filter($this->productList, function ($item) use ($category) {
            return $item->getCategory() === $category;
        });
    }

    /**
     * @return array
     */
    public function getDistinctCategories(): array{
        $categories = array_map(function($item){
            return $item->getCategory();
        },$this->productList);
        return array_unique($categories);
    }
}