<?php

namespace App\Http\Controllers\Dashboard_Doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\doctor_dashboard\InvoicesRepositoryInterface;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    private $invoices;
    public function __construct(InvoicesRepositoryInterface $invoices)
    {
        $this->invoices = $invoices;
    }

    public function  index()
    {
        return $this->invoices->index();
    }

    public function completedInvoices()
    {
        return $this->invoices->completedInvoices();
    }

    public function reviewInvoices()
    {
        return $this->invoices->reviewInvoices();
    }
}
