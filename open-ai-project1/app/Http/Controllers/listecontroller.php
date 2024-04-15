<?php



namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\utilisateur;
use Carbon\Carbon;

class listecontroller extends Controller
{
    public function index(Request $request){
        $searchQuery = $request->input('search', null);

        if ($searchQuery) {
            $users = utilisateur::where('name', 'LIKE', "%{$searchQuery}%")
                ->paginate(9);
        } else {
            $users = utilisateur::paginate(9);
        }

        return view('admin.liste', compact('users'));
    }

    public function delete(utilisateur $utilisateur){
        $utilisateur->delete();
        return to_route('liste')->with('success','User has been deleted');
    }

}

