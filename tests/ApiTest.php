<?php

namespace Tests;

use App\Models\Character;
use App\Models\CharacterType;
use App\Models\CharTrait;
use App\Models\ComicBook;
use App\Models\Director;
use App\Models\McuPhase;
use App\Models\Movie;
use App\Models\MovieDirector;
use App\Models\MovieMovieSaga;
use App\Models\MoviePoster;
use App\Models\MovieSaga;
use App\Models\Skill;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends MarvelTest
{
    use RefreshDatabase;

    public $api_key;
    public $shop_url;
    public $headers;
    public $trade_in;
    public $path_prefix;

    protected $character;
    protected $comic_book;
    protected $director;
    protected $movie;
    protected $phase;
    protected $poster;
    protected $trait;
    protected $type;

    protected function setUp(): void
    {
        parent::setUp();

        // Generate API token
        $token = $this->user->createToken('Test Token', ['create', 'read']);
        $this->api_key = explode('|', $token->plainTextToken, 2)[1];


        $this->headers = [
            'Accept'                    => 'application/json'
        ];

        $this->path_prefix = "/api";
    }

    /**
     * Creates an MCU movie instance 
     *
     * @return \App\Models\Movie
     */
    protected function createMcuMovie()
    {
        return $this->movie = Movie::create([
            "title"         => "New Movie",
            "release_date"  => Carbon::parse("2021-10-29"),
            "in_mcu"        => 1,
            "mcu_phase_id"  => 1
        ]);
    }
    
    /**
     * Creates a non-MCU movie instance 
     *
     * @return \App\Models\Movie
     */
    protected function createNonMcuMovie()
    {
        return $this->movie = Movie::create([
            "title"         => "New Movie",
            "release_date"  => Carbon::parse("2021-10-29"),
            "in_mcu"        => 0,
            "mcu_phase_id"  => null
        ]);
    }

    /**
     * Creates movie instance  with a saga attached
     *
     * @param integer $saga_id
     * @return \App\Models\Movie
     */
    public function createMovieWithSaga($saga_id)
    {
        return $this->movie = Movie::create([
            "title"         => "New Movie",
            "release_date"  => Carbon::parse("2021-10-29"),
            "in_mcu"        => 0,
            "mcu_phase_id"  => null,
            "sagas"         => [
                "id" => $saga_id
            ]
        ]);
    }

    /**
     * Creates a movie instance with an associated poster
     *
     * @return void
     */
    public function createMovieWithPoster()
    {
        $this->createMcuMovie();
        $this->movie->posters()->create([
            'image_url' => "https://oyster.ignimgs.com/wordpress/stg.ign.com/2021/04/Shang-Chi-Poster-Marvel.jpg"
        ]);
        return $this->poster = $this->movie->getPosterAttribute();
    }

    /**
     * Deletes all movies from DB
     *
     * @return void
     */
    protected function flushMovies()
    {
        foreach (Movie::all() as $movie) {
            $movie->delete();
        }
    }
    
    /**
     * Deletes all saga and movie-saga relationships from DB
     *
     * @return void
     */
    protected function flushSagas()
    {
        foreach (MovieSaga::all() as $saga) {
            $saga->delete();
        }
        
        foreach (MovieMovieSaga::all() as $saga) {
            $saga->delete();
        }
    }

    /**
     * Creates a director instance
     *
     * @return \App\Models\Director
     */
    protected function createDirector()
    {
        return $this->director = Director::create([
            'name'  => "Test Director",
            'dob'   => date('Y-m-d', strtotime(now())),
            'image' => "https://upload.wikimedia.org/wikipedia/commons/thumb/7/79/James_Gunn_%2828557194032%29_%28cropped%29.jpg/1024px-James_Gunn_%2828557194032%29_%28cropped%29.jpg"
        ]);
    }
    
    /**
     * Deletes all director and movie-director relationships from DB
     *
     * @return void
     */
    protected function flushDirectors()
    {
        foreach (Director::all() as $director) {
            $director->delete();
        }
        
        foreach (MovieDirector::all() as $director) {
            $director->delete();
        }
    }

    /**
     * Deletes all posters from DB
     *
     * @return void
     */
    protected function flushPosters()
    {
        foreach (MoviePoster::all() as $poster) {
            $poster->delete();
        }
    }

    /**
     * Creates a new character instance
     *
     * @return \App\Models\Character
     */
    protected function createCharacter()
    {
        $this->character = Character::create([
            'alias'     => "Testing Alias",
            'real_name' => "Testing Name",
            'sex'       => "unknown",
            'thumb_url' => "https://www.nicepng.com/png/detail/556-5566636_helen-romero-person-headshot-silhouette.png",
            'morality'  => "neutral",
            'type_id'   => 1
        ]);

        // Create skill instances for test character
        foreach (Skill::all() as $skill) {
            $this->character->skills()->attach($skill->id, ['value' => 1]);
        }
    }

    /**
     * Removes all character instances from the DB
     *
     * @return void
     */
    protected function flushCharacters()
    {
        foreach (Character::all() as $character) {
            $character->delete();
        }
    }

    protected function createCharacterType()
    {
        return $this->type = CharacterType::create([
            'key'   => 'testing',
            'type'  => 'Testing'
        ]);
    }

    /**
     * Deletes all character type instances
     *
     * @return void
     */
    protected function flushCharacterTypes()
    {
        foreach (CharacterType::all() as $type) {
            $type->delete();
        }
    }

    /**
     * Creates a new trait instance
     *
     * @return \App\Models\CharTrait
     */
    protected function createTrait()
    {
        return $this->trait = CharTrait::create([
            'name'          => "Testing",
            'description'   => "Testing description"
        ]);
    }

    /**
     * Flushes the traits table
     *
     * @return void
     */
    protected function flushTraits()
    {
        foreach (CharTrait::all() as $trait) {
            $trait->delete();
        }
    }

    /**
     * Flushes the skills table
     *
     * @return void
     */
    protected function flushSkills()
    {
        foreach (Skill::all() as $skill) {
            $skill->delete();
        }
    }

    /**
     * Creates a new phase instance
     *
     * @return \App\Models\McuPhase
     */
    protected function createPhase()
    {
        return $this->phase = McuPhase::create([
            'title' => "Testing Phase"
        ]);
    }

    /**
     * Flushes the traits table
     *
     * @return void
     */
    protected function flushPhases()
    {
        foreach (McuPhase::all() as $phase) {
            $phase->delete();
        }
    }

    /**
     * Create a new comic book instance
     *
     * @return \App\Models\ComicBook
     */
    protected function createComicBook()
    {
        return $this->comic_book = ComicBook::create([
            "title"         => "Testing Comic",
            "description"   => "Testing Comic Description",
            "release_date"  => date("Y-m-d", strtotime(date(now()))),
            "writers"       => [
                ["id"       => 1]
            ],
            "comic_issues"  => [
                [
                    "title"         => "Test Issue",
                    "description"   => "Test Issue Description",
                    "issue_number"  => 1,
                    "volume_number" => 1,
                    "release_date"  => date("Y-m-d", strtotime(date(now()))),
                    "characters"    => [
                        ["id" => 1]
                    ],
                    "covers"        => [
                        [
                            "id"            => 1,
                            "comic_id"      => 1,
                            "cover_url"     => "https://upload.wikimedia.org/wikipedia/en/4/47/Iron_Man_%28circa_2018%29.png",
                            "is_variant"    => 0,
                            "variant_issue" => null
                        ]
                    ],
                ]
            ]
        ]);
    }

    /**
     * Flushes the comic book table
     *
     * @return void
     */
    protected function flushComicBooks()
    {
        foreach (ComicBook::all() as $comic) {
            $comic->delete();
        }
    }
}
