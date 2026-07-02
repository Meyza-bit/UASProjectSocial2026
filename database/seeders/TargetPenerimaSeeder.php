<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TargetPenerimaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('target_penerima')->insert([
            [
                'nama_target'        => 'Korban Gempa Cianjur',
                'kategori_target'    => 'Bencana Alam',
                'deskripsi_kebutuhan'=> 'Ribuan warga Cianjur kehilangan tempat tinggal akibat gempa 5,6 SR. Dibutuhkan bantuan sembako, pakaian, selimut, obat-obatan, dan tenda darurat.',
                'lokasi'             => 'Cianjur',
                'provinsi'           => 'Jawa Barat',
                'status_aktif'       => true,
                'gambar'             => null,
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'nama_target'        => 'Korban Banjir Jakarta',
                'kategori_target'    => 'Bencana Alam',
                'deskripsi_kebutuhan'=> 'Banjir merendam ribuan rumah di Jakarta. Warga membutuhkan bantuan makanan siap saji, air bersih, pakaian ganti, dan perlengkapan bayi.',
                'lokasi'             => 'Jakarta Timur',
                'provinsi'           => 'DKI Jakarta',
                'status_aktif'       => true,
                'gambar'             => null,
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'nama_target'        => 'Panti Asuhan Al-Ikhlas',
                'kategori_target'    => 'Panti Sosial',
                'deskripsi_kebutuhan'=> 'Panti asuhan dengan 60 anak yatim piatu yang membutuhkan dukungan biaya pendidikan, perlengkapan belajar, dan kebutuhan sehari-hari.',
                'lokasi'             => 'Bandung',
                'provinsi'           => 'Jawa Barat',
                'status_aktif'       => true,
                'gambar'             => null,
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'nama_target'        => 'Korban Erupsi Merapi',
                'kategori_target'    => 'Bencana Alam',
                'deskripsi_kebutuhan'=> 'Erupsi Gunung Merapi memaksa ribuan warga mengungsi. Dibutuhkan masker, obat-obatan, selimut, makanan, dan ternak pengganti.',
                'lokasi'             => 'Sleman',
                'provinsi'           => 'DI Yogyakarta',
                'status_aktif'       => true,
                'gambar'             => null,
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'nama_target'        => 'Panti Jompo Kasih Ibu',
                'kategori_target'    => 'Panti Sosial',
                'deskripsi_kebutuhan'=> 'Panti jompo dengan 45 lansia terlantar yang membutuhkan biaya perawatan, obat-obatan rutin, pakaian layak, dan kebutuhan makan sehari-hari.',
                'lokasi'             => 'Surabaya',
                'provinsi'           => 'Jawa Timur',
                'status_aktif'       => true,
                'gambar'             => null,
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
        ]);
    }
}
