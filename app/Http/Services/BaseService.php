<?php

namespace App\Http\Services;

use Spatie\Fractalistic\Fractal;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;


class BaseService
{
  public function fractalizeAll($paginator, $transformer)
  {
    $collection = $paginator->getCollection();

    // use Fractal array serializer instead of Spatie's
    // the response is going to be {data:[...]} instead of {"0"=>{...}}
    // Which will make it easier to traverse and extract data From the front-end for example
    return Fractal::create()
      ->collection($collection, $transformer)
      ->serializeWith(new ArraySerializer)
      ->paginateWith(new IlluminatePaginatorAdapter($paginator))
      ->toArray();
  }

  public function fractalizeOne($collection, $transformer)
  {
    return Fractal::create()
      ->item($collection, $transformer)
      ->toArray();
  }
}
