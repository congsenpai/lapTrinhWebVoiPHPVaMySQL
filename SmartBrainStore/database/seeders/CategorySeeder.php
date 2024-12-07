<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Trái cây tươi', 'description' => 'Trái cây tươi siêu sạch'],
            ['name' => 'Trái cây đông lạnh', 'description' => 'Trái cây đông lạnh dùng trong nấu ăn'],
            ['name' => 'Trái cây sấy khô', 'description' => 'Trái cây sấy các loại siêu ngon'],
            ['name' => 'Trái cây chế biến', 'description' => 'Trái cây được chế biến thành những món hấp dẫn'],
            ['name' => 'Trái cây ngâm', 'description' => 'Trái cây được bảo quản theo cách ngậm nước'],
            ['name' => 'Quà tặng', 'description' => 'Quà tặng trái cây hấp dẫn'],
            ['name' => 'Trái cây nhập khẩu', 'description' => 'Trái cây nhập khẩu cao cấp'],
            ['name' => 'Trái cây đóng hộp', 'description' => 'Trái cây đóng hộp thiếc cao cấp'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
