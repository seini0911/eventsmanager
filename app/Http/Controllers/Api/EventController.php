<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Api\EventRepositoryInterface;
use App\Exceptions\Api\ApiExceptions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SavingNewEventRequest;
use App\Http\Requests\Api\UpdateEventRequest;
use App\Responses\Api\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    protected $eventRepository;
    public function __construct(EventRepositoryInterface $eventRepository){
        $this->eventRepository = $eventRepository;
    }

    public function getUserEvents(Request $request){
        try{
            $userId = Auth::id();
            $events = $this->eventRepository->getUserEvents($userId);
            return ApiResponse::success($events);
        }catch(Exception $e){
            return ApiExceptions::handle($e);
        }
    }
    public function index(){
        try{
            $events = $this->eventRepository->all();
            return ApiResponse::success($events);
        }catch(Exception $e){
            return ApiExceptions::handle($e);
        }
    }
    public function store(SavingNewEventRequest $request){
        try{
            Log::info($request->all());
            $request->validated();
            $data = [
                ...$request->all(),
                'user_id' => Auth::id(),
            ];
            $event = $this->eventRepository->create($data);
            return ApiResponse::success($event, "Event created successfully", 201);
        }catch(Exception $e){
            return ApiExceptions::handle($e);
        }
    }
    public function show($id){
        try{
            $event = $this->eventRepository->find($id);
            return ApiResponse::success($event);
        }catch(Exception $e){
            return ApiExceptions::handle($e);
        }
    }
    public function update(UpdateEventRequest $request, $id){
        try{
            $event = $this->eventRepository->find($id);
            $this->eventRepository->update($event, $request->validated());
            return ApiResponse::success($event, 'Event updated successfully');
        }catch(Exception $e){
            return ApiExceptions::handle($e);
        }
    }
    public function destroy($id){
        try{
            $event = $this->eventRepository->find($id);
            $event->eventRepository->delete($event);
            return ApiResponse::success(null,'Event deleted successfully', 204);
        }catch(Exception $e){
            return ApiExceptions::handle($e);
        }
    }

    public function rsvp(){
        return ;
    }
}
