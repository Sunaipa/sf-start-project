<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Service\ProductService;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product")   // Prefix toute les routes de cette classe
 *
 */
class ProductController extends AbstractController {

    private ProductRepository $repository;

    /**
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @Route("/{id<\d+>}", name="product_details")
     * @param int $id
     * @return Response
     */
    public function details(int $id){
        return $this->render("product/details.html.twig", [
            "product" => $this->repository->findOneById($id)
        ]);
    }

    /**
     * @Route("/", name="product_list")
     * @return Response
     */
    public function list(LoggerInterface $logger): Response{

        $logger->debug("coucou(tu veux voir ma b...), on est passé dans list");
        //dump($this->productService->getAll());

        return $this->render("product/list.html.twig", [
            "productList" => $this->repository->findAll(),
            "title" => "liste de tous les produits",
            "categoryList" => $this->repository->getDisctinctCategories(),
            "currentCategory" => null
        ]);
    }

    /**
     * @Route("/by-category/{category}",
     *         name="product_by_category")
     * @param string $category
     * @return Response
     */
    public function byCategory(string $category): Response{
        return $this->render("product/list.html.twig", [
            "productList" => $this->repository->findBy(["category" => $category]),
            "title" => "liste des produits dans la catégorie : $category",
            "categoryList" => $this->repository->getDisctinctCategories(),
            "currentCategory" => $category
        ]);
    }

}