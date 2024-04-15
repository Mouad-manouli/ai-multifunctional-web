<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use GuzzleHttp\Client;
// use Illuminate\Support\Facades\Session;

// class TextToSpeechController extends Controller
// {
//     public function index()
//     {
//         return view('users.text-to-speach');
//     }

//     public function audio(request $request){
//         $key = Session::get('key');
//         $voice=$request->input('voice');
//         $quality=$request->input('quality');
//         $text=$request->input('audio');

//         $request->validate([
//             'audio'=> 'required'
//         ]);

//         if(!isset($key)){
//             return to_route('text-to-speech')->with('success' ,'Enter openai key in the page setting');
//         }
//         else{
//             $client = new Client();
//             $response = $client->post('https://api.openai.com/v1/audio/speech', [
//                 'headers' => [
//                     'Authorization' => 'Bearer '.$key,
//                     'Content-Type' => 'application/json',
//                 ],
//                 'json' => [
//                     "input" => $text,
//                     "voice" => $voice,
//                     "model" => $quality 
//                 ],
//             ]);

            

//             if(isset($response) && !empty($response)){
//                 $result = $response->getBody()->getContents();
//                 $audioPath = storage_path('app/public/audio/speech.mp3');
//                 file_put_contents($audioPath, $result);
//                 return to_route('text-to-speech')->with('text',$text); 
//             }
//             else{
//                 return view('users.text-to-speach');
//             }   
//         }
//     }
// }

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Session;

class TextToSpeechController extends Controller
{
    public function index()
    {
        return view('users.text-to-speach'); // Assurez-vous que le nom de la vue est correct
    }

    public function audio(Request $request){
        $key = Session::get('key');
        $voice = $request->input('voice');
        $quality = $request->input('quality');
        $text = $request->input('audio');

        $request->validate([
            'audio'=> 'required'
        ]);

        if(!isset($key)){
            return to_route('text-to-speech')->with('error', 'Enter OpenAI key in the page setting.');
        }

        $client = new Client();
        try {
            $response = $client->post('https://api.openai.com/v1/audio/speech', [
                'headers' => [
                    'Authorization' => 'Bearer '.$key,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    "input" => $text,
                    "voice" => $voice,
                    "model" => $quality 
                ],
            ]);

            $result = $response->getBody()->getContents();
            $audioPath = storage_path('app/public/audio/speech.mp3');
            file_put_contents($audioPath, $result);

            return to_route('text-to-speech')->with('text',$text);

        } catch (RequestException $e) {
            $errorMessage = 'An error occurred while processing your request.';
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


