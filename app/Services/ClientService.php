<?php

namespace App\Services;

use App\Repositories\ClientRepository;
use Illuminate\Support\Facades\Validator;

class ClientService

{
    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    
    public function getAllPaginated()
    {

        return $this->clientRepository->getAllPaginated();
    }

    
    public function createClient(array $data)
    {

        
        $validatedData = Validator::make($data, [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:clients',
            'cpf' => 'required|string|max:14|unique:clients',
            'contract_attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048',
        ])->validate();


        return $this->clientRepository->create($validatedData);
    }

    
    public function updateClient(array $data, $id)
    {
        $client = $this->clientRepository->findById($id);

        if (!$client) {
            return null; 
        }

        
        $validatedData = Validator::make($data, [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:clients,email,' . $id,
            'cpf' => 'required|string|max:14|unique:clients,cpf,' . $id,
            'contract_attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048',
        ])->validate();



        $this->clientRepository->update($client, $validatedData);

        return $this->clientRepository->findById($id); 
    }


   
    public function deleteClient($id)
    {
        $client = $this->clientRepository->findById($id);

        if (!$client) {
            return null;
        
        }


        return $this->clientRepository->delete($client);
    }

    
    public function findById($id)


    {
        return $this->clientRepository->findById($id);
    }
}
