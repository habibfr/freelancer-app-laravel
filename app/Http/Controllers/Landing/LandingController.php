<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Iluminate\Support\Facades\DB;

use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Testing\File;
// use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;

use App\Models\Service;
use App\Models\Order;
use App\Models\User;
use App\Models\AdvantageService;
use App\Models\AdvantageUser;
use App\Models\Tagline;
use App\Models\ThumbnailService;


class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $services = Service::orderBy('created_at', 'desc')->get();

        return view("pages.landing.index", compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return abort(404);
    }

    // custom 

    public function explore()
    {

        $services = Service::orderBy('created_at', 'desc')->get();

        return view("pages.landing.explore", compact('services'));
    }

    public function detail($id)
    {

        $service = Service::where('id', $id)->first();
        $thumbnail = ThumbnailService::where('service_id', $id)->get();
        $advantage_user = AdvantageUser::where('service_id', $id)->get();
        $advantage_service = AdvantageService::where('service_id', $id)->get();
        $tagline = Tagline::where('service_id', $id)->get();

        return view("pages.landing.detail", compact('service', 'thumbnail', 'advantage_user', 'advantage_service', 'tagline'));
    }

    public function booking($id)
    {
        $service = Service::where('id', $id)->first();
        $user_buyer = Auth::user()->id;

        // dd($service->user_id . $user_buyer);
        if ($service->users_id == $user_buyer) {
            Alert::toast()->warning("Sorry, You can't book your own service");
            return back();
        }

        $order = new Order;
        $order->buyer_id = $user_buyer;
        $order->freelancer_id = $service->user->id;
        $order->service_id = $service->id;
        $order->file = NULL;
        $order->note = NULL;
        $order->expired = Date('y-m-d', strtotime('+3 days'));
        $order->order_status_id = 4;
        $order->save();

        $order_detail = Order::where('id', $order->id)->first();

        return redirect()->route("detail.booking.landing", $order->id);
    }

    public function detail_booking($id)
    {
        $order = Order::where('id', $id)->first();

        return view('pages.landing.booking', compact('order'));
    }
}
