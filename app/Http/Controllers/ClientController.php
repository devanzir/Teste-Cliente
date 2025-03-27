<?php

namespace App\Http\Controllers;

use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    
    public function index()
    {
        $clients = $this->clientService->getAllPaginated();
        return view('clients.index', compact('clients'));
    }

    
    public function create()
    {
        return view('clients.create');
    }

    
    public function store(Request $request)
    {
        $data = $request->all();
        $this->clientService->createClient($data);
        return redirect()->route('clients.index')->with('success', 'Cliente criado com sucesso!');
    }

    
    public function edit($id)
    {
        $client = $this->clientService->findById($id);

        if (!$client) {
            return redirect()->route('clients.index')->with('error', 'Cliente não encontrado!');
        }

        return view('clients.edit', compact('client'));
    }

    
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $client = $this->clientService->updateClient($data, $id);

        if (!$client) {
            return redirect()->route('clients.index')->with('error', 'Erro ao atualizar o cliente!');
        }

        return redirect()->route('clients.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    
    public function destroy($id)
    {
        $deleted = $this->clientService->deleteClient($id);

        if (!$deleted) {
            return redirect()->route('clients.index')->with('error', 'Cliente não encontrado para exclusão!');
        }

        return redirect()->route('clients.index')->with('success', 'Cliente excluído com sucesso!');
    }
}
