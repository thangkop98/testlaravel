<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        // ProductCategory::truncate();

        ProductCategory::create([
            'name' => 'Giày nam',
            'description' => 'giày nam',
            'status' => 1,
            'slug' => 'giay-nam'
        ]);

        ProductCategory::create([
            'name' => 'Giày nữ',
            'description' => 'giày nữ',
            'status' => 1,
            'slug' => 'giay-nu'
        ]);

        ProductCategory::create([
            'name' => 'Giày thể thao',
            'description' => 'giày thể thao',
            'status' => 1,
            'slug' => 'giay-the-thao'
        ]);
    }
}
