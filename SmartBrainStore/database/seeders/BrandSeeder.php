<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'SmartBrain', 'description' => 'Một sản phẩm của công ty SmartBrain chuyên cung cấp các giải pháp công nghệ cao cho nông sản.'],
            ['name' => 'Dole', 'description' => 'Dole là một thương hiệu nổi tiếng toàn cầu chuyên cung cấp các sản phẩm trái cây tươi và chế biến.'],
            ['name' => 'Del Monte', 'description' => 'Del Monte là thương hiệu nổi bật trong ngành thực phẩm, chuyên cung cấp trái cây tươi và đóng hộp.'],
            ['name' => 'Zespri', 'description' => 'Zespri là thương hiệu kiwi nổi tiếng đến từ New Zealand, được biết đến với chất lượng vượt trội.'],
            ['name' => 'Pink Lady', 'description' => 'Pink Lady là giống táo cao cấp với vị ngọt thanh và màu sắc đặc trưng, nổi bật trên toàn thế giới.'],
            ['name' => 'Tropicana', 'description' => 'Tropicana là thương hiệu nổi bật với các sản phẩm nước trái cây tươi ngon từ các loại trái cây tự nhiên.'],
            ['name' => 'Chiquita', 'description' => 'Chiquita là thương hiệu cung cấp chuối hàng đầu trên thế giới, nổi tiếng về chất lượng và tính bền vững.'],
            ['name' => 'Sunkist', 'description' => 'Sunkist là thương hiệu quả cam, chanh nổi tiếng với những sản phẩm tươi ngon, giàu vitamin C.'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
