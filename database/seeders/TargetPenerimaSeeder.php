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
                'nama_target'         => 'Korban Kebakaran Siantan',
                'kategori_target'     => 'Bencana Alam',
                'deskripsi_kebutuhan' => 'Kebakaran hebat melanda pemukiman padat di Siantan Hulu. Lebih dari 15 KK kehilangan tempat tinggal dan membutuhkan bantuan segera.',
                'lokasi'              => 'Siantan Hulu',
                'provinsi'            => 'Kalimantan Barat',
                'status_aktif'        => true,
                'gambar'              => null,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'nama_target'         => 'Korban Banjir Kapuas',
                'kategori_target'     => 'Bencana Alam',
                'deskripsi_kebutuhan' => 'Luapan Sungai Kapuas merendam ratusan rumah di Pontianak Timur. Warga membutuhkan makanan siap saji, air bersih, dan pakaian ganti.',
                'lokasi'              => 'Tambelan Sampit',
                'provinsi'            => 'Kalimantan Barat',
                'status_aktif'        => true,
                'gambar'              => null,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'nama_target'         => 'Panti Asuhan Ahmad Yani',
                'kategori_target'     => 'Panti Sosial',
                'deskripsi_kebutuhan' => 'Panti asuhan dengan 40 anak yatim piatu yang membutuhkan dukungan sembako, kasur layak, dan perlengkapan belajar.',
                'lokasi'              => 'Sungai Bangkong',
                'provinsi'            => 'Kalimantan Barat',
                'status_aktif'        => true,
                'gambar'              => null,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'nama_target'         => 'Korban Banjir Landak',
                'kategori_target'     => 'Bencana Alam',
                'deskripsi_kebutuhan' => 'Banjir bandang melanda Ngabang, Kabupaten Landak. Dibutuhkan air bersih, obat-obatan, dan kebutuhan darurat lainnya.',
                'lokasi'              => 'Ngabang',
                'provinsi'            => 'Kalimantan Barat',
                'status_aktif'        => true,
                'gambar'              => null,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'nama_target'         => 'Panti Jompo Kasih Ibu Pontianak',
                'kategori_target'     => 'Panti Sosial',
                'deskripsi_kebutuhan' => 'Panti jompo dengan 30 lansia terlantar yang membutuhkan biaya perawatan, obat-obatan rutin, dan kebutuhan sehari-hari.',
                'lokasi'              => 'Pontianak Selatan',
                'provinsi'            => 'Kalimantan Barat',
                'status_aktif'        => true,
                'gambar'              => null,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
        ]);
    }
}