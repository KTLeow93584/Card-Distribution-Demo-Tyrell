<?php

namespace App\Http\Controllers;

use App\Interfaces\CardDistributorInterface;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use InvalidArgumentException;
use Throwable;

/**
 * Handles API requests for distributing cards.
 */
class CardController
{
    /**
     * Inject the card distributor via constructor.
     *
     * @param CardDistributorInterface $cardDistributor
     */
    public function __construct(CardDistributorInterface $cardDistributor)
    {
        $this->cardDistributor = $cardDistributor;
    }

    
    /**
     * Distribute cards to n people.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function distribute(Request $request)
    {
        $validated = $request->validate([
            'people' => 'required|integer|min:1'
        ]);

        try {
            $distribution = $this->cardDistributor->distribute($validated['people']);

            return response()->json([ 'output' => $distribution ]);
        }
        catch (InvalidArgumentException $e) {
            return response()->json([
                'message' => 'Input value does not exist or value is invalid'
            ], 400);
        }
        catch (Throwable $e) {
            return response()->json([
                'message' => 'Irregularity occurred'
            ], 500);
        }
    }
}