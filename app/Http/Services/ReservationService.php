<?php

namespace App\Http\Services;

use App\Models\Reservation;

class ReservationService
{
    public function pay(int $id): void
    {
        $reservation = Reservation::find($id);
        $reservation->paid = 1;
        $reservation->save();
    }
}