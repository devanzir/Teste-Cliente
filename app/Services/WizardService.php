<?php

namespace App\Services;

use App\Repositories\WizardRepository;
use Illuminate\Http\Request;

class WizardService
{
    protected $wizardRepository;

    public function __construct(WizardRepository $wizardRepository)
    {
        $this->wizardRepository = $wizardRepository;
    }



    public function handleStep2(Request $request)
    {


        $request->validate([
            'cep' => 'required',
            'rua' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
        ]);

        session(['endereco' => $request->only('cep', 'rua', 'cidade', 'estado')]);

        return redirect()->route('wizard.confirm');
    }


    public function confirm()
    {
        $dados = session('dados_pessoais');
        $endereco = session('endereco');


        if (!$dados || !$endereco) {
            return redirect()->route('register')->withErrors(['message' => 'Dados não encontrados.']);
        }

        return ['dados' => $dados, 'endereco' => $endereco];
    }

    public function completeRegistration()

    {
        $user = session('dados_pessoais');


        if (!$user || !isset($user['id'])) {
            return redirect()->route('register')->withErrors(['message' => 'Dados do usuário não encontrados.']);
        }

        $this->wizardRepository->updateUserStatus($user['id'], 'completed');
        
        
        session()->forget('dados_pessoais');

        
        session()->forget('endereco');

        return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso! Você pode fazer login agora.');
    }
}