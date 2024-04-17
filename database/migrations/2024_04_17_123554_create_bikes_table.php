<?php

use App\Models\Bike;
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
        Schema::create('bikes', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('brand');
            $table->timestamps();
        });


        $bikes = [
            [
                "description" => "Das Bike meines Bruders",
                "brand" => "Scott"
            ], [
                "description" => "Das Velo meiner Oma",
                "brand" => "Scott"
            ]
        ];

        foreach ($bikes as $bike) {
            $bikeModel = new Bike();
            $bikeModel::unguard();
            $bikeModel->fill($bike);
            $bikeModel->save();
            $bikeModel::reguard();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bikes');
    }
};
