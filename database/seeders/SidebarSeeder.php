<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Lead;

class SidebarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
  
        
    public function run(){
        Menu::truncate();
        $links = [
            [
                'menu_name' => 'File Upload',
                'parent_id' => '0',
                'url' => '/file-upload',
            ],
            [
                'menu_name' => 'Files List',
                'parent_id' => '0',
                'url' => '/files-list',
            ],
        ];
        foreach ($links as $key => $sidebar) {
            Menu::create($sidebar);
        }
     }
  }

