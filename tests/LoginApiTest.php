<?php

use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Database\Factories\UserFactory;

class LoginApiTest extends TestCase
{
    use DatabaseTransactions;

    public function testCanCreateUser()
    {
        $payload = User::factory()->make()->toArray();
        $response = $this->post(route('api.register'), $payload);
        $response->receiveJson()->seeStatusCode(Response::HTTP_OK)
            ->seeJsonContains([
                'status' => 'SUCCESS'
        ]);
    }

    public function testCanAddUserRolesAndPermissions()
    {
        $user = User::factory()->create();
        $role = Role::where('name', 'web-developer')->first();
        $request = [
            'user_id' => $user->id,
            'role' => $role->name,
        ];
        $response = $this->post(route('api.roles.assign'), $request);
        $response->receiveJson()->seeStatusCode(Response::HTTP_OK)
            ->seeJsonContains([
                'status' => 'SUCCESS'
        ]);
    }

    public function testCanAuthenticateAndReturnResult()
    {
        // Create user and assign role
        $user = User::factory()->create();
        $role = Role::where('name', 'project-manager')->first();
        $manageUsers = Permission::where('name','manage-users')->first();
        $user->roles()->attach($role);
        $user->permissions()->attach($manageUsers);

        $response = $this->post(route('api.login'), ['email'=> $user->email, 'password' => $user->email]);
        $response->receiveJson()->seeStatusCode(Response::HTTP_OK)
            ->seeJsonStructure([
                'status',
                'user_id',
                'username',
                'roles',
                'permissions'
        ]);
    }

    public function testCanNotAuthenticateWithWrongCredentials()
    {
        $user = User::factory()->create();
        $response = $this->post(route('api.login'), ['email' => $user->email, 'password' => $user->name]);
        $response->receiveJson()->seeStatusCode(Response::HTTP_UNAUTHORIZED)
            ->seeJsonContains([
                'status' => 'FAIL'
        ]);
    }
}
