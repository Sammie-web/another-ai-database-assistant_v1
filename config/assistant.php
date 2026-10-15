<?php

return [
    'provider' => env('ASSISTANT_PROVIDER', 'openai'),
    'gemini_key' => env('GEMINI_API_KEY'),
    'gemini_model' => env('GEMINI_MODEL', 'gemini-3.1-flash-lite'),
    'key' => env('OPENAI_API_KEY'),
    'model' => env('OPENAI_MODEL', 'gpt-5.4-mini'),
    'connection' => env('ASSISTANT_DB_CONNECTION', 'sqlite'),
    'middleware' => ['web', 'auth'],
    'resources' => [
        'projects' => [
            'table' => 'projects',
            'columns' => ['id', 'name', 'status'],
            'rules' => [
                'name' => 'required|string|max:120',
                'status' => 'required|in:planned,active,completed',
            ],
        ],
    ],
];
