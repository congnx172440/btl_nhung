<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Esp32Controller extends Controller
{
    public function getThemuid($idu,$idp)
    {
        return response("OK", 200);
    }
    public function getresult($idu)
    {
        return response("Nguyen Thi Ha Linh", 404);
    }
}
