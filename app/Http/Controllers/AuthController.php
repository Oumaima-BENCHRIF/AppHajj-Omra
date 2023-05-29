<?php

namespace App\Http\Controllers;
use Dotenv\Dotenv;
use App\Http\Request\LoginRequest;
use App\Http\Controllers\Controller;
use App\UserApp;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginView()
    {
        return view('login.main', [
            'layout' => 'login'
        ]);
    }

    /**
     * Authenticate login user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  
public function login(LoginRequest $request)
{
    if (Auth::attempt([
        'email' => $request->email,
        'password' => $request->password
    ])) {
       
        $user = Auth::user();
        $databaseName = $user->baseName; // Replace with your logic to determine the new database name
        $envPath = base_path('.env');
        $envContent = file_get_contents($envPath);
        $updatedEnvContent = preg_replace(
            '/PORTAL_DB_DATABASE=.*$/m',
            'PORTAL_DB_DATABASE='.$databaseName,
            $envContent
        );
        file_put_contents($envPath, $updatedEnvContent);

        // Redirect or perform additional actions
    } else {
        // Authentication failed
        // throw new \Exception('Wrong email or password.');
    }
}

    /**
     * Logout user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
