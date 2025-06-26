<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'name' => '500ml Water Bottles (24-pack)',
                'description' => 'Clear PET bottles with screw caps',
                'price' => 12.75,
                'category' => 'direct_raw',  // Changed from 'finished'
                'weight_per_unit' => 0.25,
                'minimum_stock_alert' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Injection Molded Chair Base',
                'description' => 'Heavy-duty PP base for office chairs',
                'price' => 8.50,
                'category' => 'semi_raw',  // Changed from 'semi_finished'
                'weight_per_unit' => 1.2,
                'minimum_stock_alert' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Medical Syringe Bodies',
                'description' => 'Sterile PC components for medical devices',
                'price' => 0.85,
                'category' => 'semi_raw',  // Changed from 'semi_finished'
                'weight_per_unit' => 0.03,
                'minimum_stock_alert' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Garden Planters (Large)',
                'description' => 'UV-resistant HDPE plant containers',
                'price' => 15.99,
                'category' => 'direct_raw',  // Changed from 'finished'
                'weight_per_unit' => 2.5,
                'minimum_stock_alert' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Electronics Housing',
                'description' => 'ABS enclosures for consumer electronics',
                'price' => 6.25,
                'category' => 'semi_raw',  // Changed from 'semi_finished'
                'weight_per_unit' => 0.45,
                'minimum_stock_alert' => 75,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Food Storage Containers (Set of 6)',
                'description' => 'BPA-free PP containers with lids',
                'price' => 22.50,
                'category' => 'direct_raw',  // Changed from 'finished'
                'weight_per_unit' => 0.35,
                'minimum_stock_alert' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Automotive Dashboard Panels',
                'description' => 'Textured ABS components for vehicles',
                'price' => 28.75,
                'category' => 'semi_raw',  // Changed from 'semi_finished'
                'weight_per_unit' => 1.8,
                'minimum_stock_alert' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Industrial Pallets',
                'description' => 'Heavy-duty HDPE shipping pallets',
                'price' => 45.00,
                'category' => 'direct_raw',  // Changed from 'finished'
                'weight_per_unit' => 8.5,
                'minimum_stock_alert' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cosmetic Jar Lids',
                'description' => 'PETG screw-top lids for creams',
                'price' => 0.45,
                'category' => 'semi_raw',  // Changed from 'semi_finished'
                'weight_per_unit' => 0.02,
                'minimum_stock_alert' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fishing Floats',
                'description' => 'Buoyant PE floats for fishing nets',
                'price' => 1.20,
                'category' => 'direct_raw',  // Changed from 'finished'
                'weight_per_unit' => 0.08,
                'minimum_stock_alert' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pipe Fittings (90° Elbow)',
                'description' => 'PVC connectors for plumbing systems',
                'price' => 0.95,
                'category' => 'semi_raw',  // Changed from 'semi_finished'
                'weight_per_unit' => 0.15,
                'minimum_stock_alert' => 400,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Safety Goggles',
                'description' => 'Polycarbonate protective eyewear',
                'price' => 3.75,
                'category' => 'direct_raw',  // Changed from 'finished'
                'weight_per_unit' => 0.12,
                'minimum_stock_alert' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Toy Car Bodies',
                'description' => 'Injection molded ABS toy components',
                'price' => 1.85,
                'category' => 'semi_raw',  // Changed from 'semi_finished'
                'weight_per_unit' => 0.18,
                'minimum_stock_alert' => 250,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Window Frames',
                'description' => 'UV-stabilized PVC building profiles',
                'price' => 32.50,
                'category' => 'semi_raw',  // Changed from 'semi_finished'
                'weight_per_unit' => 3.2,
                'minimum_stock_alert' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Recycling Bins (60L)',
                'description' => 'Outdoor HDPE waste containers',
                'price' => 38.00,
                'category' => 'direct_raw',  // Changed from 'finished'
                'weight_per_unit' => 2.8,
                'minimum_stock_alert' => 35,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Medical IV Drip Chambers',
                'description' => 'Clear PC medical components',
                'price' => 2.25,
                'category' => 'semi_raw',  // Changed from 'semi_finished'
                'weight_per_unit' => 0.04,
                'minimum_stock_alert' => 600,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cable Management Tubes',
                'description' => 'Corrugated HDPE conduit pipes',
                'price' => 0.65,
                'category' => 'semi_raw',  // Changed from 'semi_finished'
                'weight_per_unit' => 0.22,
                'minimum_stock_alert' => 800,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Office Document Trays',
                'description' => 'Stackable PS organizers',
                'price' => 7.40,
                'category' => 'direct_raw',  // Changed from 'finished'
                'weight_per_unit' => 0.42,
                'minimum_stock_alert' => 80,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Keyboard Keycaps',
                'description' => 'ABS double-shot injection keys',
                'price' => 0.12,
                'category' => 'semi_raw',  // Changed from 'semi_finished'
                'weight_per_unit' => 0.005,
                'minimum_stock_alert' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Laboratory Petri Dishes',
                'description' => 'Sterile PS disposable labware',
                'price' => 0.55,
                'category' => 'direct_raw',  // Changed from 'finished'
                'weight_per_unit' => 0.03,
                'minimum_stock_alert' => 1200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bicycle Helmets',
                'description' => 'Impact-resistant EPS/PC safety gear',
                'price' => 27.80,
                'category' => 'semi_to_finished',  // New category
                'weight_per_unit' => 0.65,
                'minimum_stock_alert' => 45,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Blister Packaging Trays',
                'description' => 'PVC/PE transparent product packaging',
                'price' => 0.28,
                'category' => 'semi_to_finished',  // New category
                'weight_per_unit' => 0.02,
                'minimum_stock_alert' => 2500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Furniture Glides',
                'description' => 'TPE floor protectors for chair legs',
                'price' => 0.15,
                'category' => 'direct_raw',  // Changed from 'finished'
                'weight_per_unit' => 0.008,
                'minimum_stock_alert' => 4000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Water Tank Float Valves',
                'description' => 'PP components for plumbing systems',
                'price' => 3.45,
                'category' => 'semi_raw',  // Changed from 'semi_finished'
                'weight_per_unit' => 0.07,
                'minimum_stock_alert' => 350,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Shipping Dunnage Bags',
                'description' => 'LDPE inflatable void fillers',
                'price' => 1.80,
                'category' => 'direct_raw',  // Changed from 'finished'
                'weight_per_unit' => 0.18,
                'minimum_stock_alert' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lens Covers',
                'description' => 'Optical-grade PMMA protective covers',
                'price' => 0.95,
                'category' => 'semi_raw',  // Changed from 'semi_finished'
                'weight_per_unit' => 0.015,
                'minimum_stock_alert' => 1500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pallet Wrap (20" Roll)',
                'description' => 'LLDPE stretch film for palletizing',
                'price' => 14.25,
                'category' => 'direct_raw',  // Changed from 'finished'
                'weight_per_unit' => 2.1,
                'minimum_stock_alert' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Electrical Junction Boxes',
                'description' => 'Flame-retardant ABS enclosures',
                'price' => 4.75,
                'category' => 'semi_raw',  // Changed from 'semi_finished'
                'weight_per_unit' => 0.35,
                'minimum_stock_alert' => 180,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cutting Boards',
                'description' => 'Food-grade HDPE kitchen surfaces',
                'price' => 9.99,
                'category' => 'direct_raw',  // Changed from 'finished'
                'weight_per_unit' => 0.95,
                'minimum_stock_alert' => 65,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Automotive Bumper Covers',
                'description' => 'Impact-modified PP vehicle components',
                'price' => 52.30,
                'category' => 'semi_to_finished',  // New category
                'weight_per_unit' => 3.8,
                'minimum_stock_alert' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

    }
}
