<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\ThreadResource;


class ThreadController extends Controller
{
    public function thread(Request $request){
        //validate request body
        $request->validate([
            'title'=>['required'],
            'post'=>['required'],
            
        ]);
        //create a blog thread
        $newThread = Thread::create([
            'user_id'=> auth()->id(),
            'title'=> $request->title,
            'posts'=> $request->posts,
           
            
        ]);
        
        //return cuccess response

        return response()->json([
            'success'=> true,
            'message'=>'successfully created a post',
            'data' => new ThreadResource($newThread),
        ]);
    }
    public function updateThread(Request $request, $threadId){
        $request->validate([
            'title'=>['required'],
            'posts'=>['required'],

        ]);
        
        $thread = Thread::find($threadId);
        if(!$thread) {
            return response() ->json([
                'success' => false,
                'message' => 'thread not found'
            ]);

        $this->authorize('update',$thread);

        }

        $thread->title = $request->title;
        $thread->post = $request->post;
        $thread->save();
        return response() ->json([
            'success' => true,
            'message' => 'thread updated'
        ]);
    }
    public function deleteThread( $threadId){

        $thread = Thread::find($threadId);
        if(!$thread) {
            return response() ->json([
                'success' => false,
                'message' => 'thread not found'
            ]);
        }

        
        $this->authorize('delete',$thread);

        //delete property
        $thread-> delete();

        return response() ->json([
            'success' => true,
            'message' => 'thread deleted'
            ]); 
    }
    public function getThread(Request $request, $threadId){
        $thread = Thread::find($threadId);
        if(!$thread) {
            return response() ->json([
                'success' => false,
                'message' => 'thread not found'
            ]);
        }

        return response() ->json([
            'success'=> true,
            'message'  => 'thread found',
            'data'   => [
                'thread'=> new ThreadResource($thread),
                
            ]
        ]);
    }
}
