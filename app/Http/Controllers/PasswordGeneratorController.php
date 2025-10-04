<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PasswordGenerator;

class PasswordGeneratorController extends Controller
{
    public function index()
    {
        return view('password-generator');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'min_length' => 'required|integer|min:4|max:50',
            'include_lowercase' => 'boolean',
            'include_uppercase' => 'boolean',
            'include_numbers' => 'boolean',
            'include_symbols' => 'boolean',
        ]);

        try {
            $generator = new PasswordGenerator();
            
            $password = $generator
                ->withLowercase($request->boolean('include_lowercase'))
                ->withUppercase($request->boolean('include_uppercase'))
                ->withNumbers($request->boolean('include_numbers'))
                ->withSymbols($request->boolean('include_symbols'))
                ->minLength($request->input('min_length', 8))
                ->generate();

            return response()->json([
                'success' => true,
                'password' => $password
            ]);
        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
