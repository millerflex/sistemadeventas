<?php

namespace Database\Factories;
use App\Models\Categoria;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo'=> $this->faker->unique()->ean13(), //Código único
            'nombre'=> $this->faker->word(), //nombre del producto
            'descripcion'=> $this->faker->sentence(), //Descripción aleatoria
            'imagen'=> $this->faker->imageUrl(640, 480, 'products', true), //Url de una imagen aleatoria. 640 es el ancho, 480 el alto, products (es la categoría) y true para generar múltiples imágenes sin sobreescribir archivos existentes
            'stock'=> $this->faker->numberBetween(10, 100), //Stock entre 10 y 100
            'stock_minimo'=> $this->faker->numberBetween(5, 10), //Stock entre 5 y 10
            'stock_maximo'=> $this->faker->numberBetween(50, 200), //Stock entre 50 y 200
            'precio_compra'=> $this->faker->randomFloat(2, 10, 500), //Precio de compra entre 10 y 500 pesos con 2 decimales
            'precio_venta'=> $this->faker->randomFloat(2, 20, 600), //Precio de venta entre 20 y 600 pesos con 2 decimales
            'fecha_ingreso'=> $this->faker->date(), //Fecha de ingreso aleatoria
            'categoria_id'=> 1,
            'empresa_id'=> 1,
        ];
    }
}
