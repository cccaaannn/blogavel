<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function profilePage()
    {
        return view('users/me');
    }

    public function addAvatar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (!$request->hasFile('avatar')) {
            return back()->withErrors(['avatar' => __('generic.error')])->withInput();
        }

        $user = Auth::user();

        // Delete the existing avatar if it exists
        if ($user->avatar) {
            Storage::disk('minio')->delete('public/avatars/' . $user->avatar);
            $user->avatar = null;
        }

        $image = $request->file('avatar');
        $fileName = time() . '.' . $image->getClientOriginalExtension();

        // Store the image in MinIO
        try {
            Storage::disk('minio')->putFileAs('public/avatars', $image, $fileName);
            Log::info('Uploaded new avatar: ' . $fileName);
        } catch (\Exception $e) {
            Log::error('Failed to upload file to MinIO: ' . $e->getMessage());
            return back()->withErrors(['avatar' => __('generic.error')])->withInput();
        }

        // Save the filename to the user model
        $user->avatar = $fileName;
        $user->save();

        return back()
            ->with('success', __('generic.avatar_upload_success'))
            ->with('image', $fileName);
    }

    public function deleteAvatar()
    {
        $user = Auth::user();
        $fileName = $user->avatar;

        // Delete the image from MinIO
        Storage::disk('minio')->delete('public/avatars/' . $fileName);

        // Remove the filename from the user model
        $user->avatar = null;
        $user->save();

        return back();
    }
}
