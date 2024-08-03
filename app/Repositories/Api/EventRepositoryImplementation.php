<?php

namespace App\Repositories\Api;
use App\Repositories\Api\EventRepositoryInterface;
use App\Models\Event;

class EventRepositoryImplementation implements EventRepositoryInterface{

    /**
     * Get all events
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all() {
        return Event::all();
    }

    /**
     * Delete an event
     * @param \App\Models\Event $event
     * @return bool
     */
    public function delete(Event $event) {
        $event->delete();
        return true;
    }

    /**
     * Find an event by its id
     * @param mixed $id
     * @return \App\Models\Event|\Illuminate\Database\Eloquent\Collection
     */
    public function find($id) {
        return Event::findOrFail( $id );
    }

    /**
     *
     * Update an event
     * @param \App\Models\Event $event
     * @param array $data
     * @return Event
     */
    public function update(Event $event, array $data) {
        $event->update($data);
        return $event;
    }

    /**
     *
     * Create a new event
     * @param array $data
     * @return \App\Models\Event
     */
    public function create(array $data) {
        return Event::create($data);
    }
    /**
     * Summary of getUserEvents
     * @param mixed $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserEvents($userId) {
        return Event::where("user_id", $userId)->get();
    }
}
