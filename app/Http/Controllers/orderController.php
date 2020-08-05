<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\addLineItemCustom;
Use Exception;
use GraphQL\Query;
use GraphQL\Variable;
use GraphQL\Mutation;
use GraphQL\Client;
use GraphQL\RawObject;
use GraphQL\Exception\QueryError;
use GraphQL\QueryBuilder\QueryBuilder;

class orderController extends shopifyController
{

    /**
     * Add a custom line item
     *
     * @return \Illuminate\Http\Response
     */
    public function addCustomLineItem(addLineItemCustom $request)
    {
        $data = array('status' => 'error', 'message' => 'not able to add');
        $validated = $request->validated();
        try {
            //from this point i wasn't able to test and see how the integration works
            $gql = (new Mutation('orderEditAddCustomItem'))
            ->setArguments(['orderEditAddCustomItem' => new RawObject('{id: "gid://shopify/CalculatedOrder/1237", variantId: "gid://shopify/ProductVariant/19523055845398", quantity: 1}')])
            ->setSelectionSet(
                [
                    "'calculatedOrder': [
                        'id',
                        'addedLineItens(first:5)': [
                            'edges': [
                            ]
                        ]
                    ]"
                ]
            );

            if ($this->client) {
                $results = $this->client->runQuery($gql);
                $data = array('status' => 'success', 'message' => 'Custom line item successfully created');
            }

        } catch (Exception $e) {
            $data = array('status' => 'error', 'message' => $e->getMessage());
        }
                
        return response()->json($data);
    }


    public function addLineItemByVariantId(Request $request, $variant_id)
    {
        $data = array('status' => 'error', 'message' => 'Line item not added');
        try {
            //from this point i wasn't able to test and see how the integration works
            $gql = (new Mutation('addVariantToOrder'))
            ->setArguments(['orderEditAddVariant' => new RawObject('{id: "gid://shopify/CalculatedOrder/1237", variantId: "gid://shopify/ProductVariant/19523055845398", quantity: 1}')])
            ->setSelectionSet(
                [
                    "'calculatedOrder': [
                        'id',
                        'addedLineItens(first:5)': [
                            'edges': [
                            ]
                        ]
                    ]"
                ]
            );

            if ($this->client) {
                $results = $this->client->runQuery($gql);
                $data = array('status' => 'success', 'message' => 'Line item successfully added');
            }

        } catch (Exception $e) {
            $data = array('status' => 'error', 'message' => $e->getMessage());
        }
                
        return response()->json($data);
    }

    public function getLineItemByVariantId($variant_id)
    {
        $data = array('status' => 'error', 'message' => 'Not able to get line item by viariant_id');
        try {
            //from this point i wasn't able to test and see how the integration works
            //integration with shopify havent been implemented in this function. this example of how it should output

            $lineitem = ['id' => 1, 'price' => 10.00, 'variant_id' => $variant_id];

            $data = array('status' => 'success', 'data' => $lineitem);

        } catch (Exception $e) {
            $data = array('status' => 'error', 'message' => $e->getMessage());
        }
                
        return response()->json($data);
    }

    public function replaceLineItemByVariantId($variant_id)
    {
        $data = array('status' => 'error', 'message' => 'Line item not replaced');
        try {
            //from this point i wasn't able to test and see how the integration works
            $gql = (new Mutation('addVariantToOrder'))
            ->setArguments(['orderEditAddVariant' => new RawObject('{id: "gid://shopify/CalculatedOrder/1237", variantId: "gid://shopify/ProductVariant/19523055845398", quantity: 1}')])
            ->setSelectionSet(
                [
                    "'calculatedOrder': [
                        'id',
                        'addedLineItens(first:5)': [
                            'edges': [
                            ]
                        ]
                    ]"
                ]
            );

            if ($this->client) {
                $results = $this->client->runQuery($gql);
                $data = array('status' => 'success', 'message' => 'Line item successfully replaced');
            }

        } catch (Exception $e) {
            $data = array('status' => 'error', 'message' => $e->getMessage());
        }
                
        return response()->json($data);
    }

    public function removeLineItemByVariantId($variant_id)
    {
        $data = array('status' => 'error', 'message' => 'Custom line item not removed');
        try {
            //wasn't able to find command to remove line items from order
            $gql = (new Mutation(''))
            ->setArguments(['orderEditAddVariant' => new RawObject('{id: "gid://shopify/CalculatedOrder/1237", variantId: "gid://shopify/ProductVariant/19523055845398", quantity: 1}')])
            ->setSelectionSet(
                [
                    "'calculatedOrder': [
                        'id',
                        'addedLineItens(first:5)': [
                            'edges': [
                            ]
                        ]
                    ]"
                ]
            );
            if ($this->client) {
                $results = $this->client->runQuery($gql);
                $data = array('status' => 'success', 'message' => 'Custom line item successfully removed');
            }

        } catch (Exception $e) {
            $data = array('status' => 'error', 'message' => $e->getMessage());
        }
                
        return response()->json($data);
    }
}
