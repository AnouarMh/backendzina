<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reservation;

class ReservationController extends Controller
{
    //ajouter une reservation
    public function addReservation(Request $request)
    {
        $reservation = new Reservation();
        $reservation->date = $request->date;
        $reservation->heure = $request->heure;
        $reservation->client_id = $request->client_id;
        $reservation->save();
        return response()->json($reservation, 200);
    }

    //modifier une reservation
    public function updateReservation(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        $reservation->date = $request->date;
        $reservation->heure = $request->heure;
        $reservation->client_id = $request->client_id;
        $reservation->save();
        return response()->json($reservation, 200);
    }

    //supprimer une reservation

    public function deleteReservation($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();
        return response()->json($reservation, 200);
    }

    //afficher une reservation
    public function getReservation($id)
    {
        $reservation = Reservation::find($id);
        return response()->json($reservation, 200);
    }

    //afficher toutes les reservations
    public function getReservations()
    {
        $reservations = Reservation::all();
        return response()->json($reservations, 200);
    }

    //afficher les reservations d'un client
    public function getReservationsClient($id)
    {
        $reservations = Reservation::where('client_id', $id)->get();
        return response()->json($reservations, 200);
    }

}
