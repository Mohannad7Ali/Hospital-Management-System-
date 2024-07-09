<?php

namespace App\Interfaces\doctor_dashboard;

interface InvoicesRepositoryInterface
{
    //Get Doctor Invoices
    public function index();
    public function completedInvoices();
    public function reviewInvoices();
}
