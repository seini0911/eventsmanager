<?php

namespace App\Repositories\Api;

use App\Models\Event;

interface EventRepositoryInterface
{
    public function all();//retrieve all events

    public function getUserEvents($userId);
    public function create(array $data);
    public function find($id);//retrieve a specific event
    public function update(Event $event, array $data); //update an event
    public function delete(Event $event);//delete an event
}
