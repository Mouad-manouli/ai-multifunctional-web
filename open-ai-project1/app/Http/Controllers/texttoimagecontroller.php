<?php
// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use GuzzleHttp\Client;
// use Illuminate\Support\Facades\Session;

// class texttoimagecontroller extends Controller
// {

//     public function index(){
//         return view('users.text-to-image');

//     }


//     public function image(request $request){
//         $key = Session::get('key');
//         $size= $request->input('size');
//         $text = $request->input('description');

//         $request->validate([
//             'description' => 'required',
//         ]);

//         if(!isset($key)){
//             return to_route('text-to-image')->with('success' ,'Enter openai key in the page setting');
//         }
//         else{
//                     $client = new Client();
//                 $response = $client->post('https://api.openai.com/v1/images/generations', [
//                 'headers' => [
//                     'Authorization' => 'Bearer ' .$key,
//                     'Content-Type' => 'application/json',
//                 ],
//                 'json' => [
//                     'prompt' => $text,
//                     'n' => 1,
//                     'size' => $size,
//                 ],
//             ]);

//             $result = json_decode($response->getBody(), true);
            
//             // Vérifiez si $result contient l'URL de l'image
//             if (isset($result['data'][0]['url'])) {
//                 $imageUrl = $result['data'][0]['url'];

//                 // Téléchargez et stockez l'image localement (par exemple dans le dossier public)
//                 $imageContents = file_get_contents($imageUrl);
//                 file_put_contents(storage_path('app/public/Photo/image.jpg'), $imageContents);
//             }

//             return view('users.afficher_img',compact('text'));
//         }

        
    
//     }
// }

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Session;

class TextToImageController extends Controller
{
    public function index(){
        return view('users.text-to-image');
    }

    public function image(Request $request){
        $key = Session::get('key');
        $size = $request->input('size');
        $text = $request->input('description');

        $request->validate([
            'description' => 'required',
        ]);

        if(!isset($key)){
            return to_route('text-to-image')->with('error', 'Enter OpenAI key in the page setting.');
        }
        else{
            try {
                $client = new Client();
                $response = $client->post('https://api.openai.com/v1/images/generations', [
                    'headers' => [
                        'Authorization' => 'Bearer ' .$key,
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        'prompt' => $text,
                        'n' => 1,
                        'size' => $size,
                    ],
                ]);

                $result = json_decode($response->getBody(), true);
                
                if (isset($result['data'][0]['url'])) {
                    $imageUrl = $result['data'][0]['url'];

                    // Téléchargez et stockez l'image localement
                    $imageContents = file_get_contents($imageUrl);
                    $imagePath = 'public/Photo/image.jpg';
                    file_put_contents(storage_path('app/'.$imagePath), $imageContents);

                    // Vous pouvez ajuster le chemin pour être utilisé dans la vue
                    $imageUrl = asset('storage/Photo/image.jpg');
                } else {
                    throw new \Exception("Failed to generate image.");
                }

                return view('users.afficher_img', compact('text', 'imageUrl'));

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
}