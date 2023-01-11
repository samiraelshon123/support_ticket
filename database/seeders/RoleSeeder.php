<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //adminstrator
        $permission1 = [
            "Assign_Agent",
            "Add_Ticket",
            "Show_Ticket",
            "Update_Ticket",
            "Delete_Ticket",
            "Add_User",
            "Show_User",
            "Update_User",
            "Delete_User",
            "Add_Category",
            "Show_Category",
            "Update_Category",
            "Delete_Category",
            "Add_Label",
            "Show_Label",
            "Update_Label",
            "Delete_Label",
            "Add_Ticket_Logs",
            "Show_Ticket_Logs",
            "Update_Ticket_Logs",
            "Delete_Ticket_Logs",

        ];
        foreach ($permission1 as $value){
            Permission::create([
                "name"=>$value,
                "guard_name"=>"web"
            ]);
        }

        $role1 = [
            "name"=>"admin",
            "guard_name"=>"web"
        ];

        $role1 = Role::create($role1);

        $role1->givePermissionTo($permission1);

        // agent
        $permission2 = [


            "Show_Ticket",
            "Update_Ticket",

        ];


        $role2 = [
            "name"=>"agent",
            "guard_name"=>"web"
        ];

        $role2 = Role::create($role2);

        $role2->givePermissionTo($permission2);

        //reqular user

        $permission3 = [

            "Add_Ticket",
            "Show_Ticket",



        ];


        $role3 = [
            "name"=>"regular_user",
            "guard_name"=>"web"
        ];

        $role3 = Role::create($role3);

        $role3->givePermissionTo($permission3);
    }
}
