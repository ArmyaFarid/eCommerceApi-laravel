<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use function Illuminate\Events\queueable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::all();

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if(!$request->has('img')){
           $request->merge(['img' => 'https://via.placeholder.com/200x200.png/0011ee?text=people+et']);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'username' => 'required|unique:users|max:255',
            'img' => 'url', // Assuming 'img' should be a valid URL
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();

        $validated['img'] = $request->has('img') ? $validated['img'] : 'https://via.placeholder.com/200x200.png/0011ee?text=people+et';


        $validated = $validator->safe()->only(['name', 'email','username','password','img']);


        $user = User::create($validated);

        $user->save();

        // Store the blog post...

        return response()->json(['message' => 'USER created successfully'], 201);

    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        // Throw a custom ValidationException for API responses
        throw new ValidationException($validator, response()->json($validator->errors(), 422));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            $user = User::with('commandes')->find($id);
            return response()->json($user);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found.'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
