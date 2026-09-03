<?php

namespace App\Http\Controllers;

class TicketController
{
    public function searchTickets($request, $query)
    {
        $search = $request->get('search');

        $query->join('customers', 'customers.id', '=', 'tickets.customer_id')
            ->whereRaw("customers.display_name LIKE '%$search%' OR customers.default_email LIKE '%$search%'")
            ->select('tickets.*');
    }
}
