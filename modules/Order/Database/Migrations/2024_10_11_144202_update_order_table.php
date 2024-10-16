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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('billing_phone')->nullable()->after('billing_address_2');
            $table->string('billing_email')->nullable()->after('billing_phone');
            $table->string('shipping_phone')->nullable()->after('shipping_address_2');
            $table->string('shipping_email')->nullable()->after('shipping_phone');
            $table->string('delivery_date')->nullable()->after('shipping_email');
            $table->string('delivery_time_from')->nullable()->after('delivery_date');
            $table->string('delivery_time_to')->nullable()->after('delivery_time_from');
            $table->integer('recipient_action')->nullable()->after('note');
            $table->integer('delivery_action')->nullable()->after('recipient_action');
            $table->boolean('take_photo_on_delivery')->after('delivery_action');
            $table->boolean('send_me_photo_before_delivery')->after('take_photo_on_delivery');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('billing_phone');
            $table->dropColumn('billing_email');
            $table->dropColumn('shipping_phone');
            $table->dropColumn('shipping_email');
            $table->dropColumn('recipient_action');
            $table->dropColumn('delivery_action');
            $table->dropColumn('delivery_data');
            $table->dropColumn('delivery_time_from');
            $table->dropColumn('delivery_time_to');
        });
    }
};
