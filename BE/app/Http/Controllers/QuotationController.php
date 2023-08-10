<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuotationRequest;
use App\Models\AgeLoad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Interfaces\QuotationRepositoryInterface;
use App\Models\Quotation;

/**
 * The QuotationController class handles the creation of quotations based on user input.
 */

class QuotationController extends Controller
{
    private QuotationRepositoryInterface $quotationRepository;

    /**
     * Create a new QuotationController instance.
     *
     * @param QuotationRepositoryInterface $quotationRepository The repository for managing quotations.
     */

    public function __construct(QuotationRepositoryInterface $quotationRepository)
    {
        $this->quotationRepository = $quotationRepository;
    }

    /**
     * Create a new quotation based on the provided request.
     *
     * @param QuotationRequest $request The HTTP request containing quotation details.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the created quotation information.
     */
    public function create(QuotationRequest $request)
    {
        // Extract data from the request

        $ages = $request->age;
        $currency_id = $request->currency_id;
        $start_date = Carbon::parse($request->start_date);
        $end_date =  Carbon::parse($request->end_date);

        // Calculate the total amount for the quotation
        $total = $this->quotationRepository->get_total($ages, $start_date, $end_date);

        // Convert the total amount to the specified currency
        $converted_total = $this->quotationRepository->convert_currency($total, $currency_id);

        // Save the quotation in the database
        $quotation = $this->quotationRepository->save_quotation($converted_total, $currency_id);


        return response()->json([
            "total" => $converted_total,
            "currency_id" => $currency_id,
            "quotation_id" => $quotation->id
        ], 201);
    }
}
