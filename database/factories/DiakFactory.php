<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Diak>
 */
class DiakFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        $prefix = '$2y$';
        $cost = '10';
        $salt = '$thisisahardcodedsalt$';
        $blowfishPrefix = $prefix.$cost.$salt;
        $password = 'alma';
        $hash = crypt($password, $blowfishPrefix);

        return [

                "vnev"=> $this->faker->firstName($gender),
                'knev' => $this->faker->lastName(),
                'azonosito'=> $this->faker->bothify('d#?#?#'),
                'jelszo'=>$hash,
                'felh_tipus_ID'=>1
        ];
    }
}
/*
// This tells crypt() to use the BLOWFISH cypher
$prefix = '$2y$';

// This tells crypt() the number of rounds for the BLOWFISH algorithm to use.
// The higher the number, the longer it takes to generate a hash (good).
// Value must be two digits and between 04 and 31. 10 is default.
$cost = '10';

// This is the 22 character salt (including start and end dollar signs). This is
// the value normally dynamically generated by password_hash(), but you
// are storing a static value in your application.
$salt = '$thisisahardcodedsalt$';

// Concat the three parameters to generate the full 28 character BLOWFISH
// prefix. Instead of using the hardcoded variables above, you would
// probably just get the value out of the config (set by .env file).
$blowfishPrefix = $prefix.$cost.$salt;

// I don't know where your password is coming from, but this is the password
// that you were planning on using for your Hash::make() and Hash::check()
// calls.
$password = 'This is your password.';

// Hash the password to get your 60 character BLOWFISH cipher result.
$hash = crypt($password, $blowfishPrefix);

// The real hash is the last 32 characters. This is the value you pass to your
// third party service.
$hashToThirdParty = substr($hash, -32);

// Now we've generated a hash and sent it to the third party. Now we wait.

// ... at some point, the third party sends the hash back to you.
$hashFromThirdParty = $hashToThirdParty;

// Add your stored BLOWFISH prefix to the hash received from the third party,
// and pass the result into Hash::check() (along with your password).
$verified = Hash::check($password, $blowfishPrefix.$hashFromThirdParty);

// Since we're not using Hash::make() to generate the password, you may not care
// about using Hash::check() to check it. You can just use the underlying
// password_verify() function at this point, if you want.
$altVerified = password_verify($password, $blowfishPrefix.$hashFromThirdParty);
*/
