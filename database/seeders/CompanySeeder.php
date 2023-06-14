<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=10;$i++){
            $company = new Company();
            $company->name = 'Company '.$i;
            $company->email = 'company'.$i.'@gmail.com';
            $company->logo = 'company'.$i.'.jpg';
            $company->website='http://www.company'.$i.'.com';
            $company->save();
        }
    }
}
