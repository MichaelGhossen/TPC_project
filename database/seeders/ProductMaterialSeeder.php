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
            // Product 1: 500ml Water Bottles (direct_raw)
            [
                'product_id' => 1,
                'component_type' => 'raw_material',
                'raw_material_id' => 1,  // PET
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1,
                'component_type' => 'raw_material',
                'raw_material_id' => 12, // Color Masterbatch
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.05,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 2: Chair Base (semi_raw)
            [
                'product_id' => 2,
                'component_type' => 'raw_material',
                'raw_material_id' => 2,  // HDPE
                'semi_product_id' => null,
                'quantity_required_per_unit' => 1.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'component_type' => 'raw_material',
                'raw_material_id' => 16, // Glass Fiber
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 3: Medical Syringe Bodies (semi_raw)
            [
                'product_id' => 3,
                'component_type' => 'raw_material',
                'raw_material_id' => 5,  // Polycarbonate
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.025,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3,
                'component_type' => 'raw_material',
                'raw_material_id' => 13, // UV Stabilizer
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.005,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 4: Garden Planters (direct_raw)
            [
                'product_id' => 4,
                'component_type' => 'raw_material',
                'raw_material_id' => 2,  // HDPE
                'semi_product_id' => null,
                'quantity_required_per_unit' => 2.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 4,
                'component_type' => 'raw_material',
                'raw_material_id' => 13, // UV Stabilizer
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 4,
                'component_type' => 'raw_material',
                'raw_material_id' => 20, // Calcium Carbonate
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 5: Electronics Housing (semi_raw)
            [
                'product_id' => 5,
                'component_type' => 'raw_material',
                'raw_material_id' => 6,  // ABS
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 5,
                'component_type' => 'raw_material',
                'raw_material_id' => 15, // Flame Retardant
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.05,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 6: Food Storage Containers (direct_raw)
            [
                'product_id' => 6,
                'component_type' => 'raw_material',
                'raw_material_id' => 3,  // LDPE
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 6,
                'component_type' => 'raw_material',
                'raw_material_id' => 20, // Impact Modifier
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.05,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 7: Automotive Dashboard Panels (semi_raw)
            [
                'product_id' => 7,
                'component_type' => 'raw_material',
                'raw_material_id' => 6,  // ABS
                'semi_product_id' => null,
                'quantity_required_per_unit' => 1.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 7,
                'component_type' => 'raw_material',
                'raw_material_id' => 16, // Glass Fiber
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 8: Industrial Pallets (direct_raw)
            [
                'product_id' => 8,
                'component_type' => 'raw_material',
                'raw_material_id' => 2,  // HDPE
                'semi_product_id' => null,
                'quantity_required_per_unit' => 7.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 8,
                'component_type' => 'raw_material',
                'raw_material_id' => 16, // Glass Fiber
                'semi_product_id' => null,
                'quantity_required_per_unit' => 1.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 9: Cosmetic Jar Lids (semi_raw)
            [
                'product_id' => 9,
                'component_type' => 'raw_material',
                'raw_material_id' => 9,  // PMMA
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.018,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 9,
                'component_type' => 'raw_material',
                'raw_material_id' => 19, // Antistatic Agent
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.002,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 10: Fishing Floats (direct_raw)
            [
                'product_id' => 10,
                'component_type' => 'raw_material',
                'raw_material_id' => 3,  // LDPE
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.075,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 10,
                'component_type' => 'raw_material',
                'raw_material_id' => 12, // Color Masterbatch
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.005,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 11: Pipe Fittings (semi_raw)
            [
                'product_id' => 11,
                'component_type' => 'raw_material',
                'raw_material_id' => 4,  // PVC
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.14,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 11,
                'component_type' => 'raw_material',
                'raw_material_id' => 21, // Thermal Stabilizer
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.01,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 12: Safety Goggles (direct_raw)
            [
                'product_id' => 12,
                'component_type' => 'raw_material',
                'raw_material_id' => 5,  // Polycarbonate
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.11,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 12,
                'component_type' => 'raw_material',
                'raw_material_id' => 18, // Slip Additive
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.01,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 13: Toy Car Bodies (semi_raw)
            [
                'product_id' => 13,
                'component_type' => 'raw_material',
                'raw_material_id' => 6,  // ABS
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.16,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 13,
                'component_type' => 'raw_material',
                'raw_material_id' => 12, // Color Masterbatch
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.02,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 14: Window Frames (semi_raw)
            [
                'product_id' => 14,
                'component_type' => 'raw_material',
                'raw_material_id' => 4,  // PVC
                'semi_product_id' => null,
                'quantity_required_per_unit' => 2.7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 14,
                'component_type' => 'raw_material',
                'raw_material_id' => 18, // Calcium Carbonate
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 15: Recycling Bins (direct_raw)
            [
                'product_id' => 15,
                'component_type' => 'raw_material',
                'raw_material_id' => 2,  // HDPE
                'semi_product_id' => null,
                'quantity_required_per_unit' => 2.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 15,
                'component_type' => 'raw_material',
                'raw_material_id' => 13, // UV Stabilizer
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 16: Medical IV Drip Chambers (semi_raw)
            [
                'product_id' => 16,
                'component_type' => 'raw_material',
                'raw_material_id' => 5,  // Polycarbonate
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.035,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 16,
                'component_type' => 'raw_material',
                'raw_material_id' => 14, // Antioxidant
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.005,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 17: Cable Management Tubes (semi_raw)
            [
                'product_id' => 17,
                'component_type' => 'raw_material',
                'raw_material_id' => 2,  // HDPE
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 17,
                'component_type' => 'raw_material',
                'raw_material_id' => 20, // Impact Modifier
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.02,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 18: Office Document Trays (direct_raw)
            [
                'product_id' => 18,
                'component_type' => 'raw_material',
                'raw_material_id' => 7,  // Polystyrene
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 18,
                'component_type' => 'raw_material',
                'raw_material_id' => 12, // Color Masterbatch
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.02,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 19: Keyboard Keycaps (semi_raw)
            [
                'product_id' => 19,
                'component_type' => 'raw_material',
                'raw_material_id' => 6,  // ABS
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.004,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 19,
                'component_type' => 'raw_material',
                'raw_material_id' => 12, // Color Masterbatch
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.001,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 20: Laboratory Petri Dishes (direct_raw)
            [
                'product_id' => 20,
                'component_type' => 'raw_material',
                'raw_material_id' => 7,  // Polystyrene
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.028,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 20,
                'component_type' => 'raw_material',
                'raw_material_id' => 17, // Recycled PET
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.002,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 21: Bicycle Helmets (semi_to_finished)
            [
                'product_id' => 21,
                'component_type' => 'semi_product',
                'raw_material_id' => null,
                'semi_product_id' => 12, // Safety Goggles
                'quantity_required_per_unit' => 0.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 21,
                'component_type' => 'semi_product',
                'raw_material_id' => null,
                'semi_product_id' => 5,  // Electronics Housing
                'quantity_required_per_unit' => 0.15,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 22: Blister Packaging Trays (semi_to_finished)
            [
                'product_id' => 22,
                'component_type' => 'semi_product',
                'raw_material_id' => null,
                'semi_product_id' => 9,  // Cosmetic Jar Lids
                'quantity_required_per_unit' => 0.015,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 22,
                'component_type' => 'semi_product',
                'raw_material_id' => null,
                'semi_product_id' => 11, // Pipe Fittings
                'quantity_required_per_unit' => 0.005,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 23: Furniture Glides (direct_raw)
            [
                'product_id' => 23,
                'component_type' => 'raw_material',
                'raw_material_id' => 10, // TPE
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.008,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 24: Water Tank Float Valves (semi_raw)
            [
                'product_id' => 24,
                'component_type' => 'raw_material',
                'raw_material_id' => 3,  // PP
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.06,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 24,
                'component_type' => 'raw_material',
                'raw_material_id' => 20, // Impact Modifier
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.01,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 25: Shipping Dunnage Bags (direct_raw)
            [
                'product_id' => 25,
                'component_type' => 'raw_material',
                'raw_material_id' => 3,  // LDPE
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.18,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 26: Lens Covers (semi_raw)
            [
                'product_id' => 26,
                'component_type' => 'raw_material',
                'raw_material_id' => 9,  // PMMA
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.015,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 27: Pallet Wrap (direct_raw)
            [
                'product_id' => 27,
                'component_type' => 'raw_material',
                'raw_material_id' => 3,  // LLDPE
                'semi_product_id' => null,
                'quantity_required_per_unit' => 1.8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 27,
                'component_type' => 'raw_material',
                'raw_material_id' => 18, // Slip Additive
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 28: Electrical Junction Boxes (semi_raw)
            [
                'product_id' => 28,
                'component_type' => 'raw_material',
                'raw_material_id' => 6,  // ABS
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 28,
                'component_type' => 'raw_material',
                'raw_material_id' => 15, // Flame Retardant
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.05,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 29: Cutting Boards (direct_raw)
            [
                'product_id' => 29,
                'component_type' => 'raw_material',
                'raw_material_id' => 2,  // HDPE
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 29,
                'component_type' => 'raw_material',
                'raw_material_id' => 13, // Calcium Carbonate
                'semi_product_id' => null,
                'quantity_required_per_unit' => 0.05,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Product 30: Automotive Bumper Covers (semi_to_finished)
            [
                'product_id' => 30,
                'component_type' => 'semi_product',
                'raw_material_id' => null,
                'semi_product_id' => 7,  // Dashboard Panels
                'quantity_required_per_unit' => 3.2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 30,
                'component_type' => 'semi_product',
                'raw_material_id' => null,
                'semi_product_id' => 2,  // Chair Base
                'quantity_required_per_unit' => 0.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 30,
                'component_type' => 'semi_product',
                'raw_material_id' => null,
                'semi_product_id' => 13, // Toy Car Bodies
                'quantity_required_per_unit' => 0.1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

    }
}
