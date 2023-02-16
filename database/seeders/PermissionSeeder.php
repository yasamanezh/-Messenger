<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

 Permission::create([
            'name' => 'show_language',
            'label' => 'show',
            'description' => 'languages',
        ]);
        Permission::create([
            'name' => 'edit_language',
            'label' => 'edit',
            'description' => 'language',
        ]);
        Permission::create([
            'name' => 'delete_language',
            'label' => 'delete',
            'description' => 'language',
        ]);

        Permission::create([
            'name' => 'show_contact',
            'label' => 'show',
            'description' => 'contact',
        ]);

        Permission::create([
            'name' => 'show_blog',
            'label' => 'show',
            'description' => 'blog category',
        ]);
        Permission::create([
            'name' => 'edit_blog',
            'label' => 'edit',
            'description' => 'blog category',
        ]);
        Permission::create([
            'name' => 'delete_blog',
            'label' => 'delete',
            'description' => 'blog category',
        ]);


        Permission::create([
            'name' => 'show_post',
            'label' => 'show',
            'description' => 'post',
        ]);
        Permission::create([
            'name' => 'edit_post',
            'label' => 'edit',
            'description' => 'post',
        ]);
        Permission::create([
            'name' => 'delete_post',
            'label' => 'delete',
            'description' => 'post',
        ]);
        Permission::create([
            'name' => 'show_page',
            'label' => 'show',
            'description' => 'page',
        ]);
        Permission::create([
            'name' => 'edit_page',
            'label' => 'edit',
            'description' => 'page',
        ]);


        Permission::create([
            'name' => 'delete_page',
            'label' => 'delete',
            'description' => 'page',
        ]);

        Permission::create([
            'name' => 'show_role',
            'label' => 'show',
            'description' => 'role',
        ]);
        Permission::create([
            'name' => 'edit_role',
            'label' => 'edit',
            'description' => 'role',
        ]);
        Permission::create([
            'name' => 'delete_role',
            'label' => 'delete',
            'description' => 'role',
        ]);

        Permission::create([
            'name' => 'show_design',
            'label' => 'show',
            'description' => 'design',
        ]);
        Permission::create([
            'name' => 'edit_design',
            'label' => 'edit',
            'description' => 'design',
        ]);
        Permission::create([
            'name' => 'delete_design',
            'label' => 'delete',
            'description' => 'design',
        ]);
        Permission::create([
            'name' => 'show_faq',
            'label' => 'show',
            'description' => 'faq',
        ]);
        Permission::create([
            'name' => 'edit_faq',
            'label' => 'edit',
            'description' => 'faq',
        ]);
        Permission::create([
            'name' => 'delete_faq',
            'label' => 'delete',
            'description' => 'faq',
        ]);

        Permission::create([
            'name' => 'show_option',
            'label' => 'show',
            'description' => 'packages option',
        ]);
        Permission::create([
            'name' => 'edit_option',
            'label' => 'edit',
            'description' => 'packages option',
        ]);
        Permission::create([
            'name' => 'delete_option',
            'label' => 'delete',
            'description' => 'packages option',
        ]);

        Permission::create([
            'name' => 'show_pack',
            'label' => 'show',
            'description' => 'packages',
        ]);
        Permission::create([
            'name' => 'edit_pack',
            'label' => 'edit',
            'description' => 'packages',
        ]);
        Permission::create([
            'name' => 'delete_pack',
            'label' => 'delete',
            'description' => 'packages',
        ]);

        Permission::create([
            'name' => 'show_comment',
            'label' => 'show',
            'description' => 'comment',
        ]);
        Permission::create([
            'name' => 'edit_comment',
            'label' => 'edit',
            'description' => 'comment',
        ]);
        Permission::create([
            'name' => 'delete_comment',
            'label' => 'delete',
            'description' => 'comment',
        ]);

        Permission::create([
            'name' => 'show_dashboard',
            'label' => 'show',
            'description' => 'dashboard',
        ]);

        Permission::create([
            'name' => 'edit_newsletter',
            'label' => 'edit',
            'description' => 'newsletter',
        ]);
        Permission::create([
            'name' => 'show_newsletter',
            'label' => 'show',
            'description' => 'newsletter',
        ]);
        Permission::create([
            'name' => 'delete_newsletter',
            'label' => 'delete',
            'description' => 'newsletter',
        ]);

        Permission::create([
            'name' => 'edit_AdminLogs',
            'label' => 'edit',
            'description' => 'Logs',
        ]);
        Permission::create([
            'name' => 'show_AdminLogs',
            'label' => 'show',
            'description' => 'Logs ',
        ]);
        Permission::create([
            'name' => 'delete_AdminLogs',
            'label' => 'delete',
            'description' => 'Logs ',
        ]);
        Permission::create([
            'name' => 'edit_ticket',
            'label' => 'edit',
            'description' => 'ticket',
        ]);
        Permission::create([
            'name' => 'show_ticket',
            'label' => 'show',
            'description' => 'ticket',
        ]);
        Permission::create([
            'name' => 'delete_ticket',
            'label' => 'delete',
            'description' => 'ticket',
        ]);


        Permission::create([
            'name' => 'show_user',
            'label' => 'show',
            'description' => 'user',
        ]);
        Permission::create([
            'name' => 'edit_user',
            'label' => 'edit',
            'description' => 'user',
        ]);
        
        
        Permission::create([
            'name' => 'delete_user',
            'label' => 'delete',
            'description' => 'user',
        ]);
         Permission::create([
            'name' => 'show_setting',
            'label' => 'show',
            'description' => 'setting',
        ]);
        Permission::create([
            'name' => 'edit_setting',
            'label' => 'edit',
            'description' => 'setting',
        ]);
        
    }

}
