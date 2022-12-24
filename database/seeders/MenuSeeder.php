<?php

namespace Database\Seeders;

use App\Models\GroupMenus;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{    
    public function run()
    {
        $menus = [
            [
                "group" => 'ព័ត៌មានទូទៅ',
                "is_admin" => 0,
                "data"  => [
                    [
                        "label"         => "កម្ចីសរុប",
                        "permission"    => "dashboard",
                        "url"           => 'dashboard',
                        "active_url"    => "dashboard/*",
                        "icon"          => "dashboard",
                        "url_id"        => "URL001",
                        "childs"        => [],
                    ]
                ],
            ],
            
            [
                "group" => "ប្រតិបត្តិការ",
                "is_admin" => 0,
                "data"  => [
                    [
                        "label"         => "កម្ចី",
                        "permission"    => "",
                        "url"           => "",
                        "active_url"    => "loan/*",
                        "icon"          => "attach_money",
                        "childs"        => [
                            [
                                "label"         => "កន្លះខែ",
                                "permission" => "loan.half-monthly.create",
                                "url" => 'loan.half-monthly.create',
                                "active_url" => "loan/half-monthly/*",
                                "url_id"        => "URL018",
                            ],
                            [
                                "label"         => "ពីរសប្តាហ៍",
                                "permission" => "loan.twice-weekly.create",
                                "url" => 'loan.twice-weekly.create',
                                "active_url" => "loan/twice-weekly/*",
                                "url_id"        => "URL027",
                            ],
                            [
                                "label" => "សប្តាហ៍",
                                "permission" => "loan.weekly-create",
                                "url" => 'loan.weekly.create',
                                "active_url" => "loan/weekly/*",
                                "url_id"        => "URL031",
                            ],
                            [
                                "label" => "ប្រចាំថ្ងៃ",
                                "permission" => "loan.daily-create",
                                "url" => 'loan.daily.create',
                                "active_url" => "loan/daily/*",
                                "url_id"        => "URL012",
                            ],
                            [
                                "label" => "តារាង",
                                "permission" => "loan-list",
                                "url" => 'loan.list.index',
                                "active_url" => "loan/list/*",
                                "url_id"        => "URL021",
                            ],
                        ],
                    ],                    
                    [
                        "label" => "បង់ប្រាក់",
                        "permission" => "",
                        "url" => "",
                        "active_url" => "payment/*",
                        "icon" => "paid",
                        "childs" => [
                            [
                                "label" => "បង់ការ",
                                "permission" => "payment.interest.index",
                                "url" => 'payment.interest.index',
                                "active_url" => "payment/interest/*",
                                "url_id"        => "URL071",
                            ],
                            [
                                "label" => "បង់ផ្តាច់",
                                "permission" => "payment.deduction",
                                "url" => 'payment.deduction.index',
                                "active_url" => "payment/deduction/*",
                                "url_id"        => "URL065",
                            ],
                            [
                                "label" => "តារាង",
                                "permission" => "payment.list.index",
                                "url" => 'payment.list.index',
                                "active_url" => "payment/list/*",
                                "url_id"        => "URL074",
                            ],

                        ],
                    ],                    
                    [
                        "label" => "ចំណាយ",
                        "permission" => "",
                        "url" => '',
                        "active_url" => "expense/*",
                        "icon" => "receipt_long",
                        "childs" => [                                                        
                            [
                                "label" => "ចំណាយ",
                                "permission" => "expenses-index",
                                "url" => 'expense.item.index',
                                "active_url" => "expense/item/*",
                                "url_id"        => "URL004",
                            ]
                        ],
                    ]
                ]
            ],           
            [
                "group" => "របាយការណ៍",
                "is_admin" => 0,
                "data" => [
                    [
                        "label" => "ចំនូល",
                        "permission" => "",
                        "url" => "",
                        "active_url" => "report-financial/*",
                        "icon" => "request_quote",
                        "childs" => [
                            [
                                "label" => "ការប្រាក់",
                                "permission" => "report.monthly",
                                "url" => 'report-financial.revenue-interest',
                                "active_url" => "report-financial/revenue-interest/*",
                                "url_id"        => "URL078",
                            ],
                            [
                                "label" => "សេវារដ្ឋបាល",
                                "permission" => "report-financial.close",
                                "url" => 'report-financial.revenue-admin-fee',
                                "active_url" => "report-financial/revenue-admin-fee/*",
                                "url_id"        => "URL076",
                            ],
                            [
                                "label" => "ចំណាយ",
                                "permission" => "report.principal",
                                "url" => 'report-financial.expense',
                                "active_url" => "report-financial/expense/*",
                                "url_id"        => "URL075",
                            ],
                            [
                                "label" => "ភាគលាភ",
                                "permission" => "report-financial.principal",
                                "url" => 'report-financial.revenue-dividend',
                                "active_url" => "report-financial/revenue-dividend/*",
                                "url_id"        => "URL077",
                            ],                           
                        ],
                    ],
                    [
                        "label" => "ប្រតិបត្តិការ",
                        "permission" => "",
                        "url" => "",
                        "active_url" => "report-operation/*",
                        "icon" => "assignment",
                        "childs" => [
                            [
                                "label" => "កម្ចី",
                                "permission" => "report.monthly",
                                "url" => 'report-operation.loan',
                                "active_url" => "report-operation/loan/*",
                                "url_id"        => "URL080",
                            ],
                        ],
                    ],
                    [
                        "label" => "បុគ្គលិក",
                        "permission" => "",
                        "url" => "",
                        "active_url" => "staff/*",
                        "icon" => "contact_page",
                        "childs" => [
                            [
                                "label" => "ស្ថិតិកម្ចី",
                                "permission" => "staff.index",
                                "url" => 'report-staff.statistic',
                                "active_url" => "report-staff/statistic/*",
                                "url_id"        => "URL085",
                            ],
                            [
                                "label" => "ការប្រាក់",
                                "permission" => "staff.index",
                                "url" => 'report-staff.revenue-interest',
                                "active_url" => "report-staff/revenue-interest/*",
                                "url_id"        => "URL083",
                            ],
                            [
                                "label" => "សេវារដ្ឋបាល",
                                "permission" => "staff.index",
                                "url" => 'report-staff.revenue-admin-fee',
                                "active_url" => "report-staff/revenue-admin-fee/*",
                                "url_id"        => "URL082",
                            ],
                        ],
                    ],
                ]
            ],
                      
            [
                "group" => "គ្រប់គ្រងប្រព័ន្ធ",
                "is_admin" => 0,
                "data" => [
                    [
                        "label" => "កំណត់ហេតុ",
                        "permission" => "",
                        "url" => "",
                        "active_url" => "payment-log/*",
                        "icon" => "history",
                        "childs" => [                            
                            [
                                "label" => "បង់ផ្តាច់",
                                "permission" => "payment.deduction",
                                "url" => 'payment-log.deduction',
                                "active_url" => "payment-log/deduction/*",
                                "url_id"        => "URL063",
                            ],                          
                        ],
                    ],
                    [
                        "label" => "ទិន្នន័យមេ",
                        "permission" => "",
                        "url" => '',
                        "active_url" => "master-data/*",
                        "icon" => "settings",
                        "childs" => [
                            [
                                "label" => "ភាគហ៊ុន",
                                "permission" => "deposits-index",
                                "url" => 'master-data.deposit.index',
                                "active_url" => "master-data/deposit/*",
                                "url_id"        => "URL041",
                            ],
                            [
                                "label" => "សាខា",
                                "permission" => "branches-index",
                                "url" => 'master-data.branch.index',
                                "active_url" => "master-data/branch/*",
                                "url_id"        => "URL035",
                            ],
                            [
                                "label" => "បុគ្គលិក",
                                "permission" => "staff.index",
                                "url" => 'master-data.staff.index',
                                "active_url" => "master-data/staff/*",
                                "url_id"        => "URL055",
                            ],
                            [
                                "label" => "ប្រភេទចំណាយ",
                                "permission" => "staff.index",
                                "url" => 'master-data.expense-type.index',
                                "active_url" => "master-data/expense-type/*",
                                "url_id"        => "URL049",
                            ],
                        ],
                    ],
                    [
                        "label" => "អ្នកបើប្រាស់",
                        "permission" => "",
                        "url" => '',
                        "active_url" => "user/*",
                        "icon" => "manage_accounts",
                        "childs" => [
                            [
                                "label" => "បញ្ជូលថ្មី",
                                "permission" => "users-create",
                                "url" => 'user.create',
                                "active_url" => "user/create/*",
                                "url_id"        => "URL088",
                            ],
                            [
                                "label" => "តារាង",
                                "permission" => "users-index",
                                "url" => 'user.index',
                                "active_url" => "user/index/*",
                                "url_id"        => "URL086",
                            ]
                        ],
                    ]
                ]
            ],                                 
        ];
        
        foreach ( $menus as $menu ){
            // create new group and get group_id
            $group = new GroupMenus();
            $group->name = $menu['group'] ?? '';
            $group->is_admin = $menu['is_admin'] ?? 0;
            $group->save();
            
            // create data
            foreach ( $menu['data'] as $data ){
                // insert menu // parent
                $parent = new Menu();
                $parent->label = $data['label'] ?? '';
                $parent->permission = $data['permission'] ?? '';
                $parent->url = $data['url'] ?? '';
                $parent->active_url = $data['active_url'] ?? '';
                $parent->icon = $data['icon'] ?? '';
                $parent->group_id = $group->id ?? '';
                $parent->url_id = $data['url_id'] ?? null;
                $parent->save();
                // if has child
                if( count($data['childs'] ) > 0 ){
                    foreach ( $data['childs'] as $child ){
                        $children = new \App\Models\Menu();
                        $children->label = $child['label'] ?? '';
                        $children->permission = $child['permission'] ?? '';
                        $children->url = $child['url'] ?? '';
                        $children->active_url = $child['active_url'] ?? '';
                        $children->icon = $child['icon'] ?? '';
                        $children->parent_id = $parent->id ?? '';
                        $children->url_id = $child['url_id'] ?? null;
                        $children->save();
                    }
                }
            }
        }
    }
}
