<?php



// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use GuzzleHttp\Client;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Session;
// use Symfony\Component\Process\Process;

// class speachtotextcontroller extends Controller
// {

//     public function index(){
//          return view('users.speach-to-text');
//     }

//     public function text(Request $request){
//         $testaudio = $request->file('audio');
//         $key = Session::get('key');
        
//         $request->validate([
//             'audio' => 'required|mimes:flac,m4a,mp3,mp4,mpeg,mpga',
//         ]);

//         if(!isset($key)){
//             return to_route('speech-to-text')->with('success' ,'Enter openai key in the page setting');
//         }
//         else{
//             $filePath = $request->file('audio')->store('temp'); 
//             $fileContent = file_get_contents(storage_path('app/'.$filePath));
//             $client = new Client();
//             $response = $client->post('https://api.openai.com/v1/audio/transcriptions', [
//                 'headers' => [
//                     'Authorization' => 'Bearer '.$key,
//                 ],
//                 'multipart' => [
//                     [
//                         'name' => 'file',
//                         'contents' => $fileContent,
//                         'filename' => 'speech.mp3', 
//                     ],
//                     [
//                         'name' => 'response_format',
//                         'contents' => 'text',
//                     ],
//                     [
//                         'name' => 'model',
//                         'contents' => 'whisper-1',
//                     ],
//                 ],
//             ]);

//             if (isset($response) && !empty($response)) {
//                 $result = $response->getBody()->getContents();
//                 Storage::delete($filePath);
//                 return to_route('speech-to-text')->with('result',$result);
//             } else {
//                 return view('users.speach-to-text');
//             }
//         }
//     }
// }

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class speachtotextcontroller extends Controller
{
    public function index(){
        return view('users.speach-to-text');
    }

    public function text(Request $request){
        $testaudio = $request->file('audio');
        $key = Session::get('key');
        
        $request->validate([
            'audio' => 'required|mimes:flac,m4a,mp3,mp4,mpeg,mpga',
        ]);

        if(!isset($key)){
            return to_route('speech-to-text')->with('error', 'Enter OpenAI key in the page setting.');
        }

        $filePath = $request->file('audio')->store('temp'); 
        $fileContent = file_get_contents(storage_path('app/'.$filePath));
        $client = new Client();

        try {
            $response = $client->post('https://api.openai.com/v1/audio/transcriptions', [
                'headers' => [
                    'Authorization' => 'Bearer '.$key,
                ],
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => $fileContent,
                        'filename' => $testaudio->getClientOriginalName(), 
                    ],
                    [
                        'name' => 'response_format',
                        'contents' => 'text',
                    ],
                    [
                        'name' => 'model',
                        'contents' => 'whisper-1',
                    ],
                ],
            ]);

            $result = $response->getBody()->getContents();
            Storage::delete($filePath);
            return to_route('speech-to-text')->with('result', $result);

        } catch (RequestException $e) {
            Storage::delete($filePath); // Assurez-vous de supprimer le fichier temporaire même en cas d'erreur
            $errorMessage = 'An error occurred while processing your request.';
            if ($e->hasResponse()) {
                if (str_contains($e->getResponse()->getBody()->getContents(), 'You exceeded your current quota')) {
                    $errorMessage = 'You exceeded your current quota, please check your plan and billing details.';
                }
            }
            return back()->with('error', $errorMessage);
        } catch (\Exception $e) {
            Storage::delete($filePath); // Assurez-vous de supprimer le fichier temporaire même en cas d'erreur
            return back()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }
}
