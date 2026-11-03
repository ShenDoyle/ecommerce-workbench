<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ec_brands', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('slug')->unique();
            $t->text('description')->nullable();
            $t->timestamps();
        });

        Schema::create('ec_stores', function (Blueprint $t) {
            $t->id();
            $t->foreignId('brand_id')->constrained('ec_brands');
            $t->string('name');
            $t->string('platform'); // jd / tmall / tiktok / amazon
            $t->string('external_id')->nullable();
            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });

        Schema::create('ec_warehouses', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('code')->unique();
            $t->string('address')->nullable();
            $t->timestamps();
        });

        Schema::create('ec_products', function (Blueprint $t) {
            $t->id();
            $t->foreignId('brand_id')->constrained('ec_brands');
            $t->string('name');
            $t->string('internal_code')->unique();
            $t->text('description')->nullable();
            $t->timestamps();
        });

        Schema::create('ec_skus', function (Blueprint $t) {
            $t->id();
            $t->foreignId('product_id')->constrained('ec_products');
            $t->foreignId('store_id')->nullable()->constrained('ec_stores');
            $t->string('platform_code');
            $t->string('internal_code');
            $t->decimal('price', 10, 2)->nullable();
            $t->boolean('is_active')->default(true);
            $t->timestamps();
            $t->unique(['store_id', 'platform_code']);
        });

        Schema::create('ec_code_mappings', function (Blueprint $t) {
            $t->id();
            $t->foreignId('sku_id')->constrained('ec_skus');
            $t->string('code_type'); // bj / jd / 69
            $t->string('code_value');
            $t->integer('quantity')->default(1); // BOM quantity
            $t->timestamps();
            $t->index(['code_type', 'code_value']);
        });

        Schema::create('ec_import_jobs', function (Blueprint $t) {
            $t->id();
            $t->string('file_name');
            $t->string('import_type');
            $t->string('status')->default('pending');
            $t->json('validation_result')->nullable();
            $t->integer('total_rows')->default(0);
            $t->integer('success_rows')->default(0);
            $t->integer('error_rows')->default(0);
            $t->string('file_hash', 64);
            $t->timestamps();
        });

        Schema::create('ec_order_snapshots', function (Blueprint $t) {
            $t->id();
            $t->foreignId('store_id')->constrained('ec_stores');
            $t->string('external_order_id');
            $t->string('status');
            $t->decimal('amount', 12, 2)->nullable();
            $t->timestamp('order_date');
            $t->string('source_file');
            $t->timestamp('imported_at');
            $t->timestamps();
            $t->index(['store_id', 'external_order_id']);
        });

        Schema::create('ec_inventory_snapshots', function (Blueprint $t) {
            $t->id();
            $t->foreignId('sku_id')->constrained('ec_skus');
            $t->foreignId('warehouse_id')->nullable()->constrained('ec_warehouses');
            $t->integer('quantity');
            $t->timestamp('snapshot_date');
            $t->string('source_file');
            $t->timestamps();
            $t->index(['sku_id', 'snapshot_date']);
        });

        Schema::create('ec_tasks', function (Blueprint $t) {
            $t->id();
            $t->string('type');
            $t->json('params')->nullable();
            $t->string('status')->default('pending');
            $t->text('result')->nullable();
            $t->string('mode')->default('simulation'); // simulation / real
            $t->unsignedBigInteger('created_by');
            $t->timestamps();
        });

        Schema::create('ec_task_executions', function (Blueprint $t) {
            $t->id();
            $t->foreignId('task_id')->constrained('ec_tasks');
            $t->string('status');
            $t->json('output')->nullable();
            $t->timestamp('started_at')->nullable();
            $t->timestamp('finished_at')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ec_task_executions');
        Schema::dropIfExists('ec_tasks');
        Schema::dropIfExists('ec_inventory_snapshots');
        Schema::dropIfExists('ec_order_snapshots');
        Schema::dropIfExists('ec_import_jobs');
        Schema::dropIfExists('ec_code_mappings');
        Schema::dropIfExists('ec_skus');
        Schema::dropIfExists('ec_products');
        Schema::dropIfExists('ec_warehouses');
        Schema::dropIfExists('ec_stores');
        Schema::dropIfExists('ec_brands');
    }
};
