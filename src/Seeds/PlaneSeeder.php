<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-14
 * Time: 16:39
 */

namespace WebAppId\Plane\Seeds;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use WebAppId\DDD\Tools\Lazy;
use WebAppId\Plane\Repositories\PlaneRepository;
use WebAppId\Plane\Services\Params\PlaneParam;

class PlaneSeeder extends Seeder
{
    public function run(PlaneRepository $planeRepository, PlaneParam $planeParam)
    {
        $file = __DIR__ . '/../Resources/Csv/Planes.csv';
        $header = array('name', 'iata_code', 'icao_code');

        $delimiter = ',';
        if (file_exists($file) || is_readable($file)) {

            if (($handle = fopen($file, 'r')) !== false) {
                DB::beginTransaction();
                while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                    $data = array_combine($header, $row);
                    $planeParam = Lazy::copyFromArray($data, $planeParam, Lazy::AUTOCAST);

                    $this->container->call([$planeRepository, 'store'], ['planeParam' => $planeParam]);
                }
                DB::commit();
                fclose($handle);
            }
        }
    }
}