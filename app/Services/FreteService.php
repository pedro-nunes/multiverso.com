<?php

namespace App\Services;

use MelhorEnvio\Client;

class FreteService
{
    protected $client;

    public function __construct()
    {
        // Instancia o cliente do Melhor Envio
        $this->client = new Client([
            'auth' => env('MELHOR_ENVIO_API_KEY'),
        ]);
    }

    /**
     * Cotar o valor do frete.
     *
     * @param array $dados
     * @return array
     */
    public function cotarFrete(array $dados)
    {
        // Exemplo de dados de entrada
        $dados = [
            'from' => [
                'zipcode' => '08615300', // CEP de origem
            ],
            'to' => [
                'zipcode' => '02002000', // CEP de destino
            ],
            'weight' => 500, // Peso em gramas
            'dimensions' => [
                'length' => 20,  // Comprimento em cm
                'height' => 15,  // Altura em cm
                'width' => 10,   // Largura em cm
            ],
        ];

        // Realiza a cotação com as transportadoras
        $response = $this->client->freight()->calculate($dados);

        return $response;
    }
}