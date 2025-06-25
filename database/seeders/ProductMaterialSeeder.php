<?php

namespace Database\Seeders;

use App\Models\ProductMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductMaterial::insert([
            // Product 1: 500ml Water Bottles (24-pack) - weight: 0.25kg
            [
                'product_id' => 1,
                'raw_material_id' => 1,  // PET
                'quantity_required_per_unit' => 0.20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1,
                'raw_material_id' => 12, // Color Masterbatch
                'quantity_required_per_unit' => 0.05,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 2: Injection Molded Chair Base - weight: 1.2kg
            [
                'product_id' => 2,
                'raw_material_id' => 2,  // HDPE
                'quantity_required_per_unit' => 1.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'raw_material_id' => 16, // Glass Fiber
                'quantity_required_per_unit' => 0.2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 3: Medical Syringe Bodies - weight: 0.03kg
            [
                'product_id' => 3,
                'raw_material_id' => 5,  // Polycarbonate
                'quantity_required_per_unit' => 0.025,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3,
                'raw_material_id' => 13, // UV Stabilizer
                'quantity_required_per_unit' => 0.005,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 4: Garden Planters (Large) - weight: 2.5kg
            [
                'product_id' => 4,
                'raw_material_id' => 2,  // HDPE
                'quantity_required_per_unit' => 2.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 4,
                'raw_material_id' => 13, // UV Stabilizer
                'quantity_required_per_unit' => 0.3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 4,
                'raw_material_id' => 20, // Calcium Carbonate
                'quantity_required_per_unit' => 0.2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 5: Electronics Housing - weight: 0.45kg
            [
                'product_id' => 5,
                'raw_material_id' => 6,  // ABS
                'quantity_required_per_unit' => 0.4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 5,
                'raw_material_id' => 15, // Flame Retardant
                'quantity_required_per_unit' => 0.05,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 6: Food Storage Containers - weight: 0.35kg
            [
                'product_id' => 6,
                'raw_material_id' => 3,  // LDPE
                'quantity_required_per_unit' => 0.3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 6,
                'raw_material_id' => 20, // Impact Modifier
                'quantity_required_per_unit' => 0.05,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 7: Automotive Dashboard Panels - weight: 1.8kg
            [
                'product_id' => 7,
                'raw_material_id' => 6,  // ABS
                'quantity_required_per_unit' => 1.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 7,
                'raw_material_id' => 16, // Glass Fiber
                'quantity_required_per_unit' => 0.3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 8: Industrial Pallets - weight: 8.5kg
            [
                'product_id' => 8,
                'raw_material_id' => 2,  // HDPE
                'quantity_required_per_unit' => 7.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 8,
                'raw_material_id' => 16, // Glass Fiber
                'quantity_required_per_unit' => 1.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 9: Cosmetic Jar Lids - weight: 0.02kg
            [
                'product_id' => 9,
                'raw_material_id' => 9,  // PMMA
                'quantity_required_per_unit' => 0.018,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 9,
                'raw_material_id' => 19, // Antistatic Agent
                'quantity_required_per_unit' => 0.002,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 10: Fishing Floats - weight: 0.08kg
            [
                'product_id' => 10,
                'raw_material_id' => 3,  // LDPE
                'quantity_required_per_unit' => 0.075,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 10,
                'raw_material_id' => 12, // Color Masterbatch
                'quantity_required_per_unit' => 0.005,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 11: Pipe Fittings - weight: 0.15kg
            [
                'product_id' => 11,
                'raw_material_id' => 4,  // PVC
                'quantity_required_per_unit' => 0.14,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 11,
                'raw_material_id' => 21, // Thermal Stabilizer
                'quantity_required_per_unit' => 0.01,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 12: Safety Goggles - weight: 0.12kg
            [
                'product_id' => 12,
                'raw_material_id' => 5,  // Polycarbonate
                'quantity_required_per_unit' => 0.11,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 12,
                'raw_material_id' => 18, // Slip Additive
                'quantity_required_per_unit' => 0.01,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 13: Toy Car Bodies - weight: 0.18kg
            [
                'product_id' => 13,
                'raw_material_id' => 6,  // ABS
                'quantity_required_per_unit' => 0.16,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 13,
                'raw_material_id' => 12, // Color Masterbatch
                'quantity_required_per_unit' => 0.02,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 14: Window Frames - weight: 3.2kg
            [
                'product_id' => 14,
                'raw_material_id' => 4,  // PVC
                'quantity_required_per_unit' => 2.7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 14,
                'raw_material_id' => 18, // Calcium Carbonate
                'quantity_required_per_unit' => 0.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 15: Recycling Bins - weight: 2.8kg
            [
                'product_id' => 15,
                'raw_material_id' => 2,  // HDPE
                'quantity_required_per_unit' => 2.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 15,
                'raw_material_id' => 13, // UV Stabilizer
                'quantity_required_per_unit' => 0.3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 16: Medical IV Drip Chambers - weight: 0.04kg
            [
                'product_id' => 16,
                'raw_material_id' => 5,  // Polycarbonate
                'quantity_required_per_unit' => 0.035,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 16,
                'raw_material_id' => 14, // Antioxidant
                'quantity_required_per_unit' => 0.005,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 17: Cable Management Tubes - weight: 0.22kg
            [
                'product_id' => 17,
                'raw_material_id' => 2,  // HDPE
                'quantity_required_per_unit' => 0.2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 17,
                'raw_material_id' => 20, // Impact Modifier
                'quantity_required_per_unit' => 0.02,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 18: Office Document Trays - weight: 0.42kg
            [
                'product_id' => 18,
                'raw_material_id' => 7,  // Polystyrene
                'quantity_required_per_unit' => 0.4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 18,
                'raw_material_id' => 12, // Color Masterbatch
                'quantity_required_per_unit' => 0.02,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 19: Keyboard Keycaps - weight: 0.005kg
            [
                'product_id' => 19,
                'raw_material_id' => 6,  // ABS
                'quantity_required_per_unit' => 0.004,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 19,
                'raw_material_id' => 12, // Color Masterbatch
                'quantity_required_per_unit' => 0.001,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 20: Laboratory Petri Dishes - weight: 0.03kg
            [
                'product_id' => 20,
                'raw_material_id' => 7,  // Polystyrene
                'quantity_required_per_unit' => 0.028,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 20,
                'raw_material_id' => 17, // Recycled PET
                'quantity_required_per_unit' => 0.002,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 21: Bicycle Helmets - weight: 0.65kg
            [
                'product_id' => 21,
                'raw_material_id' => 5,  // Polycarbonate
                'quantity_required_per_unit' => 0.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 21,
                'raw_material_id' => 8,  // EPS Foam
                'quantity_required_per_unit' => 0.15,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 22: Blister Packaging Trays - weight: 0.02kg
            [
                'product_id' => 22,
                'raw_material_id' => 4,  // PVC
                'quantity_required_per_unit' => 0.015,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 22,
                'raw_material_id' => 3,  // LDPE
                'quantity_required_per_unit' => 0.005,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 23: Furniture Glides - weight: 0.008kg
            [
                'product_id' => 23,
                'raw_material_id' => 10, // TPE
                'quantity_required_per_unit' => 0.008,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 24: Water Tank Float Valves - weight: 0.07kg
            [
                'product_id' => 24,
                'raw_material_id' => 3,  // PP
                'quantity_required_per_unit' => 0.06,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 24,
                'raw_material_id' => 20, // Impact Modifier
                'quantity_required_per_unit' => 0.01,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 25: Shipping Dunnage Bags - weight: 0.18kg
            [
                'product_id' => 25,
                'raw_material_id' => 3,  // LDPE
                'quantity_required_per_unit' => 0.18,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 26: Lens Covers - weight: 0.015kg
            [
                'product_id' => 26,
                'raw_material_id' => 9,  // PMMA
                'quantity_required_per_unit' => 0.015,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 27: Pallet Wrap - weight: 2.1kg
            [
                'product_id' => 27,
                'raw_material_id' => 3,  // LLDPE
                'quantity_required_per_unit' => 1.8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 27,
                'raw_material_id' => 18, // Slip Additive
                'quantity_required_per_unit' => 0.3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 28: Electrical Junction Boxes - weight: 0.35kg
            [
                'product_id' => 28,
                'raw_material_id' => 6,  // ABS
                'quantity_required_per_unit' => 0.3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 28,
                'raw_material_id' => 15, // Flame Retardant
                'quantity_required_per_unit' => 0.05,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 29: Cutting Boards - weight: 0.95kg
            [
                'product_id' => 29,
                'raw_material_id' => 2,  // HDPE
                'quantity_required_per_unit' => 0.9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 29,
                'raw_material_id' => 13, // Calcium Carbonate
                'quantity_required_per_unit' => 0.05,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 30: Automotive Bumper Covers - weight: 3.8kg
            [
                'product_id' => 30,
                'raw_material_id' => 3,  // PP
                'quantity_required_per_unit' => 3.2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 30,
                'raw_material_id' => 16, // Glass Fiber
                'quantity_required_per_unit' => 0.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 30,
                'raw_material_id' => 20, // Impact Modifier
                'quantity_required_per_unit' => 0.1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

    }
}
