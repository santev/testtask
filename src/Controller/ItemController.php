<?php

namespace App\Controller;

use App\Entity\Item;
use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{

    #[Route(
        path: '/api/items/{id}/setprice',
        name: 'item_setprice',
        methods: ['POST'],
        defaults: [
            '_api_resource_class' => Item::class,
            '_api_operation_name' => 'item_setprice',
        ],
    )]

    public function setupPrice(Item $item, ItemRepository $itemRepository, Request $request): Response
    {

        $result = $itemRepository->setupItemPrice($item, $request);

        return $this->json([
            'status' => 'Ok',
            'message' => 'Data successfully  inserted',
            'item' => $item,
            'result' => $result
        ]);
    }
}
