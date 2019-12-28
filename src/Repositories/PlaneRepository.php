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
use WebAppId\Plane\Models\Planes;
use WebAppId\Plane\Services\Params\PlaneParam;

/**
 * Class PlaneRepository
 * @package WebAppId\Plane\Repositories
 */
class PlaneRepository
{
    /**
     * @param PlaneParam $planeParam
     * @param Planes $planes
     * @return Planes|null
     */
    public function store(PlaneParam $planeParam, Planes $planes): ?Planes
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
     * @param Planes $planes
     * @return Planes|null
     */
    public function getPlaneByIata(string $iataCode, Planes $planes): ?Planes
    {
        return $planes->where('iata_code', $iataCode)->first();
    }

    /**
     * @param string $iataCode
     * @param PlaneParam $planeParam
     * @param Planes $planes
     * @return Planes|null
     */
    public function updatePlaneByIataCode(string $iataCode, PlaneParam $planeParam, Planes $planes): ?Planes
    {
        $planes = $this->getAirportByIdent($iataCode, $planes);
        if ($planes != null) {
            try {
                $planes = Lazy::copy($planeParam, $planes);
                $planes->save();
            } catch (QueryException $queryException) {
                report($queryException);
            }
        }
        return $planes;
    }

    /**
     * @param string $q
     * @param Planes $planes
     * @param int $paginate
     * @return object|null
     */
    public function getPlaneLike(string $q, Planes $planes, int $paginate = 12): ?LengthAwarePaginator
    {
        return $planes
            ->where('name', 'LIKE', '%' . $q . '%')
            ->paginate($paginate);
    }

    /**
     * @param string $q
     * @param Planes $planes
     * @return int
     */
    public function getPlaneLikeCount(string $q, Planes $planes): int
    {
        return $planes
            ->where('name', 'LIKE', '%' . $q . '%')
            ->count();
    }

    /**
     * @param string $icaoCode
     * @param Planes $planes
     * @return Planes|null
     */
    public function getPlaneByIcaoCode(string $icaoCode, Planes $planes): ?Planes
    {
        return $planes->where('icao_code', $icaoCode)->first();
    }
}