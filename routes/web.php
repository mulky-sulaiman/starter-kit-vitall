<?php

$app_engine = env('APP_ENGINE', 'inertia');

switch ($app_engine) {
    case ('inertia'):
    default:
        require __DIR__ . '/inertia.php';
        break;
    case ('livewire'):
        require __DIR__ . '/livewire.php';
        break;
}
