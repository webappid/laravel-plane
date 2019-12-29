<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-14
 * Time: 02:30
 */

namespace WebAppId\Plane\Repositories;


use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\DDD\Tools\Lazy;
use WebAppId\Plane\Models\Plane;
use WebAppId\Plane\Services\Params\PlaneParam;

/**
 * Class PlaneRepository
 * @package WebAppId\Plane\Repositories
 */
class PlaneRepository
{
    /**
     * @param PlaneParam $planeParam
     * @param Plane $planes
     * @return Plane|null
     */
    public function store(PlaneParam $planeParam, Plane $planes): ?Plane
    {
        try {
            $planes = Lazy::copy($planeParam, $planes);
            $planes->save();
            return $planes;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @param string $iataCode
     * @param Plane $planes
     * @return Plane|null
     */
    public function getByIataCode(string $iataCode, Plane $planes): ?Plane
    {
        return $planes->where('iata_code', $iataCode)->first();
    }

    /**
     * @param string $q
     * @param Plane $planes
     * @param int $paginate
     * @return object|null
     */
    public function getByNameLike(string $q, Plane $planes, int $paginate = 12): ?LengthAwarePaginator
    {
        return $planes
            ->where('name', 'LIKE', '%' . $q . '%')
            ->paginate($paginate);
    }

    /**
     * @param string $q
     * @param Plane $planes
     * @return int
     */
    public function getByNameLikeCount(string $q, Plane $planes): int
    {
        return $planes
            ->where('name', 'LIKE', '%' . $q . '%')
            ->count();
    }

    /**
     * @param string $icaoCode
     * @param Plane $planes
     * @return Plane|null
     */
    public function getByIcaoCode(string $icaoCode, Plane $planes): ?Plane
    {
        return $planes->where('icao_code', $icaoCode)->first();
    }
}