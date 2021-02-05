<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead; // importo lead

use Illuminate\Support\Facades\Mail; // aggiungo mail
use App\Mail\MessageFromWebsite; // importo MessageFromWebsite


class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');       // e' decommentato perche' il middleware e' stato aggiunto nelle rotte in web.php
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('guest.home');
    }

    public function contatti()
    {
        return view('guest.contatti');
    }

    public function contattiStore(Request $request) // passo request x recuperare i dati
    {
        $form_data = $request->all(); // prendo tutti i dati del form e li salvo in form_data
        $new_lead = new Lead(); // creo una nuova istanza dell oggetto new lead
        $new_lead->fill($form_data); //faccio fill dei dati
        $new_lead->save(); // salvo sul database
        Mail::to('info@boolpress.com')->send(new MessageFromWebsite($new_lead)); // x mandare mail al destinatario, passo a send l oggetto che sara' inviato a l'indirizzo info@boolpress.com il contenuto della view in build()
        return redirect()->route('contatti.thank-you'); //rimando l utente a questa rotta dopo invio form
    }

    public function thankYou()
    {
        return view('guest.thank-you');
    }
}
