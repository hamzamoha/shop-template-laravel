<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id = Category::create(["name" => "Electronics", "parent_id" => null])->id;
        Category::create(["name" => "Mobile Phones & Accessories", "parent_id" => $id]);
        Category::create(["name" => "Computers & Laptops", "parent_id" => $id]);
        Category::create(["name" => "Audio & Headphones", "parent_id" => $id]);
        Category::create(["name" => "Cameras & Photography", "parent_id" => $id]);
        Category::create(["name" => "Smart Home Devices", "parent_id" => $id]);
        Category::create(["name" => "Gaming Consoles & Accessories", "parent_id" => $id]);
        $id = Category::create(["name" => "Fashion", "parent_id" => null])->id;
        Category::create(["name" => "Men’s Clothing", "parent_id" => $id]);
        Category::create(["name" => "Women’s Clothing", "parent_id" => $id]);
        Category::create(["name" => "Kids’ Clothing", "parent_id" => $id]);
        Category::create(["name" => "Shoes & Footwear", "parent_id" => $id]);
        Category::create(["name" => "Jewelry & Watches", "parent_id" => $id]);
        Category::create(["name" => "Bags & Accessories", "parent_id" => $id]);
        $id = Category::create(["name" => "Home & Living", "parent_id" => null])->id;
        Category::create(["name" => "Furniture", "parent_id" => $id]);
        Category::create(["name" => "Kitchenware & Appliances", "parent_id" => $id]);
        Category::create(["name" => "Home Decor", "parent_id" => $id]);
        Category::create(["name" => "Bedding & Bath", "parent_id" => $id]);
        Category::create(["name" => "Storage & Organization", "parent_id" => $id]);
        $id = Category::create(["name" => "Beauty & Personal Care", "parent_id" => null])->id;
        Category::create(["name" => "Skincare", "parent_id" => $id]);
        Category::create(["name" => "Haircare", "parent_id" => $id]);
        Category::create(["name" => "Makeup", "parent_id" => $id]);
        Category::create(["name" => "Fragrances", "parent_id" => $id]);
        Category::create(["name" => "Wellness & Supplements", "parent_id" => $id]);
        $id = Category::create(["name" => "Sports & Outdoors", "parent_id" => null])->id;
        Category::create(["name" => "Fitness Equipment", "parent_id" => $id]);
        Category::create(["name" => "Outdoor Gear", "parent_id" => $id]);
        Category::create(["name" => "Sportswear", "parent_id" => $id]);
        Category::create(["name" => "Bikes & Scooters", "parent_id" => $id]);
        Category::create(["name" => "Camping & Hiking Gear", "parent_id" => $id]);
        $id = Category::create(["name" => "Books & Media", "parent_id" => null])->id;
        Category::create(["name" => "Fiction", "parent_id" => $id]);
        Category::create(["name" => "Non-Fiction", "parent_id" => $id]);
        Category::create(["name" => "Children’s Books", "parent_id" => $id]);
        Category::create(["name" => "Academic & Professional", "parent_id" => $id]);
        Category::create(["name" => "Music & Movies", "parent_id" => $id]);
        $id = Category::create(["name" => "Toys, Kids & Baby", "parent_id" => null])->id;
        Category::create(["name" => "Toys & Games", "parent_id" => $id]);
        Category::create(["name" => "Baby Clothing & Gear", "parent_id" => $id]);
        Category::create(["name" => "Strollers & Car Seats", "parent_id" => $id]);
        Category::create(["name" => "Nursery Furniture", "parent_id" => $id]);
        Category::create(["name" => "Educational Supplies", "parent_id" => $id]);
        $id = Category::create(["name" => "Groceries & Daily Needs", "parent_id" => null])->id;
        Category::create(["name" => "Food & Beverages", "parent_id" => $id]);
        Category::create(["name" => "Household Supplies", "parent_id" => $id]);
        Category::create(["name" => "Health & Hygiene", "parent_id" => $id]);
        Category::create(["name" => "Pet Food & Care", "parent_id" => $id]);
        $id = Category::create(["name" => "Automotive", "parent_id" => null])->id;
        Category::create(["name" => "Car Accessories", "parent_id" => $id]);
        Category::create(["name" => "Tools & Maintenance", "parent_id" => $id]);
        Category::create(["name" => "Motorcycle Gear", "parent_id" => $id]);
        $id = Category::create(["name" => " Travel & Luggage", "parent_id" => null])->id;
        Category::create(["name" => "Suitcases & Bags", "parent_id" => $id]);
        Category::create(["name" => "Travel Accessories", "parent_id" => $id]);
        Category::create(["name" => "Outdoor Travel Gear", "parent_id" => $id]);
    }
}
