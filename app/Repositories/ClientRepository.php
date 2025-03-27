<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository
{
    
    public function getAllPaginated($perPage = 10)
    {
        return Client::paginate($perPage);
    }

    public function create(array $data)
    {
        return Client::create($data);
    }

   
    public function update(Client $client, array $data)
    {
        return $client->update($data);
    }


    public function delete(Client $client)
    {
        return $client->delete();
    }

    
    public function findById($id)
    {
        return Client::find($id); 
    }
}
