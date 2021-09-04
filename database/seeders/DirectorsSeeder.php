<?php

namespace Database\Seeders;

use App\Models\Director;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirectorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('directors')->insert([
            [
                'name'  => 'James Gunn',
                'dob'   => Carbon::parse('1966-08-05'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/79/James_Gunn_%2828557194032%29_%28cropped%29.jpg/1024px-James_Gunn_%2828557194032%29_%28cropped%29.jpg'
            ],
            [
                'name'  => 'Jon Favreau',
                'dob'   => Carbon::parse('1966-10-19'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/eb/Jon_Favreau_2016.jpeg/1024px-Jon_Favreau_2016.jpeg'
            ],
            [
                'name'  => 'Louis Leterrier',
                'dob'   => Carbon::parse('1973-06-17'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Louis_Leterrier_by_Gage_Skidmore.jpg/440px-Louis_Leterrier_by_Gage_Skidmore.jpg'
            ],
            [
                'name'  => 'Kenneth Brannagh',
                'dob'   => Carbon::parse('1960-12-10'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c7/KennethBranaghApr2011.jpg/1280px-KennethBranaghApr2011.jpg'
            ],
            [
                'name'  => 'Joe Johnston',
                'dob'   => Carbon::parse('1950-05-13'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Joe_Johnston.jpg/440px-Joe_Johnston.jpg'
            ],
            [
                'name'  => 'Joss Whedon',
                'dob'   => Carbon::parse('1964-06-23'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b1/Joss_Whedon_by_Gage_Skidmore_7.jpg/1280px-Joss_Whedon_by_Gage_Skidmore_7.jpg'
            ],
            [
                'name'  => 'Shane Black',
                'dob'   => Carbon::parse('1961-12-16'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/18/Shane_Black_by_Gage_Skidmore.jpg/1024px-Shane_Black_by_Gage_Skidmore.jpg'
            ],
            [
                'name'  => 'Alan Taylor',
                'dob'   => Carbon::parse('1959-01-13'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/5/54/Alan_Taylor_2013_crop.jpg'
            ],
            [
                'name'  => 'Anthony Russo',
                'dob'   => Carbon::parse('1970-02-03'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/f/f1/Joe_Russo_%26_Anthony_Russo_by_Gage_Skidmore.jpg'
            ],
            [
                'name'  => 'Joe Russo',
                'dob'   => Carbon::parse('1971-07-18'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/f/f1/Joe_Russo_%26_Anthony_Russo_by_Gage_Skidmore.jpg'
            ],
            [
                'name'  => 'Peyton Reed',
                'dob'   => Carbon::parse('1964-07-03'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c7/Peyton_Reed_%28cropped%29.jpg/440px-Peyton_Reed_%28cropped%29.jpg'
            ],
            [
                'name'  => 'Scott Derickson',
                'dob'   => Carbon::parse('1966-07-16'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c6/Scott_Derrickson_by_Gage_Skidmore_%28cropped%29.jpg/1024px-Scott_Derrickson_by_Gage_Skidmore_%28cropped%29.jpg'
            ],
            [
                'name'  => 'Jon Watts',
                'dob'   => Carbon::parse('1981-06-28'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/26/Jon_Watts_by_Gage_Skidmore_2.jpg/1024px-Jon_Watts_by_Gage_Skidmore_2.jpg'
            ],
            [
                'name'  => 'Taika Waititi',
                'dob'   => Carbon::parse('1975-08-16'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/13/Taika_Waititi_by_Gage_Skidmore_2.jpg/440px-Taika_Waititi_by_Gage_Skidmore_2.jpg'
            ],
            [
                'name'  => 'Ryan Coogler',
                'dob'   => Carbon::parse('1986-05-23'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b3/Ryan_Coogler_by_Gage_Skidmore.jpg/1024px-Ryan_Coogler_by_Gage_Skidmore.jpg'
            ],
            [
                'name'  => 'Anna Boden',
                'dob'   => Carbon::parse('1979-10-20'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/1/16/Ryan-fleck-anne-boden.jpg'
            ],
            [
                'name'  => 'Ryan Fleck',
                'dob'   => Carbon::parse('1976-09-20'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/1/16/Ryan-fleck-anne-boden.jpg'
            ],
            [
                'name'  => 'Cate Shortland',
                'dob'   => Carbon::parse('1968-08-10'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/55/Cate_Shortland_by_Gage_Skidmore_%28cropped%29.jpg/440px-Cate_Shortland_by_Gage_Skidmore_%28cropped%29.jpg'
            ],
            [
                'name'  => 'Destin Daniel Cretton',
                'dob'   => Carbon::parse('1978-11-23'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Destin_Daniel_Cretton_by_Gage_Skidmore.jpg/440px-Destin_Daniel_Cretton_by_Gage_Skidmore.jpg'
            ],
            [
                'name'  => 'Chloe Zhao',
                'dob'   => Carbon::parse('1982-03-31'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Chloe_Zhao_by_Gage_Skidmore.jpg/1024px-Chloe_Zhao_by_Gage_Skidmore.jpg'
            ],
            [
                'name'  => 'Sam Raimi',
                'dob'   => Carbon::parse('1959-10-23'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Sam_Raimi_by_Gage_Skidmore_2.jpg/1024px-Sam_Raimi_by_Gage_Skidmore_2.jpg'
            ],
            [
                'name'  => 'Nia DaCosta',
                'dob'   => Carbon::parse('1989-11-08'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Sam_Raimi_by_Gage_Skidmore_2.jpg/1024px-Sam_Raimi_by_Gage_Skidmore_2.jpg'
            ],
            [
                'name'  => 'Nia DaCosta',
                'dob'   => Carbon::parse('1989-11-08'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Sam_Raimi_by_Gage_Skidmore_2.jpg/1024px-Sam_Raimi_by_Gage_Skidmore_2.jpg'
            ],
        ]);
    }
}
