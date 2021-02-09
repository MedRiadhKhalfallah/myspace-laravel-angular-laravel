<?php

namespace Database\Seeders;

use App\Models\Gouvernorat;
use Illuminate\Database\Seeder;

class GouvernoratsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gouvernorat::create(['id'=>'1','nom'=>'Ariana']);
        Gouvernorat::create(['id'=>'2','nom'=>'Beja']);
        Gouvernorat::create(['id'=>'3','nom'=>'Ben arous']);
        Gouvernorat::create(['id'=>'4','nom'=>'Bizerte']);
        Gouvernorat::create(['id'=>'5','nom'=>'Gabes']);
        Gouvernorat::create(['id'=>'6','nom'=>'Gafsa']);
        Gouvernorat::create(['id'=>'7','nom'=>'Jendouba']);
        Gouvernorat::create(['id'=>'8','nom'=>'Kairouan']);
        Gouvernorat::create(['id'=>'9','nom'=>'Kasserine']);
        Gouvernorat::create(['id'=>'10','nom'=>'Kebili']);
        Gouvernorat::create(['id'=>'11','nom'=>'Le Kef']);
        Gouvernorat::create(['id'=>'12','nom'=>'Mahdia']);
        Gouvernorat::create(['id'=>'13','nom'=>'Manouba']);
        Gouvernorat::create(['id'=>'14','nom'=>'Medenine']);
        Gouvernorat::create(['id'=>'15','nom'=>'Monastir']);
        Gouvernorat::create(['id'=>'16','nom'=>'Nabeul']);
        Gouvernorat::create(['id'=>'17','nom'=>'Sfax']);
        Gouvernorat::create(['id'=>'18','nom'=>'Sidi bouzid']);
        Gouvernorat::create(['id'=>'19','nom'=>'Siliana']);
        Gouvernorat::create(['id'=>'20','nom'=>'Sousse']);
        Gouvernorat::create(['id'=>'21','nom'=>'Tataouine']);
        Gouvernorat::create(['id'=>'22','nom'=>'Tozeur']);
        Gouvernorat::create(['id'=>'23','nom'=>'Tunis']);
        Gouvernorat::create(['id'=>'24','nom'=>'Zaghouan']);
    }
}
