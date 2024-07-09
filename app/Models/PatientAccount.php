<?php

namespace App\Models;

use App\Models\ReceiptAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientAccount extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ReceiptAccount()
    {
        return $this->belongsTo(ReceiptAccount::class, 'receipt_id', 'id');
    }
    public function PaymentAccount()
    {
        return $this->belongsTo(PaymentAccount::class, 'Payment_id', 'id');
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
