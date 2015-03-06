<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('products', function($table){
			$table->increments('id');
			$table->string('product_style_no')->unique;
			$table->string('name');
			$table->integer('category');
			$table->string('thumbnail');
			$table->string('image');
			$table->string('price');
			$table->timestamps();
		});
			
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('products');
	}

}
