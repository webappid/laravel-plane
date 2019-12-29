<?php


namespace WebAppId\Plane\Services\Contracts;


use WebAppId\Plane\Reponses\PlaneListResponse;
use WebAppId\Plane\Reponses\PlaneResponse;
use WebAppId\Plane\Repositories\PlaneRepository;
use WebAppId\Plane\Services\Params\PlaneParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 29/12/19
 * Time: 16.23
 * Interface PlaneServiceContract
 * @package WebAppId\Airport\Services\Contracts
 */
interface PlaneServiceContract
{
    /**
     * @param PlaneParam $planeParam
     * @param PlaneRepository $planeRepository
     * @param PlaneResponse $planeResponse
     * @return PlaneResponse
     */
    public function store(PlaneParam $planeParam, PlaneRepository $planeRepository, PlaneResponse $planeResponse): PlaneResponse;

    /**
     * @param string $q
     * @param PlaneRepository $planeRepository
     * @param PlaneListResponse $planeListResponse
     * @return PlaneListResponse
     */
    public function getByName(string $q, PlaneRepository $planeRepository, PlaneListResponse $planeListResponse): PlaneListResponse;

    /**
     * @param string $code
     * @param PlaneRepository $planeRepository
     * @param PlaneResponse $planeResponse
     * @return PlaneResponse
     */
    public function getByIataCode(string $code, PlaneRepository $planeRepository, PlaneResponse $planeResponse): PlaneResponse;

    /**
     * @param string $code
     * @param PlaneRepository $planeRepository
     * @param PlaneResponse $planeResponse
     * @return PlaneResponse
     */
    public function getByIcaoCode(string $code, PlaneRepository $planeRepository, PlaneResponse $planeResponse): PlaneResponse;
}