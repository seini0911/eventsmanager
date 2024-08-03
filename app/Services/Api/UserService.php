<?php

namespace App\Api\Service;

use App\Repositories\Api\UserRepositoryInterface;

class UserService{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository){
        $this->userRepository = $userRepository;
    }
    public function all(){
        return $this->userRepository->all();
    }
    public function create(array $data){
        return $this->userRepository->create($data);
    }
    public function update(array $data, $id){
        return $this->userRepository->update($data, $id);
    }
    public function delete(int $id){
        $this->userRepository->delete($id);
    }
}
