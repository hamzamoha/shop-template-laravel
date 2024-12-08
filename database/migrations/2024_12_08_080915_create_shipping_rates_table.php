<?php

use App\Models\Region;
use App\Models\ShippingRate;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });
        Schema::create('shipping_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('method');
            $table->decimal('cost', 8, 2);
            $table->timestamps();
        });
        Region::create(["name" => "Béni Mellal-Khénifra"]);
        Region::create(["name" => "Casablanca-Settat"]);
        Region::create(["name" => "Dakhla-Oued Ed-Dahab"]);
        Region::create(["name" => "Drâa-Tafilalet"]);
        Region::create(["name" => "Fès-Meknès"]);
        Region::create(["name" => "Guelmim-Oued Noun"]);
        Region::create(["name" => "Laâyoune-Sakia El Hamra"]);
        Region::create(["name" => "Marrakesh-Safi"]);
        Region::create(["name" => "Oriental"]);
        Region::create(["name" => "Rabat-Salé-Kénitra"]);
        Region::create(["name" => "Souss-Massa"]);
        Region::create(["name" => "Tanger-Tetouan-Al Hoceima"]);
        ShippingRate::create(["method" => "Standard", "cost" => 5]);
        ShippingRate::create(["method" => "Express", "cost" => 10]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_rates');
        Schema::dropIfExists('regions');
    }
};
