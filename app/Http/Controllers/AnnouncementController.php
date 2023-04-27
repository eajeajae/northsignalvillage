<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Announcement;
use Auth;

class AnnouncementController extends Controller
{
    public function index(){
        return view('admin.createAnnouncement');
    }
    public function getAllAnnouncements(Request $request){
        if ($request->ajax()) {
            $announcements = Announcement::orderBy('id', 'asc')->get();
            
            return response()->json($announcements);
        }
    }
    public function storeAnnouncement(Request $request){
        $article_img = array();
        if($imgs = $request->file('article_img')){
            foreach($imgs as $img){
                $imageName = '-image-'.time().rand(1,1000).'.'.$img->extension();
                $img->move(public_path('article_images'),$imageName);
                $article_img[] = $imageName;
            }
        }
        $announcement = Announcement::insert([
            'user_id' => Auth::user()->id,
            'article_img' => implode('|', $article_img),
            'heading' => $request->heading,
            'caption' => $request->caption,
        ]);

        // dd($announcement);
        $announcement->save();
        $data=array('status' => 'saved');

        return response()->json([
            'status' => 200,
            'success' => true, 
            'annoucement' => $announcement
        ]);
    }
    public function updateAnnouncement(Request $request){
        $announcement = Announcement::find($request->id);

        if(Auth::user()->id != $request->id){
            return response()->json([
                'success' => false, 
                'message' => 'Admins can only update the announcement.'
            ]);
        }
        if($request->has('article_img')){
            foreach($request->file('article_img')as $image){
                $imageName = $announcement['heading'].'-image-'.time().rand(1,1000).'.'.$image->extension();
                $image->move(public_path('article_images'),$imageName);
                $announcement->article_img = $imageName;
            }
        }

        $announcement->heading = $request->heading;
        $announcement->caption = $request->caption;

        // dd($announcement);
        $announcement->update();
        $data=array('status' => 'saved');

        return response()->json([
            'status' => 200,
            'success' => true, 
            'message' => 'Announcement is updated.'
        ]);
    }
}
