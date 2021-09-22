<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      News::create([
         "id" => "11",
         "title" => "Covid-19",
         "writer" => "Gunawan",
         "category" => "News",
         "tag" => "Indonesia",
         "viewed" => "120",
         "shared" => "10",
         "liked" => "10",
         "content" => "covid 19 kian minggu pekan menurun 65 % dari kondisi awal bulan bulan sebelumnya",
         "cover" => "partner media tv",
         "timestamps" => ""
      ]);

      News::create([
         "id" => "12",
         "title" => "Covid-19",
         "writer" => "Andika",
         "category" => "News",
         "tag" => "Indonesia",
         "viewed" => "300",
         "shared" => "40",
         "liked" => "110",
         "content" => "covid 19 kian minggu pekan menurun 65 % dari kondisi awal bulan bulan sebelumnya",
         "cover" => "News Update",
         "timestamps" => ""
      ]);
    }
}
