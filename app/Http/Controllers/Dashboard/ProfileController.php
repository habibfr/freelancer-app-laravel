<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Dashboard\Profile\UpdateProfileRequest;
use App\Http\Requests\Dashboard\Profile\UpdateDetailUserRequest;

use Illuminate\Support\Facades\Storage;
use Iluminate\Support\Facades\DB;

use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Testing\File;
// use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\DetailUser;
use App\Models\ExperienceUser;

class ProfileController extends Controller
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
        $user = User::where('id', Auth::user()->id)->first();
        $experience_user = ExperienceUser::where('detail_user_id', $user->detail_user->id)
            ->orderBy('id', 'asc')
            ->get();
        // $detail_user = DetailUser::where('users_id', $user->detail_user->id)->get();


        return view('pages.dashboard.profile', compact('user', 'experience_user'));
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
    public function update(UpdateProfileRequest $request_profile, UpdateDetailUserRequest $request_detail_user)
    {
        $data_profile = $request_profile->all();
        $data_detail_user = $request_detail_user->all();


        // get foto
        $get_photo = DetailUser::where('users_id', Auth::user()->id)->first();

        // delete old file from storage
        if (isset($data_detail_user['photo'])) {
            $data = 'storage' . $get_photo['photo'];

            if (File::exists($data)) {
                File::delete($data);
            } else {
                File::delete('storage/app/public' . $get_photo['photo']);
            }
        }


        // store file to storage
        if (isset($data_detail_user['photo'])) {
            $data_detail_user['photo'] = $request_detail_user->file('photo')->store(
                'assets/photo',
                'public'
            );
        }

        // proses save
        $user = User::find(Auth::user()->id);
        $user->update($data_profile);

        // proses save to detail user
        $detail_user = DetailUser::find($user->detail_user->id);
        $detail_user->update($data_detail_user);

        // proses to save experience user
        $experience_user_id = ExperienceUser::where('detail_user_id', $detail_user['id'])->first();

        if (isset($experience_user_id)) {
            foreach ($data_profile['experience'] as $key => $value) {
                $experience_user = ExperienceUser::find($key);
                $experience_user->detail_user_id = $detail_user['id'];
                $experience_user->experience = $value;
                $experience_user->save();
            }
        } else {
            foreach ($data_profile['experience'] as $key => $value) {
                if (isset($value)) {
                    $experience_user = new ExperienceUser;
                    $experience_user->detail_user_id = $detail_user['id'];
                    $experience_user->experience = $value;
                    $experience_user->save();
                }
            }
        }

        Alert::toast()->success('update has been success');
        // Alert::success('Success Title', 'Success Message');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return abort(404);
    }

    // custom
    public function delete()
    {
        // get user 
        $get_user_photo = DetailUser::where('users_id', Auth::user()->id)->first();
        $path_photo = $get_user_photo['photo'];


        $data = DetailUser::find($get_user_photo['id']);
        $data->photo = NULL;
        $data->save();

        // delete
        $data = 'storage/'. $path_photo;
        if(File::exist($data)){
            File::delete($data);
        }else{
            File::delete('storage/app/public/'. $path_photo);
        }

        Alert::toast()->success('delete has been success');
        return back();


    }
}
