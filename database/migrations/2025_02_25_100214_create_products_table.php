<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();                               // ID tự động tăng
            $table->string('name');                     // Tên sản phẩm
            $table->decimal('price', 10, 2);              // Giá sản phẩm
            $table->string('image')->nullable();        // Đường dẫn hình ảnh sản phẩm
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
