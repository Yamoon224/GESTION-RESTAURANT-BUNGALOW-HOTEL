<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductSyncController extends Controller
{
    /**
     * Lister les produits synchronisables.
     *
     * Retourne la liste paginee des produits avec leur categorie et leurs details.
     *
     * @group Synchronisation Produits
     * @authenticated
     * @header Authorization Bearer {SYNC_API_TOKEN}
     * @queryParam page integer Numero de page. Example: 1
    * @queryParam per_page integer Nombre d'elements par page (max 100). Example: 25
     *
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 15,
     *       "name": "Poulet braise",
     *       "price": 4500,
     *       "qty": 25,
     *       "status": 1,
     *       "img": "images/products/poulet.png",
     *       "category_id": 3,
     *       "category": {
     *         "id": 3,
     *         "name": "Plats"
     *       },
     *       "product_details": [
     *         {
     *           "id": 1,
     *           "qty": 1,
     *           "price": 1000,
     *           "amount": 1000,
     *           "ingredient_id": 7,
     *           "created_at": "2026-06-08T12:00:00.000000Z",
     *           "updated_at": "2026-06-08T12:00:00.000000Z"
     *         }
     *       ],
     *       "created_at": "2026-06-08T12:00:00.000000Z",
     *       "updated_at": "2026-06-08T12:00:00.000000Z"
     *     }
     *   ],
     *   "links": {
     *     "first": "http://localhost/api/sync/products?page=1",
     *     "last": "http://localhost/api/sync/products?page=1",
     *     "prev": null,
     *     "next": null
     *   },
     *   "meta": {
     *     "current_page": 1,
     *     "from": 1,
     *     "last_page": 1,
     *     "path": "http://localhost/api/sync/products",
     *     "per_page": 50,
     *     "to": 1,
     *     "total": 1
     *   }
     * }
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 50);
        $perPage = max(1, min($perPage, 100));

        $products = Product::with(['category', 'product_details'])
            ->orderByDesc('id')
            ->paginate($perPage)
            ->appends($request->query());

        return ProductResource::collection($products);
    }

    /**
     * Afficher un produit synchronisable.
     *
     * Retourne le detail d'un produit avec sa categorie et ses details de composition.
     *
     * @group Synchronisation Produits
     * @authenticated
     * @header Authorization Bearer {SYNC_API_TOKEN}
     * @urlParam product integer required ID du produit. Example: 15
     *
     * @response 200 {
     *   "data": {
     *     "id": 15,
     *     "name": "Poulet braise",
     *     "price": 4500,
     *     "qty": 25,
     *     "status": 1,
     *     "img": "images/products/poulet.png",
     *     "category_id": 3,
     *     "category": {
     *       "id": 3,
     *       "name": "Plats"
     *     },
     *     "product_details": [
     *       {
     *         "id": 1,
     *         "qty": 1,
     *         "price": 1000,
     *         "amount": 1000,
     *         "ingredient_id": 7,
     *         "created_at": "2026-06-08T12:00:00.000000Z",
     *         "updated_at": "2026-06-08T12:00:00.000000Z"
     *       }
     *     ],
     *     "created_at": "2026-06-08T12:00:00.000000Z",
     *     "updated_at": "2026-06-08T12:00:00.000000Z"
     *   }
     * }
     */
    public function show(Product $product)
    {
        $product->load(['category', 'product_details']);

        return new ProductResource($product);
    }
}