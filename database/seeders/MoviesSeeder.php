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
                'director'      => 'Jon Favreau',
                'release_date'  => Carbon::createFromDate(2008, 5, 2),
                'in_mcu'        => true,
                'mcu_phase_id'  => 1,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/2008-iron_man-3.jpg'
            ],
            [
                'title'         => 'The Incredible Hulk',
                'director'      => 'Louis Leterrier',
                'release_date'  => Carbon::createFromDate(2008, 6 ,12),
                'in_mcu'        => true,
                'mcu_phase_id'  => 1,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/2008-incredible_hulk-2.jpg'
            ],
            [
                'title'         => 'Iron Man 2',
                'director'      => 'Jon Favreau',
                'release_date'  => Carbon::createFromDate(2010, 5, 7),
                'in_mcu'        => true,
                'mcu_phase_id'  => 1,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/iron-man2-poster6.jpg'
            ],
            [
                'title'         => 'Thor',
                'director'      => 'Kenneth Branagh',
                'release_date'  => Carbon::createFromDate(2011, 5, 6),
                'in_mcu'        => true,
                'mcu_phase_id'  => 1,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/thor-french-poster.jpg'
            ],
            [
                'title'         => 'Captain America: The First Avenger',
                'director'      => 'Joe Johnston',
                'release_date'  => Carbon::createFromDate(2011, 7, 22),
                'in_mcu'        => true,
                'mcu_phase_id'  => 1,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/captain-america-final-poster.jpg'
            ],
            [
                'title'         => 'The Avengers',
                'director'      => 'Joss Whedon',
                'release_date'  => Carbon::createFromDate(2012, 5, 4),
                'in_mcu'        => true,
                'mcu_phase_id'  => 1,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/AVG_new_onesheet.jpg'
            ],
            [
                'title'         => 'Iron Man 3',
                'director'      => 'Shane Black',
                'release_date'  => Carbon::createFromDate(2013, 5, 3),
                'in_mcu'        => true,
                'mcu_phase_id'  => 2,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/ironman3-tonysuit-post.jpg'
            ],
            [
                'title'         => 'Thor: The Dark World',
                'director'      => 'Alan Taylor',
                'release_date'  => Carbon::createFromDate(2013, 11, 8),
                'in_mcu'        => true,
                'mcu_phase_id'  => 2,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/thor_the_dark_world_ver7_xlg.jpg'
            ],
            [
                'title'         => 'Captain America: The Winter Soldier',
                'director'      => 'Anthony & Joe Russo',
                'release_date'  => Carbon::createFromDate(2014, 4, 4),
                'in_mcu'        => true,
                'mcu_phase_id'  => 2,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/captain-america-the-winter-soldier-posterB.jpg'
            ],
            [
                'title'         => 'Guardians of the Galaxy',
                'director'      => 'James Gunn',
                'release_date'  => Carbon::createFromDate(2014, 8, 1),
                'in_mcu'        => true,
                'mcu_phase_id'  => 2,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/GOTG_Payoff_1-Sht_v4b_Lg.jpg'
            ],
            [
                'title'         => 'Avengers: Age of Ultron',
                'director'      => 'Joss Whedon',
                'release_date'  => Carbon::createFromDate(2015, 5, 1),
                'in_mcu'        => true,
                'mcu_phase_id'  => 2,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/ageofultronposter.jpg'
            ],
            [
                'title'         => 'Ant-Man',
                'director'      => 'Peyton Reed',
                'release_date'  => Carbon::createFromDate(2015, 7, 17),
                'in_mcu'        => true,
                'mcu_phase_id'  => 2,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/ant-man-poster.jpg'
            ],
            [
                'title'         => 'Captain America: Civil War',
                'director'      => 'Anthony & Joe Russo',
                'release_date'  => Carbon::createFromDate(2016, 5, 6),
                'in_mcu'        => true,
                'mcu_phase_id'  => 3,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/Captain-America-Civil-War-main-poster.jpg'
            ],
            [
                'title'         => 'Doctor Strange',
                'director'      => 'Scott Derickson',
                'release_date'  => Carbon::createFromDate(2016, 11, 4),
                'in_mcu'        => true,
                'mcu_phase_id'  => 3,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/doctor_strange_poster_new.jpg'
            ],
            [
                'title'         => 'Guardians of the Galaxy Vol. 2',
                'director'      => 'James Gunn',
                'release_date'  => Carbon::createFromDate(2017, 5, 5),
                'in_mcu'        => true,
                'mcu_phase_id'  => 3,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/guardians_of_the_galaxy_vol_two_new_poster3.jpeg'
            ],
            [
                'title'         => 'Spider-Man: Homecoming',
                'director'      => 'Jon Watts',
                'release_date'  => Carbon::createFromDate(2017, 7, 17),
                'in_mcu'        => true,
                'mcu_phase_id'  => 3,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/Spider-Man-Homecoming-poster-2-large.jpg'
            ],
            [
                'title'         => 'Thor: Ragnarok',
                'director'      => 'Taika Waititi',
                'release_date'  => Carbon::createFromDate(2017, 11, 3),
                'in_mcu'        => true,
                'mcu_phase_id'  => 3,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/thor-ragnarok-poster-main.jpg'
            ],
            [
                'title'         => 'Black Panther',
                'director'      => 'Ryan Coogler',
                'release_date'  => Carbon::createFromDate(2018, 2, 16),
                'in_mcu'        => true,
                'mcu_phase_id'  => 3,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/Black-Panther-poster-main-xl.jpg'
            ],
            [
                'title'         => 'Avengers: Infinity War',
                'director'      => 'Anthony & Joe Russo',
                'release_date'  => Carbon::createFromDate(2018, 4, 27),
                'in_mcu'        => true,
                'mcu_phase_id'  => 3,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/infinity-war-poster-new.jpg'
            ],
            [
                'title'         => 'Ant-Man and the Wasp',
                'director'      => 'Peyton Reed',
                'release_date'  => Carbon::createFromDate(2018, 7, 6),
                'in_mcu'        => true,
                'mcu_phase_id'  => 3,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/antman_and_the_wasp_new.jpg'
            ],
            [
                'title'         => 'Captain Marvel',
                'director'      => 'Anna Boden & Ryan Fleck',
                'release_date'  => Carbon::createFromDate(2019, 3, 8),
                'in_mcu'        => true,
                'mcu_phase_id'  => 3,
                'image'         => 'https://www.joblo.com/assets/images/joblo/posters/2018/12/captain_marvel.jpg'
            ],
            [
                'title'         => 'Avengers: Endgame',
                'director'      => 'Anthony & Joe Russo',
                'release_date'  => Carbon::createFromDate(2019, 4, 26),
                'in_mcu'        => true,
                'mcu_phase_id'  => 3,
                'image'         => 'https://www.joblo.com/assets/images/joblo/posters/2019/03/avengers-endgame-poster-xl.jpg'
            ],
            [
                'title'         => 'Spider-Man: Far From Home',
                'director'      => 'Jon Watts',
                'release_date'  => Carbon::createFromDate(2019, 7, 2),
                'in_mcu'        => true,
                'mcu_phase_id'  => 3,
                'image'         => 'https://www.joblo.com/assets/images/joblo/posters/2019/01/Spider-Man-Far-From-Home-poster-1.jpg'
            ],
            [
                'title'         => 'Black Widow',
                'director'      => 'Cate Shortland',
                'release_date'  => Carbon::createFromDate(2021, 7, 9),
                'in_mcu'        => true,
                'mcu_phase_id'  => 4,
                'image'         => 'https://www.joblo.com/assets/images/joblo/posters/2019/12/Black-widow-poster.jpg'
            ],
            [
                'title'         => 'Shang-Chi and the Legend of the Ten Rings',
                'director'      => 'Destin Daniel Cretton',
                'release_date'  => Carbon::createFromDate(2021, 9, 23),
                'in_mcu'        => true,
                'mcu_phase_id'  => 4,
                'image'         => 'https://www.joblo.com/assets/images/joblo/posters/2021/07/shang-chi-new-poster-2.jpg'
            ],
            [
                'title'         => 'Eternals',
                'director'      => 'Chloe Zhao',
                'release_date'  => Carbon::createFromDate(2021, 11, 5),
                'in_mcu'        => true,
                'mcu_phase_id'  => 4,
                'image'         => 'https://www.joblo.com/assets/images/joblo/posters/2021/07/eternals-poster.jpg'
            ],
            [
                'title'         => 'Spider-Man: No Way Home',
                'director'      => 'Jon Watts',
                'release_date'  => Carbon::createFromDate(2021, 12, 21),
                'in_mcu'        => true,
                'mcu_phase_id'  => 4,
                'image'         => 'https://www.joblo.com/assets/images/joblo/posters/2021/07/rsz_no-way-home-poster.jpg'
            ],
            [
                'title'         => 'Doctor Strange in the Multiverse of Madness',
                'director'      => 'Sam Raimi',
                'release_date'  => Carbon::createFromDate(2022, 3, 25),
                'in_mcu'        => true,
                'mcu_phase_id'  => 4,
                'image'         => null
            ],
            [
                'title'         => 'Thor: Love and Thunder',
                'director'      => 'Taika Waititi',
                'release_date'  => Carbon::createFromDate(2022, 5, 6),
                'in_mcu'        => true,
                'mcu_phase_id'  => 4,
                'image'         => 'https://www.joblo.com/assets/images/joblo/posters/2021/07/thor-love-thunder.jpg'
            ],
            [
                'title'         => 'Black Panther: Wakanda Forever',
                'director'      => 'Ryan Coogler',
                'release_date'  => Carbon::createFromDate(2022, 7, 8),
                'in_mcu'        => true,
                'mcu_phase_id'  => 4,
                'image'         => null
            ],
            [
                'title'         => 'The Marvels',
                'director'      => 'Nia DaCosta',
                'release_date'  => Carbon::createFromDate(2022, 9, 11),
                'in_mcu'        => true,
                'mcu_phase_id'  => 4,
                'image'         => null
            ],
            [
                'title'         => 'Ant-Man and the Wasp: Quantumania',
                'director'      => 'Peyton Reed',
                'release_date'  => Carbon::createFromDate(2023, 2, 17),
                'in_mcu'        => true,
                'mcu_phase_id'  => 4,
                'image'         => null
            ],
            [
                'title'         => 'Fantastic Four',
                'director'      => 'Jon Watts',
                'release_date'  => null,
                'in_mcu'        => true,
                'mcu_phase_id'  => 4,
                'image'         => null
            ],
            
            [
                'title'         => 'Captain America (1944)',
                'director'      => 'Elmer Clifton & John English',
                'release_date'  => Carbon::createFromDate(1944, 2, 5),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://m.media-amazon.com/images/M/MV5BZjY4MjQ2MGMtYzNlMC00MGYwLWJlZjUtNjMxZWNhNDA5Y2UwXkEyXkFqcGdeQXVyNTc4Njg5MjA@._V1_.jpg'
            ],
            [
                'title'         => 'Howard the Duck',
                'director'      => 'Willard Huyck',
                'release_date'  => Carbon::createFromDate(1986, 8, 1),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/1986-howard-the-duck-poster1.jpg'
            ],
            [
                'title'         => 'The Punisher (1989)',
                'director'      => 'Mark Goldblatt',
                'release_date'  => Carbon::createFromDate(1989, 10, 5),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://m.media-amazon.com/images/M/MV5BZGFlMDYyOTQtZDliMS00MTk0LThiYjktNTljOWNjM2FjZWI4XkEyXkFqcGdeQXVyMDEwMjgxNg@@._V1_.jpg'
            ],
            [
                'title'         => 'Captain America (1990)',
                'director'      => 'Albert Pyun',
                'release_date'  => Carbon::createFromDate(1990, 12, 14),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://m.media-amazon.com/images/M/MV5BZDkxMjg3MzAtMmFjYS00YzUyLWFhYTQtZmFlMzFhZDhjNDI5XkEyXkFqcGdeQXVyMTExNDQ2MTI@._V1_.jpg'
            ],
            [
                'title'         => 'Men In Black',
                'director'      => 'Barry Sonnennfeld',
                'release_date'  => Carbon::createFromDate(1997, 7, 2),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/1997-men-in-black-poster1.jpg'
            ],
            [
                'title'         => 'Men In Black 2',
                'director'      => 'Barry Sonnennfeld',
                'release_date'  => Carbon::createFromDate(2002, 7, 3),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/2002-men_in_black_ii-1.jpg'
            ],
            [
                'title'         => 'Men In Black 3',
                'director'      => 'Barry Sonnennfeld',
                'release_date'  => Carbon::createFromDate(2012, 5, 25),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/MenInBlackIIIposter3.jpg'
            ],
            [
                'title'         => 'Blade',
                'director'      => 'Stephen Norrington',
                'release_date'  => Carbon::createFromDate(1998, 8, 21),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/1998-poster-blade-1.jpg'
            ],
            [
                'title'         => 'Blade II',
                'director'      => 'Guillermo del Toro',
                'release_date'  => Carbon::createFromDate(2002, 3, 22),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/2002-blade_ii-2.jpg'
            ],
            [
                'title'         => 'Blade: Trinity',
                'director'      => 'David S. Goyer',
                'release_date'  => Carbon::createFromDate(2004, 12, 8),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/2004-blade_trinity-2.jpg'
            ],

            [
                'title'         => 'X-Men',
                'director'      => 'Bryan Singer',
                'release_date'  => Carbon::createFromDate(2000, 7, 14),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/2000-poster-xmen-2.jpg'
            ],
            [
                'title'         => 'X2',
                'director'      => 'Bryan Singer',
                'release_date'  => Carbon::createFromDate(2003, 5, 2),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/2003-x_men_two-2.jpg'
            ],
            [
                'title'         => 'X-Men: The Last Stand',
                'director'      => 'Brett Ratner',
                'release_date'  => Carbon::createFromDate(2006, 5, 6),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/2006-x_men_3-1.jpg'
            ],
            [
                'title'         => 'X-Men Origins: Wolverine',
                'director'      => 'Gavin Hood',
                'release_date'  => Carbon::createFromDate(2009, 5, 1),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/2009-x_men_origins_wolverine-1.jpg'
            ],
            [
                'title'         => 'X-Men: First Class',
                'director'      => 'Matthew Vaughn',
                'release_date'  => Carbon::createFromDate(2011, 6, 1),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/xmen-first-class-poster1-2.jpg'
            ],
            [
                'title'         => 'The Wolverine',
                'director'      => 'James Mangold',
                'release_date'  => Carbon::createFromDate(2013, 6, 26),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/The-Wolverine-Poster-1.jpg'
            ],
            [
                'title'         => 'X-Men: Days of Future Past',
                'director'      => 'Bryan Singer',
                'release_date'  => Carbon::createFromDate(2014, 5, 23),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/xmen_days_of_future_past_ver5_xlg.jpg'
            ],
            [
                'title'         => 'X-Men: Apocalypse',
                'director'      => 'Bryan Singer',
                'release_date'  => Carbon::createFromDate(2016, 5, 27),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/xmen_apocalypse_poster.jpg'
            ],
            [
                'title'         => 'Logan',
                'director'      => 'James Mangold',
                'release_date'  => Carbon::createFromDate(2017, 3, 3),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/logan-intlf-teaser-poster-gallery.jpg'
            ],
            [
                'title'         => 'Dark Phoenix',
                'director'      => 'Simon Kinberg',
                'release_date'  => Carbon::createFromDate(2019, 6, 7),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/joblo/posters/2019/05/new-dark-phoenix-poster-xl.jpg'
            ],
            [
                'title'         => 'The New Mutants',
                'director'      => 'Josh Boone',
                'release_date'  => Carbon::createFromDate(2020, 8, 8),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://m.media-amazon.com/images/M/MV5BZDQ2NTdmNDgtMGIwMS00ODE2LTk5M2EtZGZhYzc4MWRlNTU3XkEyXkFqcGdeQXVyNTc4MjczMTM@._V1_.jpg'
            ],
            
            [
                'title'         => 'Deadpool',
                'director'      => 'Tim Miller',
                'release_date'  => Carbon::createFromDate(2016, 2, 12),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/Deadpool-poster-8.jpg'
            ],
            [
                'title'         => 'Deadpool 2',
                'director'      => 'Daivd Leitch',
                'release_date'  => Carbon::createFromDate(2018, 5, 18),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/deadpool2-poster-flash-xxl.jpg'
            ],

            [
                'title'         => 'Spider-Man',
                'director'      => 'Sam Raimi',
                'release_date'  => Carbon::createFromDate(2002, 5, 3),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/2002-spiderman-2.jpg'
            ],
            [
                'title'         => 'Spider-Man 2',
                'director'      => 'Sam Raimi',
                'release_date'  => Carbon::createFromDate(2004, 6, 30),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/2004-spider_man2-4.jpg'
            ],
            [
                'title'         => 'Spider-Man 3',
                'director'      => 'Sam Raimi',
                'release_date'  => Carbon::createFromDate(2007, 5, 4),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/2007-spider_man3-6.jpg'
            ],
            
            [
                'title'         => 'Daredevil (2003)',
                'director'      => 'Mark Steven Johnson',
                'release_date'  => Carbon::createFromDate(2003, 2, 14),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/2003-daredevil-2.jpg'
            ],
            
            [
                'title'         => 'Hulk (2003)',
                'director'      => 'Ang Lee',
                'release_date'  => Carbon::createFromDate(2003, 6, 20),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/2003-hulk-1.jpg'
            ],
            
            [
                'title'         => 'The Punisher (2004)',
                'director'      => 'Jonathan Hensleigh',
                'release_date'  => Carbon::createFromDate(2004, 4, 16),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/2004-punisher-3.jpg'
            ],
            [
                'title'         => 'Punisher: Warzone',
                'director'      => 'Lexi Alexander',
                'release_date'  => Carbon::createFromDate(2008, 12, 5),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/2008-punisher_war_zone-7.jpg'
            ],

            [
                'title'         => 'Elektra',
                'director'      => 'Rob Bowman',
                'release_date'  => Carbon::createFromDate(2005, 1, 14),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/2005-elektra-2.jpg'
            ],
            
            [
                'title'         => 'Fantastic Four',
                'director'      => 'Tim Story',
                'release_date'  => Carbon::createFromDate(2005, 7, 8),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/2005-fantastic_four-3.jpg'
            ],
            [
                'title'         => 'Fantastic Four: Rise of the Silver Surfer',
                'director'      => 'Tim Story',
                'release_date'  => Carbon::createFromDate(2007, 6, 15),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/2007-fantastic_four_rise_of_the_silver_surfer-8.jpg'
            ],
            
            [
                'title'         => 'Man-Thing',
                'director'      => 'Brett Leonard',
                'release_date'  => Carbon::createFromDate(2005, 4, 30),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://m.media-amazon.com/images/M/MV5BMzk4Mzc2M2YtZWRkNy00YWMzLTlmZTQtYTY4NWUzYjI1ODJiXkEyXkFqcGdeQXVyMTEyNzgwMDUw._V1_.jpg'
            ],

            [
                'title'         => 'Ghost Rider',
                'director'      => 'Mark Steven Johnson',
                'release_date'  => Carbon::createFromDate(2007, 2, 16),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/2007-ghost_rider-6.jpg'
            ],
            [
                'title'         => 'Ghost Rider: Spirit of Vengeance',
                'director'      => 'Mark Steven Johnson',
                'release_date'  => Carbon::createFromDate(2012, 2, 17),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/ghost-rider-2-poster.jpg'
            ],
            
            [
                'title'         => 'The Amazing Spider-Man',
                'director'      => 'Marc Webb',
                'release_date'  => Carbon::createFromDate(2012, 7, 3),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/amazing-spider-man-movie-poster.jpg'
            ],
            [
                'title'         => 'The Amazing Spider-Man 2',
                'director'      => 'Marc Webb',
                'release_date'  => Carbon::createFromDate(2014, 5, 2),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/spider-man2-face-off-poster.jpg'
            ],
            
            [
                'title'         => 'Fantastic Four (2015)',
                'director'      => 'Josh Trank',
                'release_date'  => Carbon::createFromDate(2015, 8, 7),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/fantastic-four-poster.jpg'
            ],
            
            [
                'title'         => 'Venom',
                'director'      => 'Ruben Fleischer',
                'release_date'  => Carbon::createFromDate(2018, 10, 5),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/oldsite/posters/images/full/venompostertransform.jpg'
            ],
            [
                'title'         => 'Venom: Let There Be Carnage',
                'director'      => 'Andy Serkis',
                'release_date'  => Carbon::createFromDate(2021, 9, 24),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/joblo/posters/2021/07/7BD657E3-16A8-4C4F-9E73-BC641FAD74CD.jpeg'
            ],
            
            [
                'title'         => 'Spider-Man: Into the Spider-Verse',
                'director'      => 'Bob Persischetti, Peter Ramsey & Rodney Rothman',
                'release_date'  => Carbon::createFromDate(2018, 12, 14),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => 'https://www.joblo.com/assets/images/joblo/posters/2018/11/Spider-Verse-poster-1.jpg'
            ],
            [
                'title'         => 'Spider-Man: Into the Spider-Verse 2',
                'director'      => 'Joaquim Dos Santos, Kemp Powers & Justin K. Thompson',
                'release_date'  => Carbon::createFromDate(2022, 10, 7),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => null
            ],

            [
                'title'         => 'Morbius',
                'director'      => 'Daniel Espinosa',
                'release_date'  => Carbon::createFromDate(2022, 1, 8),
                'in_mcu'        => false,
                'mcu_phase_id'  => null,
                'image'         => null
            ],
        ]);
    }
}
