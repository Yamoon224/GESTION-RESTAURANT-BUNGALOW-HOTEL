<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderSyncController extends Controller
{
    /**
     * Lister les commandes synchronisables.
     *
     * Retourne la liste paginee des commandes avec leur createur, leur modificateur et leurs lignes.
     *
     * @group Synchronisation Commandes
     * @authenticated
     * @header Authorization Bearer {SYNC_API_TOKEN}
     * @queryParam page integer Numero de page. Example: 1
    * @queryParam per_page integer Nombre d'elements par page (max 100). Example: 25
     *
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 10,
     *       "ref": "BH-120501",
     *       "amount": 13500,
     *       "description": "Commande salle",
     *       "created_by": 1,
     *       "updated_by": 1,
     *       "created_at": "2026-06-08T12:05:01.000000Z",
     *       "updated_at": "2026-06-08T12:05:01.000000Z",
     *       "creator": {
     *         "id": 1,
     *         "name": "Admin",
     *         "email": "admin@example.com"
     *       },
     *       "updator": {
     *         "id": 1,
     *         "name": "Admin",
     *         "email": "admin@example.com"
     *       },
     *       "order_details": [
     *         {
     *           "id": 21,
     *           "qty": 3,
     *           "price": 4500,
     *           "amount": 13500,
     *           "product_id": 15,
     *           "product": {
     *             "id": 15,
     *             "name": "Poulet braise",
     *             "price": 4500,
     *             "qty": 25,
     *             "status": 1,
     *             "img": "images/products/poulet.png",
     *             "category_id": 3,
     *             "category": {
     *               "id": 3,
     *               "name": "Plats"
     *             },
     *             "product_details": [],
     *             "created_at": "2026-06-08T12:00:00.000000Z",
     *             "updated_at": "2026-06-08T12:00:00.000000Z"
     *           },
     *           "created_at": "2026-06-08T12:05:01.000000Z",
     *           "updated_at": "2026-06-08T12:05:01.000000Z"
     *         }
     *       ]
     *     }
     *   ]
     * }
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 50);
        $perPage = max(1, min($perPage, 100));

        $orders = Order::with(['creator', 'updator', 'order_details.product.category'])
            ->orderByDesc('id')
            ->paginate($perPage)
            ->appends($request->query());

        return OrderResource::collection($orders);
    }

    /**
     * Afficher une commande synchronisable.
     *
     * Retourne le detail complet d'une commande avec les lignes et produits associes.
     *
     * @group Synchronisation Commandes
     * @authenticated
     * @header Authorization Bearer {SYNC_API_TOKEN}
     * @urlParam order integer required ID de la commande. Example: 10
     *
     * @response 200 {
     *   "data": {
     *     "id": 10,
     *     "ref": "BH-120501",
     *     "amount": 13500,
     *     "description": "Commande salle",
     *     "created_by": 1,
     *     "updated_by": 1,
     *     "created_at": "2026-06-08T12:05:01.000000Z",
     *     "updated_at": "2026-06-08T12:05:01.000000Z",
     *     "creator": {
     *       "id": 1,
     *       "name": "Admin",
     *       "email": "admin@example.com"
     *     },
     *     "updator": {
     *       "id": 1,
     *       "name": "Admin",
     *       "email": "admin@example.com"
     *     },
     *     "order_details": [
     *       {
     *         "id": 21,
     *         "qty": 3,
     *         "price": 4500,
     *         "amount": 13500,
     *         "product_id": 15,
     *         "product": {
     *           "id": 15,
     *           "name": "Poulet braise",
     *           "price": 4500,
     *           "qty": 25,
     *           "status": 1,
     *           "img": "images/products/poulet.png",
     *           "category_id": 3,
     *           "category": {
     *             "id": 3,
     *             "name": "Plats"
     *           },
     *           "product_details": [],
     *           "created_at": "2026-06-08T12:00:00.000000Z",
     *           "updated_at": "2026-06-08T12:00:00.000000Z"
     *         },
     *         "created_at": "2026-06-08T12:05:01.000000Z",
     *         "updated_at": "2026-06-08T12:05:01.000000Z"
     *       }
     *     ]
     *   }
     * }
     */
    public function show(Order $order)
    {
        $order->load(['creator', 'updator', 'order_details.product.category']);

        return new OrderResource($order);
    }
}