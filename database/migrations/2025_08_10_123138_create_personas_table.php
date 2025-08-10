<?php

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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nacionalidad', 1); //nacionalidad indicada en V de Venezolano o en E Extrangero
            $table->string('cedula', 12)->unique(); //numero de cedula de identidad
            $table->string('nombres', 120); //nombre 
            $table->string('apellidos', 120); //apellidos
            $table->date('fnacimiento')->nullable();//fecha de nacimiento  
            $table->enum('sexo',['Femenino' , 'Masculino'])->nullable(); //sexo biologico          
            $table->foreignId('user_id') // UNSIGNED BIG INT
                    ->nullable() // <-- IMPORTANTE: LA COLUMNA DEBE ACEPTAR NULL COMO VALOR VALIDO
                    ->constrained()  // <-- DEFINE LA RESTRICCION DE LLAVE FORANEA
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
