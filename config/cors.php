<?php

return [
    /*
     * You can enable CORS for all origins by setting the origin key to `*`.
     * This can be overridden by a more specific origin rule in a `hosts` config.
     */
    'paths' => ['api/*', 'sanctum/csrf-cookie'], // Aplica o CORS a todas as rotas da API e ao cookie do Sanctum
    'allowed_methods' => ['*'], // Permite todos os métodos (GET, POST, PUT, DELETE, etc.)
    'allowed_origins' => ['http://localhost:5173', 'http://127.0.0.1:5173'], // **ADICIONE A PORTA DO SEU FRONTEND AQUI**
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // Permite todos os cabeçalhos
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false, // Defina como 'true' se estiver usando cookies/sessões (ex: Laravel Sanctum com SPAs)

];
