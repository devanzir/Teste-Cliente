<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientServiceTest extends TestCase
{
    use RefreshDatabase; 

    /**
     * 
     *
     * @return void
     */
    public function test_create_client()
    {
        
        $data = [
            'name' => 'Teste Client',
            'phone' => '987654321',
            'email' => 'testclient@example.com',
            'cpf' => '98765432100',
            'contract_attachment' => null, 
        ];

       
        $clientService = app(ClientService::class);

       
        $client = $clientService->createClient($data);

    
        $this->assertDatabaseHas('clients', [
            'name' => 'Teste Client',
            'phone' => '987654321',
            'email' => 'testclient@example.com',
            'cpf' => '98765432100',
        ]);

        
        $this->assertEquals('Teste Client', $client->name);
        $this->assertEquals('987654321', $client->phone);
        $this->assertEquals('testclient@example.com', $client->email);
        $this->assertEquals('98765432100', $client->cpf);
    }
}
