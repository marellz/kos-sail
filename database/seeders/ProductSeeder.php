<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductSpecification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $brands = [
            'Total',
            'Tolsen',
            'Bosch',
            'DeWalt',
            'Makita',
            'Milwaukee',
            'Black+Decker',
            'Ryobi',
            'Craftsman',
            'Hitachi',
            'Stanley',
            'Ridgid',
        ];

        $specifications = [
            'material',
            'color',
            'weight',
            'dimensions',
            'power',
            'voltage',
            'speed',
            'battery'
        ];

        $products = [
            [
                'name' => 'Cordless Drill',
                'slug' => 'cordless-drill',
                'short_description' => 'A powerful cordless drill for all your DIY needs.',
                'description' => 'This cordless drill is perfect for home improvement projects. With a powerful 18V battery, it delivers exceptional performance.',
                'category_id' => 1,
                'brand_id' => 1,
                'featured_image' => '/images/products/cordless-drill.jpg',
                'images' => json_encode([
                    '/images/products/cordless-drill-1.jpg',
                    '/images/products/cordless-drill-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '500W',
                    'Battery' => '18V',
                    'Speed' => '0-1500 RPM'
                ]),
                'price' => 16000,
                'discount_price' => 12500,
                'in_stock' => true,
                'visible' => true,
            ],
            [
                'name' => 'Electric Chainsaw',
                'slug' => 'electric-chainsaw',
                'short_description' => 'A high-performance electric chainsaw for cutting wood effortlessly.',
                'description' => 'This electric chainsaw features a powerful motor and a sharp chain, making it ideal for cutting through thick wood.',
                'category_id' => 2,
                'brand_id' => 2,
                'featured_image' => '/images/products/electric-chainsaw.jpg',
                'images' => json_encode([
                    '/images/products/electric-chainsaw-1.jpg',
                    '/images/products/electric-chainsaw-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '2000W',
                    'Bar Length' => '18 inches',
                    'Weight' => '12 lbs'
                ]),
                'price' => 15000,
                'discount_price' => 13000,
                'in_stock' => true,
                'visible' => true,
            ],
            [
                'name' => 'Garden Shovel',
                'slug' => 'garden-shovel',
                'short_description' => 'A sturdy garden shovel for all your planting needs.',
                'description' => 'This garden shovel is designed for durability and comfort, making it perfect for all types of soil.',
                'category_id' => 3,
                'brand_id' => 5,
                'featured_image' => '/images/products/garden-shovel.jpg',
                'images' => json_encode([
                    '/images/products/garden-shovel-1.jpg',
                    '/images/products/garden-shovel-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Material' => 'Steel',
                    'Handle' => 'Wooden',
                    'Length' => '40 inches'
                ]),
                'price' => 3500,
                'discount_price' => null,
                'in_stock' => true,
                'visible' => true,
            ],
            [
                'name' => 'Carwash machine',
                'slug' => 'carwash-machine',
                'short_description' => 'A high-pressure washer for tough cleaning jobs.',
                'description' => 'This pressure washer is powerful enough to remove stubborn dirt and grime from any surface.',
                'category_id' => 4,
                'brand_id' => 1,
                'featured_image' => '/images/products/pressure-washer.jpg',
                'images' => json_encode([
                    '/images/products/pressure-washer-1.jpg',
                    '/images/products/pressure-washer-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Pressure' => '2500 PSI',
                    'Flow Rate' => '2.5 GPM',
                    'Power' => 'Electric'
                ]),
                'price' => 20000,
                'discount_price' => 18500,
                'in_stock' => true,
                'visible' => true,
            ],
            [
                'name' => 'Lawn Mower',
                'slug' => 'lawn-mower',
                'short_description' => 'A reliable lawn mower for maintaining a neat lawn.',
                'description' => 'This lawn mower provides a clean cut every time, making lawn maintenance easy and efficient.',
                'category_id' => 5,
                'brand_id' => 2,
                'featured_image' => '/images/products/lawn-mower.jpg',
                'images' => json_encode([
                    '/images/products/lawn-mower-1.jpg',
                    '/images/products/lawn-mower-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => 'Gasoline',
                    'Cutting Width' => '21 inches',
                    'Weight' => '50 lbs'
                ]),
                'price' => 28500,
                'discount_price' => null,
                'in_stock' => true,
                'visible' => true,
            ],
            [
                'name' => 'Leaf Blower',
                'slug' => 'leaf-blower',
                'short_description' => 'A powerful leaf blower for clearing leaves and debris.',
                'description' => 'This leaf blower features a high-speed motor and ergonomic design for easy use.',
                'category_id' => 6,
                'brand_id' => 3,
                'featured_image' => '/images/products/leaf-blower.jpg',
                'images' => json_encode([
                    '/images/products/leaf-blower-1.jpg',
                    '/images/products/leaf-blower-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '1500W',
                    'Air Speed' => '200 MPH',
                    'Weight' => '8 lbs'
                ]),
                'price' => 6900,
                'discount_price' => null,
                'in_stock' => false,
                'visible' => true,
            ],
            [
                'name' => 'Hedge Trimmer',
                'slug' => 'hedge-trimmer',
                'short_description' => 'A precise hedge trimmer for maintaining neat hedges.',
                'description' => 'This hedge trimmer offers sharp blades and a lightweight design for easy handling.',
                'category_id' => 7,
                'brand_id' => 5,
                'featured_image' => '/images/products/hedge-trimmer.jpg',
                'images' => json_encode([
                    '/images/products/hedge-trimmer-1.jpg',
                    '/images/products/hedge-trimmer-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Blade Length' => '24 inches',
                    'Power' => 'Electric',
                    'Weight' => '7 lbs'
                ]),
                'price' => 8000,
                'discount_price' => null,
                'in_stock' => true,
                'visible' => true,
            ],
            [
                'name' => 'Snow Blower',
                'slug' => 'snow-blower',
                'short_description' => 'A powerful snow blower for clearing snow efficiently.',
                'description' => 'This snow blower is designed to handle heavy snowfall and clear paths quickly.',
                'category_id' => 8,
                'brand_id' => 4,
                'featured_image' => '/images/products/snow-blower.jpg',
                'images' => json_encode([
                    '/images/products/snow-blower-1.jpg',
                    '/images/products/snow-blower-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => 'Gasoline',
                    'Clearing Width' => '28 inches',
                    'Weight' => '80 lbs'
                ]),
                'price' => 5000,
                'discount_price' => 3900,
                'in_stock' => true,
                'visible' => true,
            ],
            [
                'name' => 'Circular Saw',
                'slug' => 'circular-saw',
                'short_description' => 'A versatile circular saw for all your cutting needs.',
                'description' => 'This circular saw features a powerful motor and sharp blade, perfect for cutting wood and other materials.',
                'category_id' => 9,
                'brand_id' => 1,
                'featured_image' => '/images/products/circular-saw.jpg',
                'images' => json_encode([
                    '/images/products/circular-saw-1.jpg',
                    '/images/products/circular-saw-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '1200W',
                    'Blade Diameter' => '7.25 inches',
                    'Speed' => '5000 RPM'
                ]),
                'price' => 9000,
                'discount_price' => null,
                'in_stock' => true,
                'visible' => true,
            ],
            [
                'name' => 'Screwdriver Set',
                'slug' => 'screwdriver-set',
                'short_description' => 'A comprehensive set of screwdrivers for various tasks.',
                'description' => 'This screwdriver set includes multiple sizes and types, perfect for any job.',
                'category_id' => 10,
                'brand_id' => 3,
                'featured_image' => '/images/products/screwdriver-set.jpg',
                'images' => json_encode([
                    '/images/products/screwdriver-set-1.jpg',
                    '/images/products/screwdriver-set-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Material' => 'Steel',
                    'Handle' => 'Ergonomic'
                ]),
                'price' => 1300,
                'discount_price' => null,
                'in_stock' => false,
                'visible' => true,
            ],

            [
                'name' => 'Cordless Screwdriver',
                'slug' => 'cordless-screwdriver',
                'short_description' => 'Compact cordless screwdriver for quick fixes.',
                'description' => 'This cordless screwdriver is ideal for quick and easy repairs around the house. Lightweight and easy to use.',
                'category_id' => 1,
                'brand_id' => 1,
                'featured_image' => '/images/products/cordless-screwdriver.jpg',
                'images' => json_encode([
                    '/images/products/cordless-screwdriver-1.jpg',
                    '/images/products/cordless-screwdriver-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '200W',
                    'Battery' => '12V',
                    'Speed' => '0-1200 RPM'
                ]),
                'price' => 2000,
                'discount_price' => 1800,
                'in_stock' => true,
                'visible' => true,
            ],
            [
                'name' => 'Hammer Drill',
                'slug' => 'hammer-drill',
                'short_description' => 'Heavy-duty hammer drill for concrete and masonry.',
                'description' => 'This hammer drill is powerful enough to handle concrete and masonry drilling with ease. Comes with a set of drill bits.',
                'category_id' => 2,
                'brand_id' => 2,
                'featured_image' => '/images/products/hammer-drill.jpg',
                'images' => json_encode([
                    '/images/products/hammer-drill-1.jpg',
                    '/images/products/hammer-drill-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '800W',
                    'Speed' => '0-3000 RPM',
                    'Hammering Rate' => '0-45000 BPM'
                ]),
                'price' => 8000,
                'discount_price' => null,
                'in_stock' => true,
                'visible' => true,
            ],
            [
                'name' => 'Angle Grinder',
                'slug' => 'angle-grinder',
                'short_description' => 'Versatile angle grinder for cutting and grinding.',
                'description' => 'This angle grinder is perfect for cutting and grinding various materials. It comes with a safety guard and side handle.',
                'category_id' => 3,
                'brand_id' => 1,
                'featured_image' => '/images/products/angle-grinder.jpg',
                'images' => json_encode([
                    '/images/products/angle-grinder-1.jpg',
                    '/images/products/angle-grinder-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '750W',
                    'Disc Diameter' => '4.5 inches',
                    'Speed' => '11000 RPM'
                ]),
                'price' => 5000,
                'discount_price' => 4500,
                'in_stock' => false,
                'visible' => true,
            ],
            [
                'name' => 'Jigsaw',
                'slug' => 'jigsaw',
                'short_description' => 'Precision jigsaw for intricate cutting tasks.',
                'description' => 'This jigsaw is designed for precision cutting. It is perfect for woodworking and other intricate cutting tasks.',
                'category_id' => 4,
                'brand_id' => 2,
                'featured_image' => '/images/products/jigsaw.jpg',
                'images' => json_encode([
                    '/images/products/jigsaw-1.jpg',
                    '/images/products/jigsaw-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '500W',
                    'Stroke Length' => '20mm',
                    'Speed' => '0-3000 SPM'
                ]),
                'price' => 4000,
                'discount_price' => null,
                'in_stock' => true,
                'visible' => false,
            ],
            [
                'name' => 'Table Saw',
                'slug' => 'table-saw',
                'short_description' => 'Professional table saw for accurate cuts.',
                'description' => 'This table saw provides accurate and smooth cuts. Ideal for professional carpentry and woodworking.',
                'category_id' => 5,
                'brand_id' => 3,
                'featured_image' => '/images/products/table-saw.jpg',
                'images' => json_encode([
                    '/images/products/table-saw-1.jpg',
                    '/images/products/table-saw-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '1500W',
                    'Blade Diameter' => '10 inches',
                    'Speed' => '4800 RPM'
                ]),
                'price' => 25000,
                'discount_price' => 23000,
                'in_stock' => true,
                'visible' => true,
            ],
            [
                'name' => 'Tile Cutter',
                'slug' => 'tile-cutter',
                'short_description' => 'Efficient tile cutter for ceramic and porcelain.',
                'description' => 'This tile cutter is designed for precise cutting of ceramic and porcelain tiles. It features a robust construction for durability.',
                'category_id' => 6,
                'brand_id' => 4,
                'featured_image' => '/images/products/tile-cutter.jpg',
                'images' => json_encode([
                    '/images/products/tile-cutter-1.jpg',
                    '/images/products/tile-cutter-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Cutting Capacity' => '24 inches',
                    'Type' => 'Manual',
                    'Weight' => '15 lbs'
                ]),
                'price' => 10000,
                'discount_price' => null,
                'in_stock' => false,
                'visible' => true,
            ],
            [
                'name' => 'Sledgehammer',
                'slug' => 'sledgehammer',
                'short_description' => 'Heavy-duty sledgehammer for demolition work.',
                'description' => 'This sledgehammer is built for heavy-duty demolition work. It features a durable head and a comfortable grip handle.',
                'category_id' => 7,
                'brand_id' => 5,
                'featured_image' => '/images/products/sledgehammer.jpg',
                'images' => json_encode([
                    '/images/products/sledgehammer-1.jpg',
                    '/images/products/sledgehammer-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Weight' => '10 lbs',
                    'Handle' => 'Fiberglass',
                    'Length' => '36 inches'
                ]),
                'price' => 3000,
                'discount_price' => 2700,
                'in_stock' => true,
                'visible' => true,
            ],
            [
                'name' => 'Rotary Tool',
                'slug' => 'rotary-tool',
                'short_description' => 'Multi-purpose rotary tool for detailed work.',
                'description' => 'This rotary tool is perfect for detailed work such as engraving, polishing, and cutting. It includes a variety of attachments.',
                'category_id' => 8,
                'brand_id' => 2,
                'featured_image' => '/images/products/rotary-tool.jpg',
                'images' => json_encode([
                    '/images/products/rotary-tool-1.jpg',
                    '/images/products/rotary-tool-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '200W',
                    'Speed' => '5000-35000 RPM',
                    'Weight' => '1.5 lbs'
                ]),
                'price' => 3500,
                'discount_price' => null,
                'in_stock' => true,
                'visible' => false,
            ],
            [
                'name' => 'Socket Wrench Set',
                'slug' => 'socket-wrench-set',
                'short_description' => 'Complete socket wrench set for mechanics.',
                'description' => 'This socket wrench set includes a variety of sizes and types. Perfect for automotive and mechanical work.',
                'category_id' => 9,
                'brand_id' => 3,
                'featured_image' => '/images/products/socket-wrench-set.jpg',
                'images' => json_encode([
                    '/images/products/socket-wrench-set-1.jpg',
                    '/images/products/socket-wrench-set-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Material' => 'Chrome Vanadium Steel',
                    'Sizes' => '10-32mm',
                    'Case' => 'Plastic'
                ]),
                'price' => 12000,
                'discount_price' => 11000,
                'in_stock' => false,
                'visible' => true,
            ],
            [
                'name' => 'Corded Drill',
                'slug' => 'corded-drill',
                'short_description' => 'Reliable corded drill for continuous power.',
                'description' => 'This corded drill provides continuous power for demanding tasks. It comes with a set of drill bits and accessories.',
                'category_id' => 10,
                'brand_id' => 1,
                'featured_image' => '/images/products/corded-drill.jpg',
                'images' => json_encode([
                    '/images/products/corded-drill-1.jpg',
                    '/images/products/corded-drill-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '600W',
                    'Speed' => '0-2800 RPM',
                    'Chuck Size' => '13mm'
                ]),
                'price' => 7000,
                'discount_price' => null,
                'in_stock' => true,
                'visible' => true,
            ],
            [
                'name' => 'Reciprocating Saw',
                'slug' => 'reciprocating-saw',
                'short_description' => 'Versatile reciprocating saw for cutting wood and metal.',
                'description' => 'This reciprocating saw is perfect for cutting wood and metal. It features variable speed control for precise cutting.',
                'category_id' => 11,
                'brand_id' => 2,
                'featured_image' => '/images/products/reciprocating-saw.jpg',
                'images' => json_encode([
                    '/images/products/reciprocating-saw-1.jpg',
                    '/images/products/reciprocating-saw-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '850W',
                    'Speed' => '0-3000 SPM',
                    'Stroke Length' => '28mm'
                ]),
                'price' => 9000,
                'discount_price' => 8500,
                'in_stock' => true,
                'visible' => false,
            ],
            [
                'name' => 'Heat Gun',
                'slug' => 'heat-gun',
                'short_description' => 'Adjustable heat gun for various applications.',
                'description' => 'This heat gun offers adjustable temperature settings for various applications such as paint removal and plastic welding.',
                'category_id' => 12,
                'brand_id' => 4,
                'featured_image' => '/images/products/heat-gun.jpg',
                'images' => json_encode([
                    '/images/products/heat-gun-1.jpg',
                    '/images/products/heat-gun-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '1500W',
                    'Temperature' => '60-600°C',
                    'Weight' => '0.8 kg'
                ]),
                'price' => 3000,
                'discount_price' => null,
                'in_stock' => false,
                'visible' => true,
            ],
            [
                'name' => 'Electric Planer',
                'slug' => 'electric-planer',
                'short_description' => 'High-speed electric planer for smooth surfaces.',
                'description' => 'This electric planer provides high-speed performance for smooth and even surfaces. Ideal for woodworking projects.',
                'category_id' => 13,
                'brand_id' => 3,
                'featured_image' => '/images/products/electric-planer.jpg',
                'images' => json_encode([
                    '/images/products/electric-planer-1.jpg',
                    '/images/products/electric-planer-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '900W',
                    'Planing Width' => '82mm',
                    'Speed' => '16000 RPM'
                ]),
                'price' => 15000,
                'discount_price' => 14000,
                'in_stock' => true,
                'visible' => true,
            ],
            [
                'name' => 'Mitre Saw',
                'slug' => 'mitre-saw',
                'short_description' => 'Accurate mitre saw for angled cuts.',
                'description' => 'This mitre saw provides accurate angled cuts. It is ideal for framing, molding, and other woodworking tasks.',
                'category_id' => 14,
                'brand_id' => 1,
                'featured_image' => '/images/products/mitre-saw.jpg',
                'images' => json_encode([
                    '/images/products/mitre-saw-1.jpg',
                    '/images/products/mitre-saw-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '1400W',
                    'Blade Diameter' => '10 inches',
                    'Speed' => '4500 RPM'
                ]),
                'price' => 20000,
                'discount_price' => null,
                'in_stock' => false,
                'visible' => true,
            ],
            [
                'name' => 'Palm Sander',
                'slug' => 'palm-sander',
                'short_description' => 'Lightweight palm sander for smooth finishes.',
                'description' => 'This palm sander is lightweight and easy to handle. It is perfect for achieving smooth finishes on various surfaces.',
                'category_id' => 15,
                'brand_id' => 2,
                'featured_image' => '/images/products/palm-sander.jpg',
                'images' => json_encode([
                    '/images/products/palm-sander-1.jpg',
                    '/images/products/palm-sander-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '200W',
                    'Speed' => '14000 OPM',
                    'Weight' => '1 kg'
                ]),
                'price' => 2500,
                'discount_price' => 2200,
                'in_stock' => true,
                'visible' => false,
            ],
            [
                'name' => 'Bench Grinder',
                'slug' => 'bench-grinder',
                'short_description' => 'Heavy-duty bench grinder for sharpening tools.',
                'description' => 'This bench grinder is ideal for sharpening tools and other grinding tasks. It features a powerful motor and adjustable tool rests.',
                'category_id' => 16,
                'brand_id' => 3,
                'featured_image' => '/images/products/bench-grinder.jpg',
                'images' => json_encode([
                    '/images/products/bench-grinder-1.jpg',
                    '/images/products/bench-grinder-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '350W',
                    'Wheel Diameter' => '6 inches',
                    'Speed' => '3450 RPM'
                ]),
                'price' => 12000,
                'discount_price' => null,
                'in_stock' => true,
                'visible' => true,
            ],
            [
                'name' => 'Corded Circular Saw',
                'slug' => 'corded-circular-saw',
                'short_description' => 'Powerful corded circular saw for precise cuts.',
                'description' => 'This corded circular saw provides powerful performance for precise cuts. It is perfect for both home and professional use.',
                'category_id' => 17,
                'brand_id' => 4,
                'featured_image' => '/images/products/corded-circular-saw.jpg',
                'images' => json_encode([
                    '/images/products/corded-circular-saw-1.jpg',
                    '/images/products/corded-circular-saw-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '1500W',
                    'Blade Diameter' => '7.25 inches',
                    'Speed' => '5500 RPM'
                ]),
                'price' => 9000,
                'discount_price' => 8500,
                'in_stock' => false,
                'visible' => true,
            ],
            [
                'name' => 'Cordless Impact Driver',
                'slug' => 'cordless-impact-driver',
                'short_description' => 'High-torque cordless impact driver.',
                'description' => 'This cordless impact driver delivers high torque for heavy-duty fastening tasks. It includes a rechargeable battery and charger.',
                'category_id' => 18,
                'brand_id' => 2,
                'featured_image' => '/images/products/cordless-impact-driver.jpg',
                'images' => json_encode([
                    '/images/products/cordless-impact-driver-1.jpg',
                    '/images/products/cordless-impact-driver-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '18V',
                    'Torque' => '170 Nm',
                    'Speed' => '0-2800 RPM'
                ]),
                'price' => 15000,
                'discount_price' => null,
                'in_stock' => true,
                'visible' => false,
            ],
            [
                'name' => 'Shop Vacuum',
                'slug' => 'shop-vacuum',
                'short_description' => 'Heavy-duty shop vacuum for cleaning debris.',
                'description' => 'This shop vacuum is perfect for cleaning up debris and dust in workshops and garages. It features a powerful motor and large capacity.',
                'category_id' => 19,
                'brand_id' => 1,
                'featured_image' => '/images/products/shop-vacuum.jpg',
                'images' => json_encode([
                    '/images/products/shop-vacuum-1.jpg',
                    '/images/products/shop-vacuum-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '1200W',
                    'Capacity' => '20 liters',
                    'Weight' => '7 kg'
                ]),
                'price' => 8000,
                'discount_price' => null,
                'in_stock' => false,
                'visible' => true,
            ],
            [
                'name' => 'Laser Level',
                'slug' => 'laser-level',
                'short_description' => 'Precision laser level for accurate measurements.',
                'description' => 'This laser level provides precise and accurate measurements. It is ideal for construction, remodeling, and DIY projects.',
                'category_id' => 20,
                'brand_id' => 3,
                'featured_image' => '/images/products/laser-level.jpg',
                'images' => json_encode([
                    '/images/products/laser-level-1.jpg',
                    '/images/products/laser-level-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Range' => '50 meters',
                    'Accuracy' => '±0.2mm/m',
                    'Battery Life' => '20 hours'
                ]),
                'price' => 5000,
                'discount_price' => 4500,
                'in_stock' => true,
                'visible' => true,
            ],
            [
                'name' => 'Pressure Washer',
                'slug' => 'pressure-washer',
                'short_description' => 'High-pressure washer for cleaning surfaces.',
                'description' => 'This pressure washer is perfect for cleaning surfaces such as driveways, patios, and vehicles. It features adjustable pressure settings.',
                'category_id' => 21,
                'brand_id' => 4,
                'featured_image' => '/images/products/pressure-washer.jpg',
                'images' => json_encode([
                    '/images/products/pressure-washer-1.jpg',
                    '/images/products/pressure-washer-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '1800W',
                    'Pressure' => '150 bar',
                    'Flow Rate' => '6 l/min'
                ]),
                'price' => 18000,
                'discount_price' => null,
                'in_stock' => true,
                'visible' => false,
            ],
            [
                'name' => 'Cordless Lawn Mower',
                'slug' => 'cordless-lawn-mower',
                'short_description' => 'Eco-friendly cordless lawn mower.',
                'description' => 'This cordless lawn mower provides an eco-friendly solution for maintaining your lawn. It features a rechargeable battery and adjustable cutting height.',
                'category_id' => 22,
                'brand_id' => 1,
                'featured_image' => '/images/products/cordless-lawn-mower.jpg',
                'images' => json_encode([
                    '/images/products/cordless-lawn-mower-1.jpg',
                    '/images/products/cordless-lawn-mower-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '36V',
                    'Cutting Width' => '40cm',
                    'Battery Life' => '60 minutes'
                ]),
                'price' => 25000,
                'discount_price' => 23000,
                'in_stock' => false,
                'visible' => true,
            ],
            [
                'name' => 'Electric Paint Sprayer',
                'slug' => 'electric-paint-sprayer',
                'short_description' => 'Efficient electric paint sprayer for smooth finishes.',
                'description' => 'This electric paint sprayer provides a smooth and even finish. It is ideal for painting walls, furniture, and other surfaces.',
                'category_id' => 23,
                'brand_id' => 2,
                'featured_image' => '/images/products/electric-paint-sprayer.jpg',
                'images' => json_encode([
                    '/images/products/electric-paint-sprayer-1.jpg',
                    '/images/products/electric-paint-sprayer-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '600W',
                    'Flow Rate' => '1200 ml/min',
                    'Weight' => '2.5 kg'
                ]),
                'price' => 8000,
                'discount_price' => null,
                'in_stock' => true,
                'visible' => true,
            ],
            [
                'name' => 'Workbench',
                'slug' => 'workbench',
                'short_description' => 'Sturdy workbench for various projects.',
                'description' => 'This workbench is sturdy and durable, providing a stable surface for various projects. It includes built-in storage and adjustable height.',
                'category_id' => 24,
                'brand_id' => 3,
                'featured_image' => '/images/products/workbench.jpg',
                'images' => json_encode([
                    '/images/products/workbench-1.jpg',
                    '/images/products/workbench-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Material' => 'Steel and MDF',
                    'Dimensions' => '120x60x90 cm',
                    'Weight Capacity' => '200 kg'
                ]),
                'price' => 12000,
                'discount_price' => 11000,
                'in_stock' => true,
                'visible' => true,
            ],
            [
                'name' => 'Welding Machine',
                'slug' => 'welding-machine',
                'short_description' => 'High-performance welding machine for metalwork.',
                'description' => 'This welding machine provides high-performance welding for various metalwork tasks. It includes adjustable settings for different materials.',
                'category_id' => 25,
                'brand_id' => 4,
                'featured_image' => '/images/products/welding-machine.jpg',
                'images' => json_encode([
                    '/images/products/welding-machine-1.jpg',
                    '/images/products/welding-machine-2.jpg'
                ]),
                'specifications' => json_encode([
                    'Power' => '200A',
                    'Voltage' => '220V',
                    'Weight' => '8 kg'
                ]),
                'price' => 20000,
                'discount_price' => null,
                'in_stock' => false,
                'visible' => true,
            ],
        ];


        foreach ($brands as $brand) {
            ProductBrand::create(['name' => $brand]);
        }


        // foreach ($specifications as $spec) {
        //     ProductSpecification::create(['name' => $spec]);
        // }


        foreach (collect($products)->pluck(['specifications']) as $specs) {
            foreach(json_decode($specs) as $spec => $val){
                if(!ProductSpecification::where('name', $spec)->exists()){
                    ProductSpecification::create([
                        'name' => $spec,
                    ]);
                }
            }
        }
    }
}
