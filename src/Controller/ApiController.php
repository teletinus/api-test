<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Product;
use App\Form\ProductType;

/**
 * Product controller.
 * @Route("/api", name="api.")
 */
class ApiController extends FOSRestController {

    /**
     * Create product
     * @Rest\Post("/product")
     * @param Request $request
     */
    public function postProductAction(Request $request) {

        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        if ($request->get('web')) {
            $data = $request->get('product');
        } else {
            $data = $data = json_decode($request->getContent(), true);
        }
//        print_r($data);die();
        $form->submit($data);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
        }
        return $this->handleView($this->view($form->getErrors()));
    }

    /**
     * Get sales
     * @Rest\Get("/sales")
     * @return Response
     */
    public function getSalesAction() {

        //Read json data from file
        $webPath = $this->get('kernel')->getProjectDir() . '/public/publicassets/json/';
        $file = 'potato_sales.json';
        $content = file_get_contents($webPath . $file);
        $sales_array = json_decode($content, true);

        //Set up THEAD and TBODY for TABLE report
        $sales_thead = [];
        foreach ($sales_array['column'] as $key_col => $val_col) {
            if (isset($val_col['field'])) {
                $sales_thead[] = $val_col['header'];
            } elseif (isset($val_col['subHeaders'])) {
                foreach ($val_col['subHeaders'] as $key_subcol => $val_subcol) {
                    $sales_thead[] = $val_subcol['header'];
                }
            } elseif (count($val_col) == 1) {
                $sales_thead[] = $val_col['header'];
            }
        }
        $sales_tbody = [];
        $sales_tbody = $sales_array['data'];

        //Calculate total sales and update TBODY
        foreach ($sales_tbody as $key_tbody => $val_tbody) {
            $total_sales = 0;
            foreach ($val_tbody as $k_tbody => $v_tbody) {
                if ($k_tbody != 'productID' && $k_tbody != 'productName') {
                    $total_sales += $v_tbody;
                }
            }
            $sales_tbody[$key_tbody]['totalSales'] = $total_sales;
        }

        //json format response
        $response = [];
        $response['thead'] = $sales_thead;
        $response['tbody'] = $sales_tbody;


        die(json_encode($response));
    }

}
