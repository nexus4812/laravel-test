<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SingUpControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_new_user(): void
    {
        $password = $this->faker->password(8);

        $data = [
            User::NAME => $this->faker->name,
            User::EMAIL => $this->faker->safeEmail,
            User::PASSWORD => $password,
        ];

        $response = $this->post(route('singup.post'), $data);
        $response->assertRedirect(route('mypage.blogs'));

        unset($data[User::PASSWORD]);

        $this->assertDatabaseHas(User::TABLE, $data);

        /** @var User $user */
        $user = User::query()->firstWhere($data);
        $this->assertNotNull($user);

        $this->assertTrue(Hash::check($password, $user->password));
    }

    public function test_can_validate_data(): void
    {
        // --- Pattern validetion test ------------------------
        $this->post(route('singup.post'), [User::NAME => null])->assertSessionHasErrors(User::NAME);
        $this->post(route('singup.post'), [User::NAME => str_repeat('a', 21)])->assertSessionHasErrors(User::NAME);

        $this->post(route('singup.post'), [User::EMAIL => null])->assertSessionHasErrors(User::EMAIL);
        $this->post(route('singup.post'), [User::EMAIL => 'aaaa@aaadd@?'])->assertSessionHasErrors(User::EMAIL);

        $this->post(route('singup.post'), [User::PASSWORD => null])->assertSessionHasErrors(User::PASSWORD);
        $this->post(route('singup.post'), [User::PASSWORD => $this->faker->password(1,6)])->assertSessionHasErrors(User::PASSWORD);

        // --- Domain validation test  -------------------------
        /** @var User $user */
        $user = User::factory()->create();

        $this->post(route('singup.post'), [User::EMAIL => $user->email])->assertSessionHasErrors(User::EMAIL);
    }
}
