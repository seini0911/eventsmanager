<?php

namespace App\Repositories\Api;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function all() {
        return User::all();
    }
    public function create(array $data) {
        return User::create($data);
    }
    public function delete($id) {
        $user = User::findOrFail($id);
        $user->delete();
    }
    public function find($id) {
        return User::findOrFail($id);
    }
    public function update(array $data, $id) {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }
}