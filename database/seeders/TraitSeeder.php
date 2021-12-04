<?php

namespace Database\Seeders;

use App\Models\CharTrait;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TraitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CharTrait::truncate();
        DB::table('traits')->insert([
            [
                'name'          => 'Superhuman Agility',
                'description'   => 'Agility, balance and body-coordination that is much higher than that of the avaerga human being.'
            ],
            [
                'name'          => 'God-like Strength',
                'description'   => 'Possession of vast superhuman strength to which the full limits are not entirely known.'
            ],
            [
                'name'          => 'Superhuman Reflexes',
                'description'   => 'Reaction time that is much faster than the average human\'s'
            ],
            [
                'name'          => 'Superhuman Stamina',
                'description'   => 'Little to no fatigue to fatigue toxins during physical activity.'
            ],
            [
                'name'          => 'Invulnerability',
                'description'   => 'Near-full degree of resistance to physical injury.'
            ],
            [
                'name'          => 'Immortality',
                'description'   => 'Immunity to all known diesases, infections, and other common causes of death including aging.'
            ],
            [
                'name'          => 'Regenerative Healing Factor',
                'description'   => 'Abiilty to regenerate damaged body tissue at much greater speed and efficency than the average human.'
            ],
            [
                'name'          => 'Flight',
                'description'   => 'Ability to fly'
            ],
            [
                'name'          => 'Teleportation',
                'description'   => 'Ability to travel form place-to-place at high speeds.'
            ],
            [
                'name'          => 'Energy Manipulation',
                'description'   => 'Ability to control and project pure energy.'
            ],
            [
                'name'          => 'Telepathy',
                'description'   => 'Psionic abilities allowing the user to reach into the mind of others.'
            ],
            [
                'name'          => 'Time Travel',
                'description'   => 'Ability to travel through time'
            ],
            [
                'name'          => 'Power Nullification',
                'description'   => 'Abiilty to block offensive forms of sorcery'
            ],
            [
                'name'          => 'Telekinesis',
                'description'   => 'Abiilty to control the user\'s surrounding environment from their mind.'
            ],
            [
                'name'          => 'Hypnotism',
                'description'   => 'Ability to control another being\'s actions bu controlling their mind.'
            ],
            [
                'name'          => 'Wall Crawling',
                'description'   => 'Abiilty to traverse walls and ceilings and walls via mutagenic, cerebellum-wide alteration of the user\'s engrams resulting in the ability to mentally control the flux of interatomic attraction (electrostatic force) between molecular boundary layers.'
            ],
            [
                'name'          => 'Superhuman Durability',
                'description'   => 'Physically tougher and more resistant body to most, if not all types of injury than the average human body.'
            ],
            [
                'name'          => 'Enhanced Immune System',
                'description'   => 'High tolerance for drugs and diseases, with recovery much faster than the average human being.'
            ],
            [
                'name'          => 'Superhuman Equilibrium',
                'description'   => 'Ability to achieve a state of perfect balance in any position imaginable.'
            ],
            [
                'name'          => 'Spider-Sense',
                'description'   => 'Precognitive danger sense which warns the user of potential or immediate danger via manifestation of a tingling sensation within the skull.'
            ],
            [
                'name'          => 'Superhuman Strength',
                'description'   => 'Enchanced natural strenght, allowing the user to lift weights far heavier than the average human.'
            ],
            [
                'name'          => 'Bio-Electrokinesis',
                'description'   => 'Control over the natural electricity in the user\'s body'
            ],
            [
                'name'          => 'Camouflage',
                'description'   => 'Abiilty to blend into surroundings.'
            ],
            [
                'name'          => 'Artifical Body',
                'description'   => 'A false body in wihch the user relies on for varying degrees of enhanced abilities.'
            ],
            [
                'name'          => 'Cosmic Awareness',
                'description'   => 'Detection of direct threats and perceived changes in the universe.'
            ],
            [
                'name'          => 'Telepathy',
                'description'   => 'Ability to read the minds of virtually every known sentient life. Also able to project their thoughts into any sentient mind.'
            ],
            [
                'name'          => 'Illusion Generation',
                'description'   => 'Appearance alteration to any form of guise at will.'
            ],
            [
                'name'          => 'Force-Field Generation',
                'description'   => 'Ability to generate and manipulate force fields via cosmic energy.'
            ],
            [
                'name'          => 'Size Alteration',
                'description'   => 'Ability to assume different body proprtions at will.'
            ],
            [
                'name'          => 'Hellfire Manipulation',
                'description'   => 'Ability to generate, control and project mystical "hellfire" at will.'
            ],
            [
                'name'          => 'Sin Manipulation',
                'description'   => 'Ability to manipulate the immoral act known as sin.'
            ],
            [
                'name'          => 'Soul Manipulation',
                'description'   => 'Ability to manipulate souls, the incroporeal essence of a living thing.'
            ],
            [
                'name'          => 'Dimensional Travel',
                'description'   => 'Ability to traverse different dimensions'
            ],
            [
                'name'          => 'Demon Magic Manipulation',
                'description'   => 'Ability to utilise demonic forces and satanic spells to the user\'s advantage.'
            ],
            [
                'name'          => 'Penance Stare',
                'description'   => 'The supernatural ability to cause any individual who stares into the user\'s eyes to see and feel every bit of pain they have ever inflicted on anyone in their entire lifetime for all eternity.'
            ],
        ]);
    }
}
