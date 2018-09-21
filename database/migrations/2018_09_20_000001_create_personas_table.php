<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'personas';

    /**
     * Run the migrations.
     * @table personas
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('		');
            $table->string('tipo', 20);
            $table->string('nombre', 100);
            $table->string('tipo_doc', 20)->nullable();
            $table->string('numero_doc', 15)->nullable();
            $table->string('direccion', 70)->nullable();
            $table->string('telefono', 15)->nullable();
            $table->string('email', 50)->nullable();
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
