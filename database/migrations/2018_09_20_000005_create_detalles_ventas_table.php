<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesVentasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'detalles_ventas';

    /**
     * Run the migrations.
     * @table detalles_ventas
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_venta');
            $table->integer('id_articulo');
            $table->integer('cantidad');
            $table->decimal('precio_venta', 11, 2);
            $table->decimal('descuento', 11, 2);

            $table->index(["id_venta"], 'fk_detalle_venta_venta_idx');

            $table->index(["id_articulo"], 'fk_detalle_venta_articulo_idx');


            $table->foreign('id_articulo', 'fk_detalle_venta_articulo_idx')
                ->references('id')->on('articulo')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('id_venta', 'fk_detalle_venta_venta_idx')
                ->references('id')->on('ventas')
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
