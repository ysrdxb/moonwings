<?php

namespace App\Services;

use GuzzleHttp\Client;

class AmadeusService
{
    protected $client;
    protected $token;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => env('AMADEUS_API_BASE')]);
        $this->authenticate();
    }

    // Authenticate and retrieve access token
    private function authenticate()
    {
        $response = $this->client->post('/v1/security/oauth2/token', [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => env('AMADEUS_API_KEY'),
                'client_secret' => env('AMADEUS_API_SECRET'),
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        $this->token = $data['access_token'];
    }

    // Search for flights based on criteria
    public function searchFlights($origin, $destination, $departureDate)
    {
        $response = $this->client->get('/v2/shopping/flight-offers', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
            'query' => [
                'originLocationCode' => strtoupper($origin),
                'destinationLocationCode' => strtoupper($destination),
                'departureDate' => $departureDate,
                'adults' => 1,
                'currencyCode' => 'GBP',
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function confirmOffer($flightOffer)
    {
        try {
            $response = $this->client->post('/v1/shopping/flight-offers/pricing', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'data' => [
                        'type' => 'flight-offers-pricing',
                        'flightOffers' => [$flightOffer]
                    ],
                ],
            ]);
    
            return json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return [
                'error' => [
                    'message' => $e->getMessage(),
                    'response' => json_decode($e->getResponse()->getBody(), true),
                ],
            ];
        }
    }   

    // Book a flight with selected flight offer
    public function bookFlight($flightOffer)
    {
        try {
            $response = $this->client->post('/v1/booking/flight-orders', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'data' => [
                        'type' => 'flight-order',
                        'flightOffers' => [$flightOffer],
                        'travelers' => [
                            [
                                'id' => 1,
                                'dateOfBirth' => '1990-01-01',
                                'name' => [
                                    'firstName' => 'John',
                                    'lastName' => 'Doe',
                                ],
                                'gender' => 'MALE',
                                'contact' => [
                                    'emailAddress' => 'johndoe@example.com',
                                    'phones' => [
                                        [
                                            'deviceType' => 'MOBILE',
                                            'countryCallingCode' => '1',
                                            'number' => '1234567890',
                                        ],
                                    ],
                                ],
                                'documents' => [
                                    [
                                        'documentType' => 'PASSPORT',
                                        'birthPlace' => 'New York',
                                        'issuanceLocation' => 'New York',
                                        'issuanceDate' => '2010-01-01',
                                        'number' => '123456789',
                                        'expiryDate' => '2030-01-01',
                                        'issuanceCountry' => 'US',
                                        'validityCountry' => 'US',
                                        'nationality' => 'US',
                                        'holder' => true,
                                    ],
                                ],
                            ],
                        ],
                        'ticketingAgreement' => [
                            'option' => 'CONFIRM',
                        ],
                    ],
                ],
            ]);
    
            return json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return [
                'error' => [
                    'message' => $e->getMessage(),
                    'response' => json_decode($e->getResponse()->getBody(), true),
                ],
            ];
        }
    }
    
}
