<?php

namespace App\Services;

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

use App\Entities\Plan;
use Exception;

class GerencianetService
{
    public const PAYMENT_METHOD_BILLET    = 'billet';
    public const PAYMENT_METHOD_CREDIT    = 'credit';

    private const STATUS_NEW              = 'new';
    private const STATUS_WAITING          = 'waiting';
    private const STATUS_PAID             = 'paid';
    private const STATUS_UNPAID           = 'upaid';
    private const STATUS_REFUNDED         = 'refunded';
    private const STATUS_CONTESTED        = 'contested';
    private const STATUS_SETTLED          = 'settled';
    private const STATUS_CANCELED         = 'canceled';

    private $options;
    private $user;
    private $subscriptionService;
    private $userSubscription;

    public function __construct()
    {
        $this->options = [

            'client_id'         => env('GERENCIANET_CLIENT_ID'),
            'client_secret'     => env('GERENCIANET_CLIENT_SECRET'),
            'sandbox'           => env('GERENCIANET_SANDBOX'), // altere conforme o ambiente (true = Homologação e false = producao)
            'time'              => env('GERENCIANET_TIMEOUT')
        ];
    }

    public function createPlan(Plan $plan)
    {
        // Define a periodicidade das cobranças a serem geradas
        $plan->setIntervalRepeats();

        echo '<pre>';
        print_r($plan);
        
        throw new Exception('Teste');

        $body = [
            'name'          => $plan->name,
            'interval'      => $plan->interval,
            'repeats'       => $plan->repeats
        ];

        try {
            $api = new Gerencianet($this->options);
            $response = $api->createPlan([], $body);

            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</pre>';
            exit;
        } catch (GerencianetException $e) {
            print_r($e->code);
            print_r($e->error);
            print_r($e->errorDescription);
        } catch (\Exception $e) {
            print_r($e->getMessage());
        }
    }
}
