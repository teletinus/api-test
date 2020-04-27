<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class WebController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('web/index.html.twig', [
            'page_name'=>'Home'
        ]);
    }
    /**
     * @Route("/product", name="product")
     */
    public function product()
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        
        return $this->render('web/product.html.twig', [
            'page_name'=>'New Product',
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/sales", name="sales")
     */
    public function sales()
    {
        return $this->render('web/sales.html.twig', [
            'page_name'=>'Sales'
        ]);
    }
}
