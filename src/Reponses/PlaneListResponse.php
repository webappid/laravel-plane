<?php


namespace WebAppId\Plane\Reponses;


use Illuminate\Database\Eloquent\Collection;
use WebAppId\DDD\Responses\AbstractResponse;

class PlaneListResponse extends AbstractResponse
{
    /**
     * @var Collection
     */
    public $planes;
}