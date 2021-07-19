<?php

namespace App\Services;

use App\Events\UserSaved;
use App\Models\Detail;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserService implements UserServiceInterface
{
    /**
     * The model instance.
     *
     * @var App\Models\User
     */
    protected $model;

    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Constructor to bind model to a repository.
     *
     * @param \App\Models\User          $model
     * @param \Illuminate\Http\Request  $request
     */
    public function __construct(User $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    /**
     * Define the validation rules for the model.
     *
     * @param  int $id
     * @return array
     */
    public function rules($id = null)
    {
        $rules = [
            'prefixname'    => 'nullable|in:Mr,Mrs,Ms',
            'firstname'     => 'required|string',
            'middlename'    => 'nullable|string',
            'lastname'      => 'required|string',
            'suffixname'    => 'nullable|string',
            'username'      => 'required|string|unique:App\Models\User',
            'email'         => 'required|email|unique:App\Models\User',
            'password'      => 'required|confirmed|min:8',
            'photo'         => 'nullable|image',
            'type'          => 'nullable|string',
        ];
        if ($id) {
            $rules['username']  = ['required', 'string', Rule::unique('users')->ignore($id)];
            $rules['email']     = ['required', 'email', Rule::unique('users')->ignore($id)];
            unset($rules['password']);
        }

        return $rules;
    }

    /**
     * Retrieve all resources and paginate.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function list()
    {
        return User::paginate();
    }

    /**
     * Create model resource.
     *
     * @param  array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $attributes)
    {
        if (array_key_exists('photo', $attributes) && $attributes['photo'] instanceof UploadedFile)
            $attributes['photo'] = $this->upload($attributes['photo']);
        else
            $attributes['photo'] = null;
        $attributes['password'] = bcrypt($attributes['password']);
        if ($attributes['type'] === null)
            unset($attributes['type']);

        return User::create($attributes);
    }

    /**
     * Retrieve model resource details.
     * Abort to 404 if not found.
     *
     * @param  integer $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $id): ?Model
    {
        return User::findOrFail($id);
    }

    /**
     * Update model resource.
     *
     * @param  integer $id
     * @param  array   $attributes
     * @return boolean
     */
    public function update(int $id, array $attributes): bool
    {
        if (array_key_exists('photo', $attributes) && $attributes['photo'] instanceof UploadedFile)
            $new_attributes['photo'] = $this->upload($attributes['photo']);
        else
            $new_attributes['photo'] = null;

        return $this->find($id)->update($new_attributes);
    }

    /**
     * Soft delete model resource.
     *
     * @param  integer|array $id
     * @return void
     */
    public function destroy($id)
    {
        $this->find($id)->delete();
    }

    /**
     * Include only soft deleted records in the results.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function listTrashed()
    {
        return User::onlyTrashed()->paginate();
    }

    /**
     * Restore model resource.
     *
     * @param  integer|array $id
     * @return void
     */
    public function restore($id)
    {
        User::onlyTrashed()->findOrFail($id)->restore();
    }

    /**
     * Permanently delete model resource.
     *
     * @param  integer|array $id
     * @return void
     */
    public function delete($id)
    {
        User::onlyTrashed()->findOrFail($id)->forceDelete();
    }

    /**
     * Generate random hash key.
     *
     * @param  string $key
     * @return string
     */
    public function hash(string $key): string
    {
        return bcrypt($key);
    }

    /**
     * Upload the given file.
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @return string|null
     */
    public function upload(UploadedFile $file)
    {
        return $file->storeAs('images', Str::random() . "." . $file->extension(), 'public');
    }

    /**
     * Handle user saved event
     */
    public function handle(UserSaved $event)
    {
        $gender = collect(['Mr' => 'Male', 'Ms' => 'Female', 'Mrs' => 'Female']);
        $user = $event->user;
        $user->details()->createMany([
            [
                'key'    => 'Full name',
                'value'  => $user->fullname,
                'type'   => 'bio',
            ],
            [
                'key'    => 'Middle Initial',
                'value'  => $user->middleinitial,
                'type'   => 'bio',
            ],
            [
                'key'    => 'Avatar',
                'value'  => $user->avatar,
                'type'   => 'bio',
            ],
            [
                'key'    => 'Gender',
                'value'  => $gender->get($user->prefixname),
                'type'   => 'bio',
            ]
        ]);
    }
}
