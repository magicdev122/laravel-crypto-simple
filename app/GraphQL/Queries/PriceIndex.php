<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use Coindesk;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class PriceIndex extends Query
{
    protected $attributes = [
        'name' => 'calculatePrice',
        'description' => 'Get Bitcoin price in Nigerian Naira'
    ];

    public function type(): Type
    {
        return Type::Float();
    }

    public function args(): array
    {
        return [
            'type' => [
                'name' => 'type',
                'type' => Type::string(),
                'rules' => ['required', 'string']
            ],
            'margin' => [
                'name' => 'margin',
                'type' => Type::float(),
                'rules' => ['required', 'between:0,99.99']
            ],
            'exchangeRate' => [
                'name' => 'exchangeRate',
                'type' => Type::float(),
                'rules' => ['required', 'numeric']
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        // Get type of transaction
        $type = strtolower($args['type']);

        // Get transaction's margin
        $margin = $args['margin'];

        // Resolve the margin's percentage value
        $margin_percent = $margin / 100;

        // Get the exchange rate
        $exchangeRate = $args['exchangeRate'];

        // Get current price of Bitcoin for $1 (USD)
        $current_bitcoin_price = Coindesk::toCurrency('USD', 1);

        // Check if transaction is a `buy` or `sell` transaction
        switch ($type) {
            case 'sell':
                // subtract the computed value of the margin percentage from the current Bitcoin price
                $res = $current_bitcoin_price - $margin_percent;
                break;
            
            case 'buy':
                // add the computed value of the margin percentage to the current Bitcoin price
                $res = $current_bitcoin_price + $margin_percent;
                break;
            
            default:
                return;
        }

        // Convert USD to NGN
        $ngn_btc = $res * $exchangeRate;

        // Send computed result
        return $ngn_btc;
    }
}
