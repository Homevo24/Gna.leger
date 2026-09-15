<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // À activer uniquement si l'hébergement place l'app derrière un reverse
        // proxy / load balancer qui termine le HTTPS (ex. certains PaaS avec
        // proxy interne). Sans ça, Laravel peut croire que la requête est en
        // HTTP et générer des liens/redirections en http:// au lieu de https://.
        // Si l'hébergeur expose PHP directement (pas de proxy connu), laisser
        // commenté. '*' fait confiance à tous les proxys : à restreindre à
        // l'IP du proxy si elle est fixe et connue.
        // $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
