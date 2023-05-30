<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Models\Card;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;



class CardController extends Controller
{    
    public function index()
    {
        $user = Auth::user();
        $cards = $user->cards;

        return response()->json($cards);
    }


    public function store(Request $request)
    {
        try {
            
            $validatedData = $request->validate([
                'titulo' => 'required|string',
                'conteudo' => 'required|string'
            ]);
            
            $token = $request->header('Authorization');
            
            
            if (!$token) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            
            $user = JWTAuth::toUser($token);     
            $validatedData['user_id'] = $user->id; 
    
            $card = Card::create($validatedData);
    
            return response()->json(['card' => array_merge($card->toArray(), ['lista' => 'To Do'])], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
    

    public function show(string $id)
    {
        $user = Auth::user();
        $card = Card::where('id', $id)->where('user_id', $user->id)->first();

        if ($card) {
            return response()->json($card);
        } else {
            return response()->json(['error' => 'Card not found or you are not authorized to view it'], 404);
            }
    }


    public function update(Request $request, $id)
    {    
        try{

            $user = Auth::user();
            $card = Card::where('id', $id)->where('user_id', $user->id)->first();
    
            if ($card) {
                $validatedData = $request->validate([
                    'titulo' => 'required|string',
                    'conteudo' => 'required|string',
                    'lista' => 'required|in:To Do,Doing,Done',
                ]);
            
                $card->update($validatedData);
                $cardUpdated = Card::findOrFail($id);
            
                return response()->json($cardUpdated);
            } else {
                return response()->json(['error' => 'Card not found or you are not authorized to update it'], 404);
            }

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }     
        
    }



    public function destroy($id)
    {
        $user = Auth::user();
        $card = Card::where('id', $id)->where('user_id', $user->id)->first();

        if ($card) {
            $card->delete();
            return response()->json(['message' => 'Card deleted successfully']);
        } else {
            return response()->json(['error' => 'Card not found or you are not authorized to delete it'], 404);
            }
    }

}
