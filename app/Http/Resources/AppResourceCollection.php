<?php
/**
 * Created by   : PhpStorm
 * Project      : dekko-web-backend
 * File Name    : AppResourceCollectionion.php * User         : Abu Bakar Siddique
 * Email        : absiddique.live@gmail.com
 * Company      : Softwind Tech Ltd.
 * Date[D/M/Y]  : 16/04/2019 12:44 PM
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\ResourceResponse;

class  AppResourceCollection extends ResourceCollection
{
    /**
     * To enable/disable pagination with response
     *
     * @var bool
     */
    protected $paginate = true;

    /**
     * AppResourceCollection constructor.
     *
     * @param $resource
     * @param $paginate
     */
    public function __construct($resource, $paginate = true)
    {
        parent::__construct($resource);

        $this->paginate = $paginate;
    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $items = [];

        if ($this->paginate) {
            $items['items'] = $this->collection->transform(function ($item) {
                return $item;
            });

            $items['total']          = $this->resource->total();
            $items['per_page']       = $this->resource->perPage();
            $items['current_page']   = $this->resource->currentPage();
            $items['hasMorePages']   = $this->resource->hasMorePages();
            $items['first_page_url'] = $this->resource->appends(request()->input())->url(1);
            $items['next_page_url']  = $this->resource->appends(request()->input())->nextPageUrl();
            $items['prev_page_url']  = $this->resource->appends(request()->input())->previousPageUrl();
            $items['last_page_url']  = $this->resource->appends(request()->input())->url($this->resource->lastPage());
        } else {
            $items = $this->collection->transform(function ($item) {
                return $item;
            });
        }

        return $items;
    }

    public function toResponse($request)
    {
        return (new ResourceResponse($this))->toResponse($request);
    }
}
