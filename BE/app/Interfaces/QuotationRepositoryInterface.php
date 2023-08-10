<?php

namespace App\Interfaces;

interface QuotationRepositoryInterface
{
    public function get_total($ages, $start_date, $end_date);
    public function convert_currency($total, $currency_id);
    public function save_quotation($converted_total, $currency_id);
}
