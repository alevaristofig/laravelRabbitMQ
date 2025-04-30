<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Producer\MessageProducerHabbitMQ;
use Illuminate\Http\JsonResponse;

class MessageProducerController extends Controller
{
    private $producer;

    public function __construct(MessageProducerHabbitMQ $producer) {
        $this->producer = $producer;
    }

    public function produzir(Request $request): JsonResponse {
        $this->producer->produzir($request->all());

        return response()->json(['ok' => true, 'mensagem' => "Mensagem produzida com sucesso"],200);
    }
}
