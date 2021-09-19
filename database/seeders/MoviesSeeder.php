<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movies')->insert([
            [
                'title'         => 'Iron Man',
                'release_date'  => Carbon::createFromDate(2008, 5, 2),
                'in_mcu'        => true,
                'mcu_phase_id'  => 1,
            ],
            [
                'title'         => 'The Incredible Hulk',
                'release_date'  => Carbon::createFromDate(2008, 6 ,12),
                'in_mcu'        => true,
                'mcu_phase_id'  => 1,
            ],
            [
                'title'         => 'Iron Man 2',
                'release_date'  => Carbon::createFromDate(2010, 5, 7),
                'in_mcu'        => true,
                'mcu_phase_id'  => 1,
            ],
            [
                'title'         => 'Thor',
                'release_date'  => Carbon::createFromDate(2011, 5, 6),
                'in_mcu'        => true,
                'mcu_phase_id'  => 1,
            ],
            [
                'title'         => 'Captain America: The First Avenger',
                'release_date'  => Carbon::createFromDate(2011, 7, 22),
                'in_mcu'        => true,
                'mcu_phase_id'  => 1,
            ],
            [
                'title'         => 'The Avengers',
                'release_date'  => Carbon::createFromDate(2012, 5, 4),
                'in_mcu'        => true,
                'mcu_phase_id'  => 1,
            ],
            [
                'title'         => 'Iron Man 3',
                'release_date'  => Carbon::createFromDate(2013, 5, 3),
                'in_mcu'        => true,
                'mcu_phase_id'  => 2,
            ],
            [
                'title'         => 'Thor: The Dark World',
                'release_date'  => Carbon::createFromDate(2013, 11, 8),
                'in_mcu'        => true,
                'mcu_phase_id'  => 2,
            ],
            [
                'title'         => 'Captain America: The Winter Soldier',
                'release_date'  => Carbon::createFromDate(2014, 4, 4),
                'in_mcu'        => true,
                'mcu_phase_id'  => 2,
            ],
            [
                'title'         => 'Guardians of the Galaxy',
                'release_date'  => Carbon::createFromDate(2014, 8, 1),
                'in_mcu'        => true,
                'mcu_phase_id'  => 2,
            ],
            [
                'title'         => 'Avengers: Age of Ultron',
                'release_date'  => Carbon::createFromDate(2015, 5, 1),
                'in_mcu'        => true,
                'mcu_phase_id'  => 2,
            ],
            [
                'title'         => 'Ant-Man',
                'release_date'  => Carbon::createFromDate(2015, 7, 17),
                'in_mcu'        => true,
                'mcu_phase_id'  => 2,
            ],
            [
                'title'         => 'Captain America: Civil War',
                'release_date'  => Carbon::createFromDate(2016, 5, 6),
                'in_mcu'        => true,
                'mcu_phase_id'  => 3,
            ],
            [
                'title'         => 'Doctor Strange',
                'release_date'  => Carbon::createFromDate(2016, 11, 4),
                'in_mcu'        => true,
                'mcu_phase_id'  => 3,
            ],
            [
                'title'         => 'Guardians of the Galaxy Vol. 2',
                'release_date'  => Carbon::createFromDate(2017, 5, 5),
                'in_mcu'        => true,
                'mcu_phase_id'  => 3,
            ],
            [
                'title'         => 'Spider-Man: Homecoming',
                'release_date'  => Carbon::createFromDate(2017, 7, 17),
                'in_mcu'        => true,
                'mcu_phase_id'  => 3,
            ],
            [
                'title'         => 'Thor: Ragnarok',
                'release_date'  => Carbon::createFromDate(2017, 11, 3),
                'in_mcu'        => true,
                'mcu_phase_id'  => 3,
            ],
            [
                'title'         => 'Black Panther',
                'release_date'  => Carbon::createFromDate(2018, 2, 16),
                'in_mcu'        => true,
                'mcu_phase_id'  => 3,
            ],
            [
                'title'         => 'Avengers: Infinity War',
                'release_date'  => Carbon::createFromDate(2018, 4, 27),
                'in_mcu'        => true,
                'mcu_phase_id'  => 3,
            ],
            [
                'title'         => 'Ant-Man and the Wasp',
                'release_date'  => Carbon::createFromDate(2018, 7, 6),
                'in_mcu'        => true,
                'mcu_phase_id'  => 3,
            ],
            [
                'title'         => 'Captain Marvel',
                'release_date'  => Carbon::createFromDate(2019, 3, 8),
                'in_mcu'        => true,
                'mcu_phase_id'  => 3,
            ],
            [
                'title'         => 'Avengers: Endgame',
                'release_date'  => Carbon::createFromDate(2019, 4, 26),
                'in_mcu'        => true,
                'mcu_phase_id'  => 3,
            ],
            [
                'title'         => 'Spider-Man: Far From Home',
                'release_date'  => Carbon::createFromDate(2019, 7, 2),
                'in_mcu'        => true,
                'mcu_phase_id'  => 3,
            ],
            [
                'title'         => 'Black Widow',
                'release_date'  => Carbon::createFromDate(2021, 7, 9),
                'in_mcu'        => true,
                'mcu_phase_id'  => 4,
            ],
            [
                'title'         => 'Shang-Chi and the Legend of the Ten Rings',
                'release_date'  => Carbon::createFromDate(2021, 9, 23),
                'in_mcu'        => true,
                'mcu_phase_id'  => 4,
            ],
            [
                'title'         => 'Eternals',
                'release_date'  => Carbon::createFromDate(2021, 11, 5),
                'in_mcu'        => true,
                'mcu_phase_id'  => 4,
            ],
            [
                'title'         => 'Spider-Man: No Way Home',
                'release_date'  => Carbon::createFromDate(2021, 12, 21),
                'in_mcu'        => true,
                'mcu_phase_id'  => 4,
            ],
            [
                'title'         => 'Doctor Strange in the Multiverse of Madness',
                'release_date'  => Carbon::createFromDate(2022, 3, 25),
                'in_mcu'        => true,
                'mcu_phase_id'  => 4,
            ],
            [
                'title'         => 'Thor: Love and Thunder',
                'release_date'  => Carbon::createFromDate(2022, 5, 6),
                'in_mcu'        => true,
                'mcu_phase_id'  => 4,
            ],
            [
                'title'         => 'Black Panther: Wakanda Forever',
                'release_date'  => Carbon::createFromDate(2022, 7, 8),
                'in_mcu'        => true,
                'mcu_phase_id'  => 4,
            ],
            [
                'title'         => 'The Marvels',
                'release_date'  => Carbon::createFromDate(2022, 9, 11),
                'in_mcu'        => true,
                'mcu_phase_id'  => 4,
            ],
            [
                'title'         => 'Ant-Man and the Wasp: Quantumania',
                'release_date'  => Carbon::createFromDate(2023, 2, 17),
                'in_mcu'        => true,
                'mcu_phase_id'  => 4,
            ],
            [
                'title'         => 'Fantastic Four',
                'release_date'  => null,
                'in_mcu'        => true,
                'mcu_phase_id'  => 4,
            ],
            
            [
                'title'         => 'Captain America (1944)',
                'release_date'  => Carbon::createFromDate(1944, 2, 5),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'Howard the Duck',
                'release_date'  => Carbon::createFromDate(1986, 8, 1),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'The Punisher (1989)',
                'release_date'  => Carbon::createFromDate(1989, 10, 5),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'Captain America (1990)',
                'release_date'  => Carbon::createFromDate(1990, 12, 14),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'Men In Black',
                'release_date'  => Carbon::createFromDate(1997, 7, 2),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'Men In Black 2',
                'release_date'  => Carbon::createFromDate(2002, 7, 3),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'Men In Black 3',
                'release_date'  => Carbon::createFromDate(2012, 5, 25),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'Blade',
                'release_date'  => Carbon::createFromDate(1998, 8, 21),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'Blade II',
                'release_date'  => Carbon::createFromDate(2002, 3, 22),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'Blade: Trinity',
                'release_date'  => Carbon::createFromDate(2004, 12, 8),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],

            [
                'title'         => 'X-Men',
                'release_date'  => Carbon::createFromDate(2000, 7, 14),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'X2',
                'release_date'  => Carbon::createFromDate(2003, 5, 2),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'X-Men: The Last Stand',
                'release_date'  => Carbon::createFromDate(2006, 5, 6),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'X-Men Origins: Wolverine',
                'release_date'  => Carbon::createFromDate(2009, 5, 1),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'X-Men: First Class',
                'release_date'  => Carbon::createFromDate(2011, 6, 1),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'The Wolverine',
                'release_date'  => Carbon::createFromDate(2013, 6, 26),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'X-Men: Days of Future Past',
                'release_date'  => Carbon::createFromDate(2014, 5, 23),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'X-Men: Apocalypse',
                'release_date'  => Carbon::createFromDate(2016, 5, 27),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'Logan',
                'release_date'  => Carbon::createFromDate(2017, 3, 3),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'Dark Phoenix',
                'release_date'  => Carbon::createFromDate(2019, 6, 7),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'The New Mutants',
                'release_date'  => Carbon::createFromDate(2020, 8, 8),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            
            [
                'title'         => 'Deadpool',
                'release_date'  => Carbon::createFromDate(2016, 2, 12),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'Deadpool 2',
                'release_date'  => Carbon::createFromDate(2018, 5, 18),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],

            [
                'title'         => 'Spider-Man',
                'release_date'  => Carbon::createFromDate(2002, 5, 3),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'Spider-Man 2',
                'release_date'  => Carbon::createFromDate(2004, 6, 30),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'Spider-Man 3',
                'release_date'  => Carbon::createFromDate(2007, 5, 4),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            
            [
                'title'         => 'Daredevil (2003)',
                'release_date'  => Carbon::createFromDate(2003, 2, 14),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            
            [
                'title'         => 'Hulk (2003)',
                'release_date'  => Carbon::createFromDate(2003, 6, 20),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            
            [
                'title'         => 'The Punisher (2004)',
                'release_date'  => Carbon::createFromDate(2004, 4, 16),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'Punisher: Warzone',
                'release_date'  => Carbon::createFromDate(2008, 12, 5),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],

            [
                'title'         => 'Elektra',
                'release_date'  => Carbon::createFromDate(2005, 1, 14),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            
            [
                'title'         => 'Fantastic Four',
                'release_date'  => Carbon::createFromDate(2005, 7, 8),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'Fantastic Four: Rise of the Silver Surfer',
                'release_date'  => Carbon::createFromDate(2007, 6, 15),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            
            [
                'title'         => 'Man-Thing',
                'release_date'  => Carbon::createFromDate(2005, 4, 30),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],

            [
                'title'         => 'Ghost Rider',
                'release_date'  => Carbon::createFromDate(2007, 2, 16),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'Ghost Rider: Spirit of Vengeance',
                'release_date'  => Carbon::createFromDate(2012, 2, 17),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            
            [
                'title'         => 'The Amazing Spider-Man',
                'release_date'  => Carbon::createFromDate(2012, 7, 3),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'The Amazing Spider-Man 2',
                'release_date'  => Carbon::createFromDate(2014, 5, 2),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            
            [
                'title'         => 'Fantastic Four (2015)',
                'release_date'  => Carbon::createFromDate(2015, 8, 7),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            
            [
                'title'         => 'Venom',
                'release_date'  => Carbon::createFromDate(2018, 10, 5),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'Venom: Let There Be Carnage',
                'release_date'  => Carbon::createFromDate(2021, 9, 24),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            
            [
                'title'         => 'Spider-Man: Into the Spider-Verse',
                'release_date'  => Carbon::createFromDate(2018, 12, 14),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'Spider-Man: Into the Spider-Verse 2',
                'release_date'  => Carbon::createFromDate(2022, 10, 7),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],

            [
                'title'         => 'Morbius',
                'release_date'  => Carbon::createFromDate(2022, 1, 8),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
            ],
        ]);
    }
}
