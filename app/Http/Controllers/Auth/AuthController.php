<? php

aplicación de espacio de nombres \ Http \ Controllers \ Auth;

use App \ User;
usar Validator;
use App \ Http \ Controllers \ Controller;
use Illuminate \ Foundation \ Auth \ ThrottlesLogins;
use Illuminate \ Foundation \ Auth \ AuthenticatesAndRegistersUsers;

clase AuthController extiende controlador
{
    / *
    | ------------------------------------------------- -------------------------
    El | Controlador de registro e inicio de sesión
    | ------------------------------------------------- -------------------------
    El |
    El | Este controlador maneja el registro de nuevos usuarios, así como el
    El | autenticación de usuarios existentes. Por defecto, este controlador usa
    El | Un rasgo simple para agregar estos comportamientos. ¿Por qué no lo exploras?
    El |
    * /

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    / **
     * Dónde redirigir a los usuarios después de iniciar sesión / registrarse.
     * *
     * @var cadena
     * /
    protegido $ redirectTo = '/restaurante/articulo';

    / **
     * Crear una nueva instancia de controlador de autenticación.
     * *
     * @return void
     * /
    función pública __construct ()
    {
        $ this-> middleware ($ this-> guestMiddleware (), ['excepto' => 'cerrar sesión']);
    }

    / **
     * Obtenga un validador para una solicitud de registro entrante.
     * *
     * @param array $ data
     * @return \ Illuminate \ Contracts \ Validation \ Validator
     * /
    validador de funciones protegidas (array $ data)
    {
        return Validator :: make ($ datos, [
            'name' => 'requerido | max: 255',
            'email' => 'requerido | email | max: 255 | único: usuarios',
            'contraseña' => 'requerido | min: 6 | confirmado',
        ]);
    }

    / **
     * Crear una nueva instancia de usuario después de un registro válido.
     * *
     * @param array $ data
     * @return User
     * /
    función protegida create (array $ data)
    {
        usuario devuelto :: create ([
            'name' => $ data ['name'],
            'email' => $ data ['email'],
            'contraseña' => bcrypt ($ data ['contraseña']),
        ]);
    }
}