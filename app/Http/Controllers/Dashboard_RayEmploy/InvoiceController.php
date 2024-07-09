<?php

namespace App\Http\Controllers\Dashboard_RayEmploy;

use App\Http\Controllers\Controller;
use App\Models\Ray;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $rays = Ray::all();
        dd(64564564645456);
        return $rays ?? 'no thing';
    }
}
