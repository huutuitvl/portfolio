<?php

namespace App\Helpers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PaginatorHelper
{
    public static function format(LengthAwarePaginator $paginator, $resource = null): array
    {
        $items = $resource
            ? $resource::collection($paginator)->resolve()
            : $paginator->items();

        return [
            'items' => $items,
            'pagination' => [
                'current_page' => $paginator->currentPage(),
                'last_page'    => $paginator->lastPage(),
                'per_page'     => $paginator->perPage(),
                'total'        => $paginator->total(),
            ],
        ];
    }
}
