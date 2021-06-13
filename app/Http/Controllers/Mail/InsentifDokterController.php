<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\SendEmailDokter;
use Illuminate\Support\Facades\Mail;

class InsentifDokterController extends Controller
{
    public function index()
    {
        Mail::to("itpku.sukoharjo@gmail.com")->send(new SendEmailDokter());

		return "Email telah dikirim";
    }
}
