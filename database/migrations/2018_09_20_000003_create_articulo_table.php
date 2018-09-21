<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticuloTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'articulos';

    /**
     * Run the migrations.
     * @table articulo
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('idCategoria');
            $table->string('codigo', 50)->nullable();
            $table->string('nombre', 100);
            $table->integer('stock');
            $table->string('descripcion')->nullable();
            $table->string('imagen', 150)->nullable();
            $table->string('estado', 20);

            $table->index(["idCategoria"], 'fk_Articulo_Categoria_idx');


            $table->foreign('idCategoria', 'fk_Articulo_Categoria_idx')
                ->references('id')->on('categorias')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
