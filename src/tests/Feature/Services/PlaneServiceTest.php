<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-14
 * Time: 15:39
 */

namespace WebAppId\Airport\Tests\Feature\Services;


use Illuminate\Contracts\Container\BindingResolutionException;
use WebAppId\Plane\Services\PlaneService;
use WebAppId\Plane\Tests\Unit\Repositories\PlaneRepositoryTest;
use WebAppId\Plane\Tests\TestCase;

class PlaneServiceTest extends TestCase
{
    /**
     * @var PlaneService
     */
    private $planeService;
    /**
     * @var PlaneRepositoryTest
     */
    private $planeRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->planeService = $this->container->make(PlaneService::class);
            $this->planeRepositoryTest = $this->container->make(PlaneRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function testStore()
    {
        $planeDummy = $this->planeRepositoryTest->dummyData();
        $result = $this->container->call([$this->planeService, 'store'], ['planeParam' => $planeDummy]);
        self::assertTrue($result->getStatus());
    }

    public function testGetByIataCode()
    {
        $iataCode = $this->planeRepositoryTest->getDummyIataCode();
        $result = $this->container->call([$this->planeService, 'getByIataCode'], ['code' => $iataCode]);
        self::assertTrue($result->isStatus());
    }

    public function testByIcaoCode()
    {
        $icaoCode = $this->planeRepositoryTest->getDummyIcaoCode();
        $result = $this->container->call([$this->planeService, 'getByIcaoCode'], ['code' => $icaoCode]);
        self::assertTrue($result->isStatus());
    }

    public function testGetByNameLike()
    {
        $string = 'aiueo';
        $result = $this->container->call([$this->planeService, 'getByName'], ['q' => $string[$this->getFaker()->numberBetween(0, strlen($string) - 1)]]);
        self::assertTrue($result->isStatus());
    }

}