<?php


namespace Tests\Unit\Services;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\UserServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class UserServiceTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase, WithFaker;

    /**
     * @test
     * @return void
     */
    public function it_can_return_a_paginated_list_of_users()
    {
        // Arrangements
        $users = User::factory()->count(50)->create();
        $user_service = app()->make(UserServiceInterface::class);

        // Actions
        $users = $user_service->list();

        // Assertions
        $this->assertTrue($users instanceof LengthAwarePaginator);
        $this->assertTrue($users->total() == 50);
    }

    /**
     * @test
     * @return void
     */
    public function it_can_store_a_user_to_database()
    {
        // Arrangements
        $new_user = User::factory()->make()->toArray();
        $new_user['password'] = 'password';
        $new_user['password_confirmation'] = $new_user['password'];
        $new_user['type'] = null;
        $user_service = app()->make(UserServiceInterface::class);
        
        // // Actions
        $user_service->store($new_user);

        // Assertions
        $this->assertDatabaseHas('users', ['email' => $new_user['email']]);
    }

    /**
     * @test
     * @return void
     */
    public function it_can_find_and_return_an_existing_user()
    {
        // Arrangements
        User::factory()->create();
        $user_service = app()->make(UserServiceInterface::class);
        $user_by_model = User::find(1);

        // Actions
        $user_by_service = $user_service->find($user_by_model->id);

        // Assertions
        $this->assertTrue($user_by_service->is($user_by_model));
    }

    /**
     * @test
     * @return void
     */
    public function it_can_update_an_existing_user()
    {
        // Arrangements
        User::factory()->create();
        $user_service = app()->make(UserServiceInterface::class);

        // Actions
        $user_by_model = User::find(1);
        $user_by_model->firstname = 'Newfirstname';
        $user_by_model->lastname = 'Newlastname';
        $user_by_model->email = 'newemail@example.com';
        $user_service->update(1, $user_by_model->toArray());
        $user = $user_service->find(1);

        // Assertions
        $this->assertTrue($user->firstname == 'Newfirstname');
        $this->assertTrue($user->lastname == 'Newlastname');
        $this->assertTrue($user->email == 'newemail@example.com');
    }

    /**
     * @test
     * @return void
     */
    public function it_can_soft_delete_an_existing_user()
    {
        // Arrangements
        User::factory()->count(10)->create();
        $user_service = app()->make(UserServiceInterface::class);

        // Actions
        $user_service->destroy(5);
        $users = User::all();
        $softdeleted_users = User::onlyTrashed()->get();

        // Assertions
        $this->assertTrue($users->count() == 9);
        $this->assertTrue(!$users->contains(5));
        $this->assertTrue($softdeleted_users->count() == 1);
        $this->assertTrue($softdeleted_users->contains(5));
    }

    /**
     * @test
     * @return void
     */
    public function it_can_return_a_paginated_list_of_trashed_users()
    {
        // Arrangements
        User::factory()->count(50)->create();
        $user_service = app()->make(UserServiceInterface::class);

        // Actions
        for ($i = 26; $i <= 50; $i++) {
            $user_service->destroy($i);
        }
        $trashed_users = $user_service->listTrashed();

        // Assertions
        $this->assertTrue($trashed_users instanceof LengthAwarePaginator);
        $this->assertTrue($trashed_users->total() == 25);
    }

    /**
     * @test
     * @return void
     */
    public function it_can_restore_a_soft_deleted_user()
    {
        // Arrangements
        User::factory()->count(10)->create();
        $user_service = app()->make(UserServiceInterface::class);

        // Actions
        $user_service->destroy(5);
        $user_service->restore(5);
        $users_by_model = User::all();

        // Assertions
        $this->assertTrue($users_by_model->contains(5));
    }

    /**
     * @test
     * @return void
     */
    public function it_can_permanently_delete_a_soft_deleted_user()
    {
        // Arrangements
        User::factory()->count(10)->create();
        $user_service = app()->make(UserServiceInterface::class);

        // Actions
        $user_service->destroy(5);
        $user_service->delete(5);
        $users_by_model = User::all();

        // Assertions
        $this->assertTrue($users_by_model->count() == 9);
        $this->assertTrue(!$users_by_model->contains(5));
    }

    /**
     * @test
     * @return void
     */
    public function it_can_upload_photo()
    {
        // Arrangements
        $avatar = UploadedFile::fake()->image('avatar.png', 100, 100);
        $user_service = app()->make(UserServiceInterface::class);

        // Actions
        $savedphoto = $user_service->upload($avatar);

        // Assertions
        Storage::disk('public')->assertExists($savedphoto);
        Storage::disk('public')->delete($savedphoto);
        Storage::disk('public')->assertMissing($savedphoto);
    }
}
