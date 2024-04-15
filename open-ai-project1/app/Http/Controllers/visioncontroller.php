<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use GuzzleHttp\Client;
// use Illuminate\Support\Facades\Session;

// class visioncontroller extends Controller
// {
//     public function index(){
//         return view('users.vision');
//     }

//     public function script(Request $request){
//         $key = Session::get('key');
//         $imageUrl=$request->input('imageUrl');
//         $prompt=$request->input('prompt');

//         $request->validate([
//             'imageUrl' => 'required|starts_with:http,https',
//             'prompt' => 'required',
//         ]);

//         if(!isset($key)){
//             return to_route('vision')->with('success' ,'Enter openai key in the page setting');
//         }

//         else{
//             $client = new Client();
//         $response = $client->post('https://api.openai.com/v1/chat/completions', [
//             'headers' => [
//                 'Authorization' => 'Bearer '.$key,
//                 'Content-Type' => 'application/json',
//             ],
//             'json' => [
//                 'model' => 'gpt-4-vision-preview',
//                 'messages' => [
//                     [
//                         'role' => 'user',
//                         'content' => [
//                             [
//                                 'type' => 'text',
//                                 'text' => $prompt 
//                             ],
//                             [
//                                 'type' => 'image_url',
//                                 'image_url' => $imageUrl
//                             ]
//                         ]
//                     ]
//                 ]
//             ]
//         ]);

//         $body = $response->getBody()->getContents();
//         $responseArray = json_decode($body, true);
//         return redirect()->route('vision')->with(['response' => $responseArray]);
//         }
        
//     }
// }



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Session;

class VisionController extends Controller
{
    public function index(){
        return view('users.vision');
    }

    public function script(Request $request){
        $key = Session::get('key');
        $imageUrl = $request->input('imageUrl');
        $prompt = $request->input('prompt');

        $request->validate([
            'imageUrl' => 'required|url',
            'prompt' => 'required',
        ]);

        if (!isset($key)) {
            return to_route('vision')->with('error', 'Enter OpenAI key in the page setting.');
        }

        try {
            $client = new Client();
            $response = $client->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $key,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'gpt-4-vision-preview',
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => [
                                [
                                    'type' => 'text',
                                    'text' => $prompt 
                                ],
                                [
                                    'type' => 'image_url',
                                    'image_url' => $imageUrl
                                ]
                            ]
                        ]
                    ]
                ]
            ]);

            $body = $response->getBody()->getContents();
            $responseArray = json_decode($body, true);
            return redirect()->route('vision')->with(['response' => $responseArray]);

        } catch (RequestException $e) {
            $errorMessage = 'You exceeded your current quota, please check your plan and billing details.';
            if ($e->hasResponse()) {
                if (str_contains($e->getResponse()->getBody()->getContents(), 'You exceeded your current quota')) {
                    $errorMessage = 'You exceeded your current quota, please check your plan and billing details.';
                }
            }
            return back()->with('error', $errorMessage);
        } catch (\Exception $e) {
            return back()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }
}

