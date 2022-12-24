<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\DocumentType;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Sex;
use App\Models\StaffStatus;
use App\Models\ClientStatus;
use App\Models\ExpenseType;
use App\Models\LoanStatus;
use App\Models\Staff;
use App\Models\PaymentStatus;

class SetupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->storeExpenseType();
        // branch
        $branches = getBackupData('branches');

        $this->storeBranch($branches);

        Sex::insert([
            [
                'id' => 'M',
                'name' => 'ប្រុស',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'F',
                'name' => 'ស្រី',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        StaffStatus::insert([
            [
                'id' => 'active',
                'name' => 'បើក',
                'css' => 'badge badge-success',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'inactive',
                'name' => 'បិទ',
                'css' => 'badge badge-danger',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        ClientStatus::insert([
            [
                'id' => 'active',
                'name' => 'បើក',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'inactive',
                'name' => 'បិទ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        LoanStatus::insert([
            [
                'id' => 'pending',
                'name' => 'កម្ចីថ្មី',
                'css' => 'badge badge-primary',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'progress',
                'name' => 'កំពុងដំណើការ',
                'css' => 'badge badge-info',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'finish',
                'name' => 'បញ្ចប់',
                'css' => 'badge badge-danger',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        PaymentStatus::insert([
            [
                'id' => 'pending',
                'name' => 'មិនទាន់បង់',
                'css' => 'badge badge-info',
                'visible' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'paid',
                'name' => 'បង់រួច',
                'css' => 'badge badge-success',
                'visible' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'late',
                'name' => 'យឺត',
                'css' => 'badge badge-danger',
                'visible' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'lack',
                'name' => 'បង់ទុក',
                'css' => 'badge badge-warning',
                'visible' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'finish',
                'name' => 'បញ្ចប់',
                'css' => 'badge badge-danger',
                'visible' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        DocumentType::insert(
            [
                [
                    'id'    => 'DRIVER_LICENSE',
                    'name'  => 'បណ្ណបើកបរ',
                ],
                [
                    'id'    => 'PASSPORT',
                    'name'  => 'លិខិតឆ្លងដែន',
                ],
                [
                    'id'    => 'NATIONAL_ID',
                    'name'  => 'អត្តសញ្ញាណប័ណ្ណ',
                ],
            ]
        );
        $staffs = getBackupData('staffs');
        $this->storeStaff($staffs);
    }

    private function storeExpenseType()
    {
        $file = json_decode(file_get_contents(base_path('database/seeders/Data/expense_types.json')), true);
        $data = [];
        foreach ($file['RECORDS'] as $item) {
            $data [] = [
                'id' => $item['id'],
                'name_kh' => $item['name_kh'],
                'name_en' => $item['name_en'],

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];

        }

        $chunks = array_chunk($data, 5000);
        foreach ($chunks as $chunk) {
            ExpenseType::insert($chunk);
        }
    }

    private function storeBranch($branches)
    {
        $data = [];
        foreach ($branches as $item) {
            $data[] = [
                'id' => $item['id'],
                'code' => $item['code'],
                'name' => $item['name'],
                'description' => $item['description'],

                'created_at' => $item['created_at'],
                'updated_at' => $item['updated_at'],
                'deleted_at' => $item['deleted_at'],
            ];
        }
        $chunks = array_chunk($data, 1000);
        foreach ($chunks as $chunk) {
            Branch::insert($chunk);
        }
    }

    private function storeStaff($staffs)
    {
        $data = [];
        foreach ($staffs as $item) {
            $data[] = [
                'id' => $item['id'],
                // 'code' => $item['code'],
                'name_en' => $item['name_en'],
                'name_kh' => $item['name_kh'],
                'sex' => $item['sex'],
                'date_of_birth' => $item['date_of_birth'],
                'phone_number' => $item['phone_number'],
                'start_work_date' => $item['start_work_date'],
                'status' => $item['status'],
                'branch_id' => $item['branch_id'],

                'created_at' => $item['created_at'],
                'updated_at' => $item['updated_at'],
                'deleted_at' => $item['deleted_at'],
            ];
        }
        $chunks = array_chunk($data, 1000);
        foreach ($chunks as $chunk) {
            Staff::insert($chunk);
        }
    }
}
