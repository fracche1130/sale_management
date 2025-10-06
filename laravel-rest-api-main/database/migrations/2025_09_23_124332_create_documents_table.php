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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            
            // Link to users table (who uploaded or owns the document)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Document info
            $table->string('title');                // title of the document
            $table->string('file_path');            // storage path of uploaded file
            $table->string('status')->default('pending'); // tracking status: pending, in-progress, completed, etc.

            // QR Code
            $table->string('qr_code')->unique();    // store QR code string/value
            
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
