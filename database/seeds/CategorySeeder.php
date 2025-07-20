<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
             [
                'category_name' => 'Pizza',
                'category_pic' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'category_name' => 'Biryani',
                'category_pic' => 'https://images.unsplash.com/photo-1550547660-d9450f859349',
            ],
            [
                'category_name' => 'Burgers',
                'category_pic' => 'https://images.unsplash.com/photo-1550547660-d9450f859349?auto=format&fit=crop&w=800&q=80',
            ],
           [
                'category_name' => 'Momo',
                'category_pic' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'category_name' => 'Fried Rice',
                'category_pic' => 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90'
            ],
            [
                'category_name' => 'Salads',
                'category_pic' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd'
            ],
            [
                'category_name' => 'Noodles',
                'category_pic' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836'
            ],
            [
                'category_name' => 'Chicken',
                'category_pic' => 'https://images.unsplash.com/photo-1600891964599-f61ba0e24092?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'category_name' => 'Desserts',
                'category_pic' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'category_name' => 'Beverages',
                'category_pic' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd'
            ],
            [
                'category_name' => 'Thali',
                'category_pic' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'category_name' => 'Grilled',
                'category_pic' => 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'category_name' => 'Pasta',
                'category_pic' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'category_name' => 'Sushi',
                'category_pic' => 'https://images.unsplash.com/photo-1553621042-f6e147245754?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'category_name' => 'Soup',
                'category_pic' => 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?auto=format&fit=crop&w=800&q=80'
            ],
         ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'category_name' => $category['category_name'],
                'category_pic' => $category['category_pic'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
