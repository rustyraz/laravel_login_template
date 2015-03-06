<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		//$this->call('CategoriesTableSeeder');
		//$this->command->info('Categories table seeded');

		// $this->call('UserTableSeeder');

		$this->call('ProductsTableSeeder');
		$this->command->info('Products table seeded');

	}

}

class CategoriesTableSeeder extends Seeder{
	public function run(){
		DB::table('categories')->delete();
		Category::create(
			array(
				'name'=>'Shoes',
				'image'=>'sports_shoes.jpg'
				)
			);
	}
}

class ProductsTableSeeder extends Seeder{
	public function run(){
		DB::table('products')->delete();
		Product::create(
			array(
				'product_style_no'=>'shoe545344',
				'name'=>'Adidas Shoes',
				'category'=>'1',
				'thumbnail'=>'shoe545344_small.jpg',
				'image'=>'shoe545344_large.jpg',
				'price'=>'20'
				)
			);
	}
}