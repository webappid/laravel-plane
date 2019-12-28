<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-14
 * Time: 02:28
 */

namespace WebAppId\Plane\Tests\Unit\Repositories;


use WebAppId\Plane\Models\Planes;
use WebAppId\Plane\Repositories\PlaneRepository;
use WebAppId\Plane\Services\Params\PlaneParam;
use WebAppId\Plane\Tests\TestCase;

class PlaneRepositoryTest extends TestCase
{
    /**
     * @var PlaneRepository
     */
    private $planeRepository;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->planeRepository = $this->container->make(PlaneRepository::class);

    }

    public function dummyData()
    {
        $planeParam = new PlaneParam();
        $planeParam->name = $this->getFaker()->text(50);
        $planeParam->iata_code = $this->getFaker()->text(5);
        $planeParam->icao_code = $this->getFaker()->text(5);
        return $planeParam;
    }

    private function createData($dummy)
    {
        return $this->container->call([$this->planeRepository, 'store'], ['planeParam' => $dummy]);
    }

    public function testStoreRepository(): ?Planes
    {
        $dummy = $this->dummyData();
        $result = $this->createData($dummy);

        self::assertNotEquals(null, $result);
        return $result;
    }

}