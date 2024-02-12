<?php

use App\Models\College;
use App\Models\Department;
use App\Models\Designation;
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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->foreignIdFor(College::class); //  college ID
            $table->foreignIdFor(Department::class); // Foreign key to departments table
            $table->foreignIdFor(Designation::class); // Foreign key to designations table
            $table->string('address'); // User's address
            $table->string('pincode'); // Pincode for the address
            $table->timestamps();
            $table->foreignId('user_id')->constrained();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
