<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PizzaPrice;
use App\Models\AddonPrice;

class PizzaOrderController extends Controller
{
    public function index()
    {
        $pizzaPrices = PizzaPrice::all()->keyBy('size');
        $addonPrices = AddonPrice::all()->keyBy('type');

        return view('pizza-order', [
            'pizzaPrices' => $pizzaPrices,
            'addonPrices' => $addonPrices,
        ]);
    }

    public function calculateBill(Request $request)
    {
        $request->validate([
            'pizzas' => 'required|array|min:1',
            'pizzas.*.size' => 'required|in:small,medium,large',
            'pizzas.*.quantity' => 'required|integer|min:1|max:50',
            'pizzas.*.addons' => 'array',
            'pizzas.*.addons.*' => 'in:pepperoni,extra_cheese',
        ]);

        $pizzas = $request->input('pizzas');
        $orderItems = [];
        $total = 0;

        foreach ($pizzas as $index => $pizza) {
            $size = $pizza['size'];
            $quantity = (int) $pizza['quantity'];
            $addons = $pizza['addons'] ?? [];

            $pizzaPrice = PizzaPrice::where('size', $size)->first();
            if (!$pizzaPrice) {
                continue;
            }

            $itemTotal = $pizzaPrice->price;
            $addonDescriptions = [];

            foreach ($addons as $addon) {
                if ($addon === 'pepperoni') {
                    $addonPrice = AddonPrice::getAddonForSize('pepperoni', $size);
                    if ($addonPrice) {
                        $itemTotal += $addonPrice->price;
                        $addonDescriptions[] = 'Pepperoni';
                    }
                } elseif ($addon === 'extra_cheese') {
                    $addonPrice = AddonPrice::getAddonForSize('extra_cheese', $size);
                    if ($addonPrice) {
                        $itemTotal += $addonPrice->price;
                        $addonDescriptions[] = 'Extra Cheese';
                    }
                }
            }

            $description = ucfirst($size) . ' Pizza';
            if (!empty($addonDescriptions)) {
                $description .= ' with ' . implode(' & ', $addonDescriptions);
            }

            $lineTotal = $itemTotal * $quantity;
            $total += $lineTotal;

            $orderItems[] = [
                'description' => $description,
                'quantity' => $quantity,
                'unit_price' => $itemTotal,
                'line_total' => $lineTotal
            ];
        }

        return view('pizza-bill', [
            'orderItems' => $orderItems,
            'total' => $total
        ]);
    }
}