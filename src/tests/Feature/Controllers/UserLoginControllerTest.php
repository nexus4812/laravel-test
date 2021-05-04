<?php


namespace Tests\Feature\Controllers;


use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Tests\Feature\Helpers\routeUrl;
use Tests\MyTestCase;
use Tests\TestCase;

class UserLoginControllerTest extends MyTestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected string $routeName = 'login.post';

    public function setUp(): void
    {
        parent::setUp();
        auth()->logout();
    }

    public function test_assert_can_see_login_view()
    {
        $this->get(route('login.get'))->assertOk();
    }

    public function test_assert_not_see_login_view()
    {
        auth()->login(User::factory()->create());
        $this->get(route('login.get'))->assertStatus(302);
    }

    public function test_assert_login_pattern_validate()
    {
        // パターンバリデーションで検証が正しくされる
        $this->routePost([User::EMAIL => null])->assertSessionHasErrors(User::EMAIL);
        $this->routePost([User::EMAIL => 'aaaa@aaadd@?'])->assertSessionHasErrors(User::EMAIL);
        $this->routePost([User::PASSWORD => null])->assertSessionHasErrors(User::PASSWORD);
        $this->routePost([User::PASSWORD => $this->faker->password(1,6)])->assertSessionHasErrors(User::PASSWORD);

        $this->assertFalse(Auth::check());
    }

    public function test_assert_login_domain_validate()
    {
        // 存在しないユーザーがログイン
        $this->routePost([
            User::EMAIL => $this->faker->safeEmail,
            User::PASSWORD => $this->faker->password(8,9),
        ])->assertSessionHasErrors(User::EMAIL);

        $email = $this->faker->safeEmail;
        $password = $this->faker->password;

        $user = User::factory()->create([
            User::EMAIL => $email,
            User::PASSWORD => bcrypt($password)
        ]);

        // メアドが間違っている
        $this->routePost([
            User::EMAIL => $this->faker->safeEmail,
            User::PASSWORD => $password,
        ])->assertSessionHasErrors(User::EMAIL);

        // パスワードが間違っている
        $this->routePost([
            User::EMAIL => $email,
            User::PASSWORD => $this->faker->password,
        ])->assertSessionHasErrors(User::EMAIL);

        $this->assertFalse(Auth::check());
    }

    public function test_assert_login(): void
    {
        // ログインが成功する
        $email = $this->faker->safeEmail;
        $password = $this->faker->password;

        $user = User::factory()->create([
            User::EMAIL => $email,
            User::PASSWORD => bcrypt($password)
        ]);

        $this->routePost([
            User::EMAIL => $email,
            User::PASSWORD => $password
        ])->assertSessionHasNoErrors()
            ->assertRedirect(route('mypage.blogs'));

        $this->assertTrue(Auth::check());
    }
}
