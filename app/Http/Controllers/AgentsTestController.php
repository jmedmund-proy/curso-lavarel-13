<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Ai\Enums\Lab;

use function Laravel\Ai\agent;

class AgentsTestController extends Controller
{
    public function chat(Request $request): JsonResponse {
        $mensaje = $request->input('mensaje', 'Hola, dime qué sabes sobre Laravel');

        $response = agent(
            instructions: 'Eres un asistente útil y conciso',
        )->prompt(
            $mensaje,
            provider: Lab::Gemini,
        );

        return response()->json($response);
    }


}
