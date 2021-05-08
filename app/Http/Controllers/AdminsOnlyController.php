<?php

namespace App\Http\Controllers;

class AdminsOnlyController extends Controller
{
    public function __construct()
    {
        //First: Middleware that Checks if user is autenticathed
        $this->middleware('auth');
        //Second: Middleware that Checks if user is admin and set up what routes (functions) in this controller are admin only.
        $this->middleware('is_admin', ['only' => ['only_admin_can_see']]);
    }

///home/only_admin_can_see
    public function only_admin_can_see()
    {
        return "ONLY AN ADMIN CAN SEE THIS";
    }

//    /home/everyone
    public function everyone()
    {
        return "Every autenticated user can see this!!";
    }
}
