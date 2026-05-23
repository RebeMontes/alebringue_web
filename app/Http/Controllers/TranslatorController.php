<?php
// app/Http/Controllers/TranslatorController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslatorController extends Controller
{
    /**
     * Muestra la vista del traductor
     */
    public function index()
    {
        return view('translator.index');
    }

    /**
     * Traduce texto de Inglés a Español o viceversa
     */
    public function translate(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:500',
            'direction' => 'required|in:en_to_es,es_to_en'
        ]);

        try {
            $translator = new GoogleTranslate();
            
            // Configurar dirección de traducción
            if ($request->direction == 'en_to_es') {
                $translator->setTarget('es'); // Inglés → Español
                $sourceLang = 'en';
                $targetLang = 'es';
            } else {
                $translator->setTarget('en'); // Español → Inglés
                $sourceLang = 'es';
                $targetLang = 'en';
            }
            
            $translated = $translator->translate($request->text);
            
            return response()->json([
                'success' => true,
                'original' => $request->text,
                'translated' => $translated,
                'source' => $sourceLang,
                'target' => $targetLang
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al traducir. Intenta de nuevo.'
            ], 500);
        }
    }
}