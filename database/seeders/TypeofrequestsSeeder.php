<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Typeofrequest;
use DB;

class TypeofrequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('typeofrequests')->insert([
            [
                'category' => 'Barangay ID',
                'typeofdoc' => 'Barangay ID',
                'price' => 100
            ],
            [
                'category' => 'Certificates',
                'typeofdoc' => 'Late Registration of Live Birth',
                'price' => 100
            ],
            [
                'category' => 'Certificates',
                'typeofdoc' => 'Public Attorneys Office (PAO)',
                'price' => 100
            ],
            [
                'category' => 'Certificates',
                'typeofdoc' => 'Medical Assistance',
                'price' => 50
            ],
            [
                'category' => 'Certificates',
                'typeofdoc' => 'Philippines Veterans Office (PVAO)',
                'price' => 90
            ],
            [
                'category' => 'Certificates',
                'typeofdoc' => 'Burial Assistance',
                'price' => 50
            ],
            [
                'category' => 'Certificates',
                'typeofdoc' => 'No Derogatory Record/Good Moral',
                'price' => 100
            ],
            [
                'category' => 'Certificates',
                'typeofdoc' => 'Actual Occupancy/Land Titling',
                'price' => 120
            ],
            [
                'category' => 'Certificates',
                'typeofdoc' => 'Residency',
                'price' => 120
            ],
            [
                'category' => 'Clearances',
                'typeofdoc' => 'Employment(Local/Abroad)',
                'price' => 100
            ],
            [
                'category' => 'Clearances',
                'typeofdoc' => 'Electrical(Residential/Commercial)',
                'price' => 120
            ],
            [
                'category' => 'Clearances',
                'typeofdoc' => 'Postal ID',
                'price' => 100
            ],
            [
                'category' => 'Clearances',
                'typeofdoc' => 'House(Construction/Renovation/Extension)',
                'price' => 110
            ],
            [
                'category' => 'Clearances',
                'typeofdoc' => 'Senior Citizen',
                'price' => 90
            ],
            [
                'category' => 'Clearances',
                'typeofdoc' => 'Fencing',
                'price' => 100
            ],
            [
                'category' => 'Clearances',
                'typeofdoc' => 'Business Closure',
                'price' => 100
            ],
            [
                'category' => 'Clearances',
                'typeofdoc' => 'House Assessment',
                'price' => 120
            ],
            [
                'category' => 'Clearances',
                'typeofdoc' => 'Business (New/Renewal) Registered Name',
                'price' => 100
            ],
            [
                'category' => 'Complaint',
                'typeofdoc' => 'Filling of Complaint',
                'price' => 20
            ],
            [
                'category' => 'Complaint',
                'typeofdoc' => 'Summon',
                'price' => 80
            ],
            [
                'category' => 'Complaint',
                'typeofdoc' => 'Mediation',
                'price' => 20
            ],
        ]);
    }
}
