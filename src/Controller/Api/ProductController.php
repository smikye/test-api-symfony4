<?php

namespace App\Controller\Api;

use App\Entity\Product;
use App\Entity\ProductUnit;
use App\Entity\TimeUnit;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ProductController extends BaseApiController
{
    /**
     * @Route("/productionCapacities", name="productionCapacities")
     * @Method({"POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function productionCapacityAction(Request $request)
    {
        $prodCapacities = $request->get("productionCapacities");

        if (!$prodCapacities)
            return $this->setError("PRODUCTION_CAPACITIES_NOT_FOUND", 123)->errorResponse(Response::HTTP_BAD_REQUEST);

        //validate each item of array
        foreach ($prodCapacities as $prodCapacity) {
            if (!isset($prodCapacity["amount"]) || !isset($prodCapacity["productionUnit"]) || !isset($prodCapacity["timeUnit"]) || !isset($prodCapacity["productGroup"]))
                return $this->errorResponse(Response::HTTP_BAD_REQUEST);

            foreach ($prodCapacity as $key => $value) {
                switch ($key) {
                    case "amount":
                        if (!is_int($value) || $value < 0)
                            $this->setError("AMOUNT_INVALID", "Amount should be integer and above zero");
                        break;
                    case "productionUnit":
                    case "timeUnit":
                    case "productGroup":
                        if (!is_int($value["id"]) || $value["id"] < 0)
                            $this->setError("ID_INVALID", "Id should be integer and above zero");
                        if (!is_string($value["name"]) || strlen($value["name"]) < 1)
                            $this->setError("NAME_INVALID", "Name should be a string with length more then 0 symbols");
                        break;
                }
            }
        }

        if ($this->hasErrors())
            return $this->errorResponse(Response::HTTP_BAD_REQUEST);

        $em = $this->getDoctrine()->getManager();

        //sum up the amount of each item to the existing amount of this item
        foreach ($prodCapacities as $prodCapacity) {

            $product = $this->getDoctrine()
                ->getRepository(Product::class)
                ->findOneBy(["name" => $prodCapacity["productGroup"]["name"]]);

            //create new product if it doesn't exist in database
            if (!$product) {
                $product = new Product();
                $product->setName($prodCapacity["productGroup"]["name"]);
            }

            //trying to get the production unit
            $prodUnit = $this->getDoctrine()
                ->getRepository(ProductUnit::class)
                ->findOneBy(["name" => $prodCapacity["productionUnit"]["name"]]);

            if (!$prodUnit)
                return $this->setError("PRODUCTION_UNIT_NOT_FOUND")->errorResponse(Response::HTTP_BAD_REQUEST);

            //trying to get the time unit
            $timeUnit = $this->getDoctrine()
                ->getRepository(TimeUnit::class)
                ->findOneBy(["name" => $prodCapacity["timeUnit"]["name"]]);

            if (!$timeUnit)
                return $this->setError("TIME_UNIT_NOT_FOUND")->errorResponse(Response::HTTP_BAD_REQUEST);

            $product->setAmount($product->getAmount() + $prodCapacity["amount"]);
            $product->setProdUnitId($prodUnit)->setTimeUnit($timeUnit);

            $em->persist($product);
            $em->flush();
        }

        return $this->successResponse(Response::HTTP_OK);
    }
}