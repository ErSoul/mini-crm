<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => session('lang') === 'es' ? 'Usuario o contraseña incorrecto.' : 'These credentials do not match our records.', 
    'password' => session('lang') === 'es' ? 'La contraseña proporcionada es incorrecta' : 'The provided password is incorrect.',
    'throttle' => session('lang') === 'es' ? 'Demasiados intentos de inicio de sesión. Vuelva a intentarlo en :segundos segundos.' : 'Too many login attempts. Please try again in :seconds seconds.'

];
