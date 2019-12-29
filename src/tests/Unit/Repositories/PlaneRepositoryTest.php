<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-14
 * Time: 02:28
 */

namespace WebAppId\Plane\Tests\Unit\Repositories;


use Illuminate\Contracts\Container\BindingResolutionException;
use WebAppId\Plane\Models\Plane;
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

        try {
            $this->planeRepository = $this->container->make(PlaneRepository::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }

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

    public function getDummyIataCode(): string
    {
        $iataCode = [
            '703',
            '762',
            'ATP',
            'CN1',
            'DHP',
            'D91',
            'F27',
            'I14',
            'M87',
            'SH6',
            'T20'
        ];

        return $iataCode[$this->getFaker()->numberBetween(0, count($iataCode) - 1)];
    }

    public function getDummyIcaoCode(): string
    {
        $icaoCodes = [
            'N262',
            'A337',
            'A346',
            'A35K',
            'BLCF',
            'B743',
            'B772',
            'DHC2',
            'J328',
            'MD82',
            'S76'
        ];
        return $icaoCodes[$this->getFaker()->numberBetween(0, count($icaoCodes) - 1)];
    }

    public function testStore(): ?Plane
    {
        $dummy = $this->dummyData();
        $result = $this->createData($dummy);

        self::assertNotEquals(null, $result);
        return $result;
    }

    public function testGetByNameLike()
    {
        $string = 'aiueo';
        $result = $this->container->call([$this->planeRepository, 'getByNameLike'], ['q' => $string[$this->getFaker()->numberBetween(0, strlen($string) - 1)]]);
        self::assertGreaterThanOrEqual(1, count($result));
    }

    public function testGetByIataCode()
    {
        $iataCode = $this->getDummyIataCode();
        $result = $this->container->call([$this->planeRepository, 'getByIataCode'], ['iataCode' => $iataCode]);
        self::assertNotEquals(null, $result);
    }

    public function testGetByIcaoCode()
    {
        $icaoCode = $this->getDummyIcaoCode();
        $result = $this->container->call([$this->planeRepository, 'getByIcaoCode'], ['icaoCode' => $icaoCode]);
        self::assertNotEquals(null, $result);
    }
}