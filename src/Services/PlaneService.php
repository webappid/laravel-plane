<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-14
 * Time: 15:32
 */

namespace WebAppId\Plane\Services;


use WebAppId\Plane\Reponses\PlaneListResponse;
use WebAppId\Plane\Reponses\PlaneResponse;
use WebAppId\Plane\Services\Contracts\PlaneServiceContract;
use WebAppId\DDD\Services\BaseService;
use WebAppId\Plane\Repositories\PlaneRepository;
use WebAppId\Plane\Services\Params\PlaneParam;


/**
 * Class PlaneService
 * @package WebAppId\Plane\Tests\Feature\Services
 */
class PlaneService extends BaseService implements PlaneServiceContract
{

    /**
     * @inheritDoc
     */
    public function store(PlaneParam $planeParam, PlaneRepository $planeRepository, PlaneResponse $planeResponse): PlaneResponse
    {
        $result = $this->getContainer()->call([$planeRepository, 'store'], ['planeParam' => $planeParam]);
        if ($result != null) {
            $planeResponse->setStatus(true);
            $planeResponse->setMessage('Save Data Success');
            $planeResponse->plane = $result;
        } else {
            $planeResponse->setStatus(false);
            $planeResponse->setMessage('Save Data Failed');
        }
        return $planeResponse;
    }

    /**
     * @inheritDoc
     */
    public function getByName(string $q, PlaneRepository $planeRepository, PlaneListResponse $planeListResponse): PlaneListResponse
    {
        $result = $this->getContainer()->call([$planeRepository, 'getByNameLike'], ['q' => $q]);
        if (count($result) > 0) {
            $planeListResponse->setStatus(true);
            $planeListResponse->setMessage('Data Found');
            $planeListResponse->planes = $result;
        }else{
            $planeListResponse->setMessage('Data Not Found');
            $planeListResponse->setStatus(false);
        }
        return $planeListResponse;
    }

    /**
     * @inheritDoc
     */
    public function getByIataCode(string $code, PlaneRepository $planeRepository, PlaneResponse $planeResponse): PlaneResponse
    {
        $result = $this->getContainer()->call([$planeRepository, 'getByIataCode'], ['iataCode' => $code]);
        if ($result != null) {
            $planeResponse->setStatus(true);
            $planeResponse->setMessage('Data Found');
            $planeResponse->plane = $result;
        } else {
            $planeResponse->setStatus(false);
            $planeResponse->setMessage('Data Not Found');
        }
        return $planeResponse;
    }

    /**
     * @inheritDoc
     */
    public function getByIcaoCode(string $code, PlaneRepository $planeRepository, PlaneResponse $planeResponse): PlaneResponse
    {
        $result = $this->getContainer()->call([$planeRepository, 'getByIcaoCode'], ['icaoCode' => $code]);
        if ($result != null) {
            $planeResponse->setStatus(true);
            $planeResponse->setMessage('Data Found');
            $planeResponse->plane = $result;
        } else {
            $planeResponse->setStatus(false);
            $planeResponse->setMessage('Data Not Found');
        }
        return $planeResponse;
    }
}