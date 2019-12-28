<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-14
 * Time: 15:32
 */

namespace WebAppId\Plane\Services;


use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Collection;
use WebAppId\Plane\Repositories\PlaneRepository;


/**
 * Class PlaneService
 * @package WebAppId\Plane\Tests\Feature\Services
 */
class PlaneService
{
    private $container;
    
    public function __construct(Container $container)
    {
        return $this->container = $container;
    }
    
    /**
     * @param string $q
     * @param PlaneRepository $airportRepository
     * @return object|null
     */
    public function getAirportLike(string $q, PlaneRepository $airportRepository): ?object
    {
        return $this->container->call([$airportRepository, 'getAirportLike'], ['q' => $q]);
    }
    
    /**
     * @param string $countryCode
     * @param PlaneRepository $airportRepository
     * @return Collection|null
     */
    public function getAllAirportByCountry(string $countryCode, PlaneRepository $airportRepository): ?Collection
    {
        return $this->container->call([$airportRepository, 'getAllAirportByCountry'], ['countryCode' => $countryCode]);
    }
}