<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{
    public function index(){
        $conversations = Session::get('conversations', collect());
        return view('users.chat', ['conversations' => $conversations]);
    }

    // public function chat(Request $request){
    //     $key = Session::get('key');
    //     $text = $request->input('message');
        
    //     $request->validate([
    //         'message'=> 'required'
    //     ]);
    //     try{
    //         if(!isset($key)){
    //         return to_route('chat')->with('success' ,'Enter openai key in the page setting');
    //     }
    //     else{
    //         $yourApiKey = $key;
    //         $client = \OpenAI::client($yourApiKey);

    //         $result = $client->chat()->create([
    //             'model' => 'gpt-3.5-turbo',
    //             'messages' => [
    //                 [
    //                     'role' => 'system',
    //                     'content' => $text
    //                 ]
    //             ]
    //         ]);
    //         if (isset($result['choices']) && !empty($result['choices'])) {
    //             $resultt = $result['choices'][0]['message']['content'];
    //             $conversations = Session::get('conversations', collect());

    //             $conversations->push(['question' => $text, 'response' => $resultt]);

    //             Session::put('conversations', $conversations);
    //             return to_route('chat'); 
    //         } else {
    //             echo "No response received from the AI model.";
                
    //             return view('users.chat', ['conversations' => $conversations]);
    //         }
            
    //     }
    //     }
    //     catch(PDOException $e){
    //         echo " Exceeded API quota. Please check your plan and billing details. ".$e->getMessage();
            
    //     }
        
    // }

    public function chat(Request $request){
        $key = Session::get('key');
        $text = $request->input('message');
        
        $request->validate([
            'message'=> 'required'
        ]);
        
        if(!isset($key)){
            return to_route('chat')->with('error', 'Enter OpenAI key in the page setting.');
        }
    
        try {
            $yourApiKey = $key;
            $client = \OpenAI::client($yourApiKey);
    
            $result = $client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => $text
                    ]
                ]
            ]);
    
            if (isset($result['choices']) && !empty($result['choices'])) {
                $resultText = $result['choices'][0]['message']['content'];
                $conversations = Session::get('conversations', collect());
    
                $conversations->push(['question' => $text, 'response' => $resultText]);
    
                Session::put('conversations', $conversations);
                return to_route('chat'); 
            } else {
                return back()->with('error', 'No response received from the AI model.');
            }
        } catch (\Illuminate\Http\Client\RequestException $e) {
            // This can be customized based on how OpenAI's API errors are structured
            return back()->with('error', 'There was a problem with the request: ' . $e->getMessage());
        } catch (\Exception $e) {
            // General exception as a fallback
            if (str_contains($e->getMessage(), 'You exceeded your current quota')) {
                return back()->with('error', 'You exceeded your current quota, please check your plan and billing details.');
            }
            return back()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }

    public function clearSession(){
        Session::forget('conversations');
        return redirect()->route('chat'); 
    }
}

