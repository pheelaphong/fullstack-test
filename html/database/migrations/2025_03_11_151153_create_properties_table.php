<?php
// database/migrations/xxxx_xx_xx_create_properties_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('for_sale');
            $table->boolean('for_rent');
            $table->boolean('sold');
            $table->integer('price');
            $table->string('currency');
            $table->string('currency_symbol', 5);
            $table->string('property_type');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->integer('area');
            $table->string('area_type');
            // เก็บข้อมูล geo เป็น JSON เพื่อให้ค้นหาง่าย
            $table->json('geo');
            // เก็บข้อมูล photos เป็น JSON
            $table->json('photos');
            // ใช้ timestamps สำหรับวันที่สร้าง (date listed)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
