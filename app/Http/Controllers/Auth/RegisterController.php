<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); 
    }

    public function register(Request $request)
    {
        Log::info('Método register chamado');
        Log::info('Dados recebidos: ', $request->all());

        
    
        $validator = Validator::make($request->all(), [
            
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        if ($validator->fails()) {
            Log::info('Validação falhou: ', $validator->errors()->all());
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }
    
        $cpf = $request->cpf;
    
        Log::info('CPF recebido: ', [$cpf]);
    
        try {
            $newUser = User::create([
                'name' => $request->name,
                'cpf' => $cpf,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'status' => 'in_progress',
            ]);

           
        session(['dados_pessoais' => [
            'id' => $newUser->id,
            'name' => $newUser->name,
            'cpf' => $newUser->cpf,
            'email' => $newUser->email,
        ]]);
    
            Log::info('Usuário criado: ', $newUser->toArray());
            return redirect()->route('wizard.step2');
        } catch (\Exception $e) {
            Log::error('Erro ao criar usuário: ' . $e->getMessage());
            return redirect()->route('register')->withErrors(['message' => 'Erro ao criar usuário.'])->withInput();
        }
    }
 

    public function step2()
    {
       
        if (!session()->has('dados_pessoais')) {
            return redirect()->route('register')->withErrors(['error' => 'Dados não encontrados na sessão.']);
        }

        return view('wizard.step2'); 
    }

    public function submit()
    {
        
        if (!session()->has('dados_pessoais')) {
            return redirect()->route('register')->withErrors(['error' => 'Dados não encontrados na sessão.']);
        }

        $dados = session('dados_pessoais');

        
        $user = User::where('cpf', $dados['cpf'])->first(); 

        if ($user) {
            $user->update(['status' => 'completed']);
        } else {
            return redirect()->route('register')->withErrors(['error' => 'Usuário não encontrado.']);
        }

       
        session()->forget('dados_pessoais');

        return redirect()->route('success')->with('success', 'Cadastro finalizado com sucesso! Você pode fazer login.');
    }
}