<?php


namespace WebAppId\Plane\Reponses;


use WebAppId\DDD\Responses\AbstractResponse;
use WebAppId\Plane\Models\Plane;

class PlaneResponse extends AbstractResponse
{
    /**
     * @var Plane
     */
    public $plane;
}