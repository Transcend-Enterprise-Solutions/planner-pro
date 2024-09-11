<?php

namespace Database\Seeders;

use App\Models\SalaryGrade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalaryGradesTableSeeder extends Seeder
{
    public function run()
    {
        $salaryGradeData = [
            [
                'salary_grade' => 1,'step1' => 13000.00, 'step2' => 13109.00, 'step3' => 13219.00, 'step4' => 13329.00,
                'step5' => 13441.00, 'step6' => 13553.00, 'step7' => 13666.00, 'step8' => 13780.00
            ],
            [
                'salary_grade' => 2,'step1' => 13819.00, 'step2' => 13925.00, 'step3' => 14032.00, 'step4' => 14140.00,
                'step5' => 14248.00, 'step6' => 14357.00, 'step7' => 14468.00, 'step8' => 14578.00
            ],
            [
                'salary_grade' => 3,'step1' => 14678.00, 'step2' => 14792.00, 'step3' => 14905.00, 'step4' => 15020.00,
                'step5' => 15136.00, 'step6' => 15251.00, 'step7' => 15369.00, 'step8' => 15486.00
            ],
            [
                'salary_grade' => 4,'step1' => 15586.00, 'step2' => 15706.00, 'step3' => 15827.00, 'step4' => 15948.00,
                'step5' => 16071.00, 'step6' => 16193.00, 'step7' => 16318.00, 'step8' => 16443.00
            ],
            [
                'salary_grade' => 5,'step1' => 16543.00, 'step2' => 16671.00, 'step3' => 16799.00, 'step4' => 16928.00,
                'step5' => 17057.00, 'step6' => 17189.00, 'step7' => 17321.00, 'step8' => 17453.00
            ],
            [
                'salary_grade' => 6,'step1' => 17553.00, 'step2' => 17688.00, 'step3' => 17824.00, 'step4' => 17962.00,
                'step5' => 18100.00, 'step6' => 18238.00, 'step7' => 18379.00, 'step8' => 18520.00
            ],
            [
                'salary_grade' => 7,'step1' => 18620.00, 'step2' => 18763.00, 'step3' => 18907.00, 'step4' => 19053.00,
                'step5' => 19198.00, 'step6' => 19346.00, 'step7' => 19494.00, 'step8' => 19644.00
            ],
            [
                'salary_grade' => 8,'step1' => 19744.00, 'step2' => 19923.00, 'step3' => 20104.00, 'step4' => 20285.00,
                'step5' => 20468.00, 'step6' => 20653.00, 'step7' => 20840.00, 'step8' => 21029.00
            ],
            [
                'salary_grade' => 9,'step1' => 21211.00, 'step2' => 21388.00, 'step3' => 21567.00, 'step4' => 21747.00,
                'step5' => 21929.00, 'step6' => 22112.00, 'step7' => 22297.00, 'step8' => 22483.00
            ],
            [
                'salary_grade' => 10,'step1' => 23176.00, 'step2' => 23370.00, 'step3' => 23565.00, 'step4' => 23762.00,
                'step5' => 23961.00, 'step6' => 24161.00, 'step7' => 24363.00, 'step8' => 24567.00
            ],
            [
                'salary_grade' => 11,'step1' => 27000.00, 'step2' => 27284.00, 'step3' => 27573.00, 'step4' => 27865.00,
                'step5' => 28161.00, 'step6' => 28462.00, 'step7' => 28766.00, 'step8' => 29075.00
            ],
            [
                'salary_grade' => 12,'step1' => 29165.00, 'step2' => 29449.00, 'step3' => 29737.00, 'step4' => 30028.00,
                'step5' => 30323.00, 'step6' => 30622.00, 'step7' => 30924.00, 'step8' => 31230.00
            ],
            [
                'salary_grade' => 13,'step1' => 31320.00, 'step2' => 31633.00, 'step3' => 31949.00, 'step4' => 32269.00,
                'step5' => 32594.00, 'step6' => 32922.00, 'step7' => 33254.00, 'step8' => 33591.00
            ],
            [
                'salary_grade' => 14,'step1' => 33843.00, 'step2' => 34187.00, 'step3' => 34535.00, 'step4' => 34888.00,
                'step5' => 35244.00, 'step6' => 35605.00, 'step7' => 35971.00, 'step8' => 36341.00
            ],
            [
                'salary_grade' => 15,'step1' => 36619.00, 'step2' => 36997.00, 'step3' => 37380.00, 'step4' => 37768.00,
                'step5' => 38160.00, 'step6' => 38557.00, 'step7' => 38959.00, 'step8' => 39367.00
            ],
            [
                'salary_grade' => 16,'step1' => 39672.00, 'step2' => 40088.00, 'step3' => 40509.00, 'step4' => 40935.00,
                'step5' => 41367.00, 'step6' => 41804.00, 'step7' => 42247.00, 'step8' => 42694.00
            ],
            [
                'salary_grade' => 17,'step1' => 43030.00, 'step2' => 43488.00, 'step3' => 43951.00, 'step4' => 44420.00,
                'step5' => 44895.00, 'step6' => 45376.00, 'step7' => 45862.00, 'step8' => 46355.00
            ],
            [
                'salary_grade' => 18,'step1' => 46725.00, 'step2' => 47228.00, 'step3' => 47738.00, 'step4' => 48253.00,
                'step5' => 48776.00, 'step6' => 49305.00, 'step7' => 49840.00, 'step8' => 50382.00
            ],
            [
                'salary_grade' => 19,'step1' => 51357.00, 'step2' => 52096.00, 'step3' => 52847.00, 'step4' => 53610.00,
                'step5' => 54386.00, 'step6' => 55174.00, 'step7' => 55976.00, 'step8' => 56790.00
            ],
            [
                'salary_grade' => 20,'step1' => 57347.00, 'step2' => 58181.00, 'step3' => 59030.00, 'step4' => 59892.00,
                'step5' => 60769.00, 'step6' => 61660.00, 'step7' => 62565.00, 'step8' => 63485.00
            ],
            [
                'salary_grade' => 21,'step1' => 63997.00, 'step2' => 64940.00, 'step3' => 65899.00, 'step4' => 66873.00,
                'step5' => 67864.00, 'step6' => 68870.00, 'step7' => 69893.00, 'step8' => 70933.00
            ],
            [
                'salary_grade' => 22,'step1' => 71511.00, 'step2' => 72577.00, 'step3' => 73661.00, 'step4' => 74762.00,
                'step5' => 75881.00, 'step6' => 77019.00, 'step7' => 78175.00, 'step8' => 79349.00
            ],
            [
                'salary_grade' => 23,'step1' => 80003.00, 'step2' => 81207.00, 'step3' => 82432.00, 'step4' => 83683.00,
                'step5' => 85049.00, 'step6' => 86437.00, 'step7' => 87847.00, 'step8' => 89281.00
            ],
            [
                'salary_grade' => 24,'step1' => 90078.00, 'step2' => 91548.00, 'step3' => 93043.00, 'step4' => 94562.00,
                'step5' => 96105.00, 'step6' => 97674.00, 'step7' => 99268.00, 'step8' => 100888.00
            ],
            [
                'salary_grade' => 25,'step1' => 102690.00, 'step2' => 104366.00, 'step3' => 106069.00, 'step4' => 107800.00,
                'step5' => 109560.00, 'step6' => 111348.00, 'step7' => 113166.00, 'step8' => 115012.00
            ],
            [
                'salary_grade' => 26,'step1' => 116040.00, 'step2' => 117933.00, 'step3' => 119858.00, 'step4' => 121814.00,
                'step5' => 123803.00, 'step6' => 125823.00, 'step7' => 127876.00, 'step8' => 129964.00
            ],
            [
                'salary_grade' => 27,'step1' => 131124.00, 'step2' => 133264.00, 'step3' => 135440.00, 'step4' => 137650.00,
                'step5' => 139897.00, 'step6' => 142180.00, 'step7' => 144501.00, 'step8' => 146859.00
            ],
            [
                'salary_grade' => 28,'step1' => 148171.00, 'step2' => 150589.00, 'step3' => 153047.00, 'step4' => 155545.00,
                'step5' => 158083.00, 'step6' => 160664.00, 'step7' => 163286.00, 'step8' => 165951.00
            ],
            [
                'salary_grade' => 29,'step1' => 167432.00, 'step2' => 170166.00, 'step3' => 172943.00, 'step4' => 175766.00,
                'step5' => 178634.00, 'step6' => 181550.00, 'step7' => 184513.00, 'step8' => 187525.00
            ],
            [
                'salary_grade' => 30,'step1' => 189199.00, 'step2' => 192286.00, 'step3' => 195425.00, 'step4' => 198615.00,
                'step5' => 201856.00, 'step6' => 205151.00, 'step7' => 208499.00, 'step8' => 211902.00
            ],
            [
                'salary_grade' => 31,'step1' => 278434.00, 'step2' => 283872.00, 'step3' => 289416.00, 'step4' => 295069.00,
                'step5' => 300833.00, 'step6' => 306708.00, 'step7' => 312699.00, 'step8' => 318806.00
            ],
            [
                'salary_grade' => 32,'step1' => 331954.00, 'step2' => 338649.00, 'step3' => 345478.00, 'step4' => 352445.00,
                'step5' => 359553.00, 'step6' => 366804.00, 'step7' => 374202.00, 'step8' => 381748.00
            ],
            [
                'salary_grade' => 33,'step1' => 419144.00, 'step2' => 431718.00, 'step3' => null, 'step4' => null,
                'step5' => null, 'step6' => null, 'step7' => null, 'step8' => null
            ]
        ];
    
        foreach ($salaryGradeData as $data) {
            SalaryGrade::create([
                'salary_grade' => $data['salary_grade'],
                'step1' => $data['step1'],
                'step2' => $data['step2'],
                'step3' => $data['step3'] ?? 0,
                'step4' => $data['step4'] ?? 0,
                'step5' => $data['step5'] ?? 0,
                'step6' => $data['step6'] ?? 0,
                'step7' => $data['step7'] ?? 0,
                'step8' => $data['step8'] ?? 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
