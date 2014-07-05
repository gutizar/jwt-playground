<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Avtenta\Bundle\RestBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Util\Codes;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Description of ProductController
 *
 * @author danielg
 */
class ProductController extends FOSRestController
{
    /**
     * Get all Products,
     * 
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets all products",
     *   output = "Array of Avtenta\ModelBundle\Entity\Page",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * 
     * @Rest\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing products")
     * @Rest\QueryParam(name="limit", requirements="\d+", default="5", description="Number of products to return")
     * 
     * @Rest\View(templateVar="products")
     * 
     * @param  Request $request the request object
     * @param  ParamFetcherInterface $paramFetcher param fetcher service
     * 
     * @return array
     */
    public function getProductsAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $offset = (null == $offset) ? 0 : $offset;
        $limit = $paramFetcher->get('limit');

        return $this->get('avtenta_model.product.manager')->all($offset, $limit);
    }

   /**
    * Get single Product,
    *
    * @ApiDoc(
    *   resource = true,
    *   description = "Gets a Product for a given id",
    *   output = "Avtenta\Bundle\ModelBundle\Document\Product",
    *   statusCodes = {
    *     200 = "Returned when successful",
    *     404 = "Returned when the product is not found"
    *   }
    * )
    *
    * @Rest\View(templateVar="product")
    *
    * @param Request $request the request object
    * @param int     $id      the product id
    *
    * @return array
    *
    * @throws NotFoundHttpException when product not exist
    */
    public function getProductAction($id)
    {
       $product = $this->container
	       ->get('avtenta_model.product.manager')
	       ->get($id);

       return $product;
    }
}
