<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Users (Username & Password awal)
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'role' => 'Admin',
            'status' => 'Aktif'
        ]);

        User::create([
            'name' => 'Peternak',
            'username' => 'peternak',
            'password' => bcrypt('peternak'),
            'role' => 'Peternak',
            'status' => 'Aktif'
        ]);
                
        User::create([
            'name' => 'Penjualan',
            'username' => 'penjualan',
            'password' => bcrypt('12345678'),
            'role' => 'Penjualan',
            'status' => 'Aktif'
        ]);

        // 2. Seed Sapi
        $sapi1 = \App\Models\Sapi::create([
            'kode_sapi' => 'SP001',
            'nama' => 'Bessie',
            'jenis' => 'Holstein',
            'jenis_kelamin' => 'Betina',
            'umur' => 3,
            'berat' => '500kg',
            'status_kesehatan' => 'Sehat'
        ]);

        // 3. Seed Pakan
        \App\Models\Pakan::create([
            'nama_pakan' => 'Rumput Gajah',
            'stok' => 100.00,
            'satuan' => 'KG',
            'tanggal_pemberian' => now(),
            'keterangan' => 'Pakan harian utama'
        ]);

        // 4. Seed Produksi Susu
        \App\Models\ProduksiSusu::create([
            'sapi_id' => $sapi1->id,
            'tanggal' => now(),
            'jumlah_pagi' => 10.5,
            'jumlah_sore' => 8.2,
            'total' => 18.7
        ]);

        // 5. Seed Penjualan
        \App\Models\Penjualan::create([
            'tanggal' => now(),
            'pembeli' => 'Toko Makmur',
            'jumlah' => 10,
            'harga_satuan' => 15000,
            'total_harga' => 150000
        ]);
    }
}