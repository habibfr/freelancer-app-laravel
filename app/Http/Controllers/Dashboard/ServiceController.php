<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Dashboard\Service\StoreServiceRequest;
use App\Http\Requests\Dashboard\Service\UpdateServiceRequest;

use Illuminate\Support\Facades\Storage;
use Iluminate\Support\Facades\DB;

use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Testing\File;
// use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;

use App\Models\Service;
use App\Models\AdvantageService;
use App\Models\Tagline;
use App\Models\AdvantageUser;
use App\Models\ThumbnailService;
use App\Models\Order;
use App\Models\User;


class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        $services = Service::where('users_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return view('pages.dashboard.service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $data = $request->all();

        // dd($data);

        $data['users_id'] = Auth::user()->id;

        $service = Service::create($data);

        // add to advantage

        foreach ($data['advantage-service'] as $key => $value) {
            $advantage_service = new AdvantageService;
            $advantage_service->service_id = $service->id;
            $advantage_service->advantage = $value;
            $advantage_service->save();
        }

        // add advantage user
        foreach ($data['advantage-user'] as $key => $value) {
            $advantage_user = new AdvantageUser;
            $advantage_user->service_id = $service->id;
            $advantage_user->advantage = $value;
            $advantage_user->save();
        }

        // add to thumbnail
        if ($request->hasFile('thumbnail')) {
            foreach ($request->file('thumbnail') as $file) {
                $path = $file->store(
                    'assets/service/thumbnail',
                    'public'
                );

                $thumbnail_service = new ThumbnailService;
                $thumbnail_service->service_id = $service['id'];
                $thumbnail_service->thumbnail = $path;
                $thumbnail_service->save();
            }
        }

        // add to tagline

        if (isset($data['tagline'])) {
            foreach ($data['tagline'] as $key => $value) {
                $tagline = new Tagline;
                $tagline->service_id = $service['id'];
                $tagline->tagline = $value;
                $tagline->save();
            }
        }



        Alert::toast()->success('Save has been success');
        return redirect("member/service");
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
    public function edit(Service $service)
    {

        $advantage_service = AdvantageService::where('service_id', $service->id)->get();
        $tagline = Tagline::where('service_id', $service['id'])->get();
        $advantage_user = AdvantageUser::where('service_id', $service['id'])->get();
        $thumbnail_service = ThumbnailService::where('service_id', $service['id'])->get();

        return view('pages.dashboard.service.edit', compact('service', 'advantage_service', 'tagline', 'advantage_user', 'thumbnail_service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $data = $request->all();
        $service->update($data);


        // update to advantage service
        foreach ($data['advantage-service'] as $key => $value) {
            $advantage_service = AdvantageService::find($key);

            // $advantage_service->service_id = $service['id'];
            $advantage_service->advantage = $value;
            $advantage_service->save();
        }

        // update to advantage service
        if (isset($data['advantage_service'])) {
            foreach ($data['advantage-service'] as $key => $value) {
                $advantage_service = AdvantageService::find($key);
                $advantage_service->service_id = $service['id'];
                $advantage_service->advantage = $value;
                $advantage_service->save();
            }
        }

        // update to advantage user
        foreach ($data['advantage-user'] as $key => $value) {
            $advantage_user = AdvantageUser::find($key);

            // $advantage_user->service_id = $service['id'];
            $advantage_user->advantage = $value;
            $advantage_user->save();
        }

        // update to advantage user
        if (isset($data['advantage_user'])) {
            foreach ($data['advantage-user'] as $key => $value) {
                $advantage_user = AdvantageUser::find($key);
                $advantage_user->service_id = $service['id'];
                $advantage_user->advantage = $value;
                $advantage_user->save();
            }
        }


        // update to tagline
        foreach ($data['tagline'] as $key => $value) {
            $tagline = Tagline::find($key);

            // $tagline->service_id = $service['id'];
            $tagline->tagline = $value;
            $tagline->save();
        }

        // update to advantage user
        if (isset($data['tagline'])) {
            foreach ($data['tagline'] as $key => $value) {
                $tagline = Tagline::find($key);
                $tagline->service_id = $service['id'];
                $tagline->advantage = $value;
                $tagline->save();
            }
        }

        // update thumbnail service
        if ($request->hasFile('thumbnails')) {
            foreach ($request->file('thumbnails') as $key => $value) {
                // get old photo
                $get_photo = ThumbnailService::where('id', $key)->first();

                // store photo
                // file
                $path = $get_photo->store(
                    'assets/service/thumbnail',
                    'public'
                );


                // update thumbnail

                $thumbnail_service = ThumbnailService::find($key);
                $thumbnail_service->thumbnail = $path;
                $thumbnail_service->save();


                // delete old photo thumbnail
                $data = 'storage' . $get_photo['photo'];
                if (File::exists($data)) {
                    FIle::delete($data);
                } else {
                    File::delete('storage/app/public/' . $get_photo['photo']);
                }
            }
        }

        if ($request->hasFile('thumbnail')) {
            foreach ($request->file('thumbnail') as $key => $value) {
                $path = $get_photo->store(
                    'assets/service/thumbnail',
                    'public'
                );

                $thumbnail_service = new ThumbnailService;
                $thumbnail_service->service_id['id'];
                $thumbnail_service->thumbnail = $path;
                $thumbnail_service->save();
            }
        }

        Alert::toast()->success('Update has been success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
