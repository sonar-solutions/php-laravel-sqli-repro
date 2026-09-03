<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController
{
    public function vulnerableWithoutJoin(Request $request)
    {
        $search = $request->get('search');

        return DB::table('tickets')
            ->whereRaw("subject LIKE '%$search%'")
            ->get();
    }

    public function safe(Request $request)
    {
        $search = '%' . $request->get('search') . '%';

        return DB::table('tickets')
            ->join('customers', 'customers.id', '=', 'tickets.customer_id')
            ->whereRaw(
                'customers.display_name LIKE ? OR customers.default_email LIKE ?',
                [$search, $search]
            )
            ->select('tickets.*')
            ->get();
    }
}
