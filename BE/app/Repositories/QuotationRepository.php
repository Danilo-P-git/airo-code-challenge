<?php

namespace App\Repositories;

use App\Interfaces\QuotationRepositoryInterface;
use App\Models\AgeLoad;
use App\Models\Quotation;
use AmrShawky\LaravelCurrency\Facade\Currency;


/**
 * The QuotationRepository class implements the QuotationRepositoryInterface
 * and provides methods for calculating and managing quotation-related data.
 */
class QuotationRepository implements QuotationRepositoryInterface
{
    /**
     * Calculate the total cost for a quotation based on given parameters.
     *
     * @param array $ages An array of ages for which to calculate the cost.
     * @param object $start_date The start date of the quotation period.
     * @param object $end_date The end date of the quotation period.
     * @return float The calculated total cost for the quotation.
     */
    public function get_total($ages, $start_date, $end_date)
    {
        $trip_length = $end_date->diffInDays($start_date) + 1;
        $fixed_rate = 3;
        $total = 0;

        foreach ($ages as $key => $age) {
            // Retrieve the load factor based on the age range
            $load = AgeLoad::where([
                ['min', '<=', $age],
                ['max', '>=', $age]
            ])->first('load')->load;

            // Calculate the subtotal for the age group
            $subTotal = $fixed_rate * $load * $trip_length;
            $total += $subTotal;
        }

        return $total;
    }

    /**
     * Convert the given total cost to the specified currency.
     *
     * @param float $total The total cost to be converted.
     * @param string $currency_id The target currency code for conversion.
     * @return float The converted total cost in the specified currency.
     */
    public function convert_currency($total, $currency_id)
    {
        $converted_total = Currency::convert()
            ->from('EUR')
            ->to($currency_id)
            ->amount($total)
            ->round(2)
            ->get();

        return $converted_total;
    }

    /**
     * Save the quotation with the provided total cost and currency.
     *
     * @param float $converted_total The converted total cost of the quotation.
     * @param string $currency_id The currency code for the quotation.
     * @return Quotation The saved quotation instance.
     */
    public function save_quotation($converted_total, $currency_id)
    {
        $quotation = new Quotation([
            "total" => $converted_total,
            "currency_id" => $currency_id
        ]);

        $quotation->save();
        return $quotation;
    }
}
