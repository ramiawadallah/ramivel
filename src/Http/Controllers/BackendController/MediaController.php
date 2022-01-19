<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Admin;

class MediaController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role:super');
    }

    public function index()
    {
        $medias = Media::paginate(12);
        return view('admin.media.index',compact('medias',$medias));
    }

    public function store(Request $request)
    {

        $request->validate(['media' => 'required|max:500']);

        $admin = auth()->user();
        $admin-> addMedia($request->media)->toMediaCollection('media');
        return redirect()->back()->with('message', "You have created successfully media");
    }


    public function update(Request $request, $id)
    {

    }

    public function updateAvatar(Request $request, $id){
        $admin = auth()->user();
        $admin->avatar_id = $request->SelectedAvatar;
        $admin->save();
        return redirect()->back()->with('message', "You have updated profile picture successfully");
    }

    public function destroy($id)
    {
        foreach (Admin::all() as $admin) {
            $media = Media::find($id);
            if ($id == $admin->avatar_id) {
                // Delete media and reset Admin avatar
                $media->delete();
                $admin = auth()->user();
                $admin->avatar_id = null;
                $admin->save();
                return redirect()->back()->with('message', "You have deleted successfully media");
            }else{
                // Delete media
                $media->delete();
                return redirect()->back()->with('message', "You have deleted successfully media");
            }
        }
    }
}
