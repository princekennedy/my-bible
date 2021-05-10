<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Permission;

class CreatePermissionsTable extends Migration
{
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->softDeletes();
        });

        $permissions = [

            // User Management
            [
                'created_by' => 1,
                'id'    => 1,
                'name' => 'user_management_access',
            ],
            [
                'created_by' => 1,
                'id'    => 2,
                'name' => 'role_create',
            ],
            [
                'created_by' => 1,
                'id'    => 3,
                'name' => 'role_edit',
            ],
            [
                'created_by' => 1,
                'id'    => 4,
                'name' => 'role_show',
            ],
            [
                'created_by' => 1,
                'id'    => 5,
                'name' => 'role_delete',
            ],
            [
                'created_by' => 1,
                'id'    => 6,
                'name' => 'role_access',
            ],
            [
                'created_by' => 1,
                'id'    => 7,
                'name' => 'user_create',
            ],
            [
                'created_by' => 1,
                'id'    => 8,
                'name' => 'user_edit',
            ],
            [
                'created_by' => 1,
                'id'    => 9,
                'name' => 'user_show',
            ],
            [
                'created_by' => 1,
                'id'    => 10,
                'name' => 'user_delete',
            ],
            [
                'created_by' => 1,
                'id'    => 11,
                'name' => 'user_access',
            ],
            [
                'created_by' => 1,
                'id'    => 12,
                'name' => 'profile_password_edit',
            ],


            // Company
            [
                'created_by' => 1,
                'id'    => 50,
                'name' => 'company_access',
            ],
            [
                'created_by' => 1,
                'id'    => 51,
                'name' => 'company_create',
            ],
            [
                'created_by' => 1,
                'id'    => 52,
                'name' => 'company_edit',
            ],
            [
                'created_by' => 1,
                'id'    => 53,
                'name' => 'company_show',
            ],
            [
                'created_by' => 1,
                'id'    => 54,
                'name' => 'company_delete',
            ],


            // // Stock
            // [
            //     'created_by' => 1,
            //     'id'    => 60,
            //     'name' => 'stock_create',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => 61,
            //     'name' => 'stock_edit',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => 62,
            //     'name' => 'stock_show',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => 63,
            //     'name' => 'stock_delete',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => 64,
            //     'name' => 'stock_access',
            // ],


            // // Customer
            // [
            //     'created_by' => 1,
            //     'id'    => 70,
            //     'name' => 'customer_create',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => 71,
            //     'name' => 'customer_edit',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => 72,
            //     'name' => 'customer_show',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => 73,
            //     'name' => 'customer_delete',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => 74,
            //     'name' => 'customer_access',
            // ],


            // // Vendor
            // [
            //     'created_by' => 1,
            //     'id'    => 80,
            //     'name' => 'vendor_create',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => 81,
            //     'name' => 'vendor_edit',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => 82,
            //     'name' => 'vendor_show',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => 83,
            //     'name' => 'vendor_delete',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => 84,
            //     'name' => 'vendor_access',
            // ],


            // // Adverts
            // [
            //     'created_by' => 1,
            //     'id'    => 90,
            //     'name' => 'advert_create',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => 91,
            //     'name' => 'advert_edit',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => 92,
            //     'name' => 'advert_show',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => 93,
            //     'name' => 'advert_delete',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => 94,
            //     'name' => 'advert_access',
            // ],


            // // Dashboard
            // [
            //     'created_by' => 1,
            //     'id'    => 100,
            //     'name' => 'home_view',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => 101,
            //     'name' => 'analytics_view',
            // ],
    


            // =============================== Disabled
            // [
            //     'created_by' => 1,
            //     'id'    => '2',
            //     'name' => 'permission_create',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => '3',
            //     'name' => 'permission_edit',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => '4',
            //     'name' => 'permission_show',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => '5',
            //     'name' => 'permission_delete',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => '6',
            //     'name' => 'permission_access',
            // ],


            // [
            //     'created_by' => 1,
            //     'id'    => '22',
            //     'name' => 'team_create',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => '23',
            //     'name' => 'team_edit',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => '24',
            //     'name' => 'team_show',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => '25',
            //     'name' => 'team_delete',
            // ],
            // [
            //     'created_by' => 1,
            //     'id'    => '26',
            //     'name' => 'team_access',
            // ],



        ];


        Permission::insert($permissions);

    }
}
