<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE TRIGGER stock_masuk_insert AFTER INSERT ON barang_masuks
            FOR EACH ROW    
            BEGIN
                UPDATE products
                SET stock = stock + NEW.qty
                WHERE id = NEW.product_id;
            END; 
        ");
        DB::statement("
            CREATE TRIGGER stock_masuk_delete BEFORE DELETE ON barang_masuks
            FOR EACH ROW
            BEGIN
                UPDATE products
                SET stock = stock - OLD.qty
                WHERE id = OLD.product_id;
            END;
        ");
        DB::statement("
            CREATE TRIGGER stock_masuk_update AFTER UPDATE ON barang_masuks
            FOR EACH ROW
            BEGIN
                UPDATE products
                SET stock = stock + (NEW.qty - OLD.qty)
                WHERE id = NEW.product_id;
            END;
        ");
        DB::statement("
            CREATE TRIGGER stock_keluar_insert AFTER INSERT ON barang_keluars
            FOR EACH ROW    
            BEGIN
                UPDATE products
                SET stock = stock - NEW.qty
                WHERE id = NEW.product_id;
            END;
        ");
        DB::statement("
            CREATE TRIGGER stock_keluar_update AFTER UPDATE ON barang_keluars
            FOR EACH ROW
            BEGIN
                UPDATE products
                SET stock = stock - (NEW.qty - OLD.qty)
                WHERE id = NEW.product_id;
            END;
        ");
        DB::statement("
            CREATE TRIGGER stock_keluar_delete BEFORE DELETE ON barang_keluars
            FOR EACH ROW
            BEGIN
                UPDATE products
                SET stock = stock + OLD.qty
                WHERE id = OLD.product_id;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS stock_masuk_insert");
        DB::unprepared("DROP TRIGGER IF EXISTS stock_masuk_delete");
        DB::unprepared("DROP TRIGGER IF EXISTS stock_masuk_update");
        DB::unprepared("DROP TRIGGER IF EXISTS stock_keluar_insert");
        DB::unprepared("DROP TRIGGER IF EXISTS stock_keluar_update");
        DB::unprepared("DROP TRIGGER IF EXISTS stock_keular_delete");
    }
};
