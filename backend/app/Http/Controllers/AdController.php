<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdRequest;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    public function create(AdRequest $request)
    {
        $validData = $request->validated();
        if ($request->hasFile('img_url')) {
            $path = $request->file('img_url')->store('ads', 'public');
        } else {
            $path = 'ads/default.jpg';
        }

        $ad = Ad::create([
            'name' => $validData['name'],
            'description' => $validData['description'],
            'price' => $validData['price'],
            'image_url' => $path,
            'user_id' => $request->user()->id
        ]);

        return response()->json(['message' => 'success create', 'data' => $ad]);
    }
    public function all()
    {
        $ads = Ad::all();
        return response()->json(['data' => $ads]);
    }
    public function one(string $id, Request $request)
    {
        try {
            $ad = Ad::with('user')->find($id);

            if ($ad->user_id !== $request->user()->id) {
                return response()->json(['message' => 'Forbidden'], 403);
            }
            $ad->image_url = asset('storage/' . $ad->image_url);
            return response()->json(['data' => $ad]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Not found'], 404);
        }
    }
    public function update(string $id, AdRequest $request)
    {
        try {
            $validData = $request->validated();
            $ad = Ad::findOrFail($id);
            if ($ad->user_id !== $request->user()->id) {
                return response()->json(['message' => 'Forbidden'], 403);
            }
            if ($request->hasFile('img_url')) {
                if ($ad->image_url !== 'ads/default.jpg') {
                    Storage::delete('/public/ads' . $ad->image_url);
                }

                $path = $request->file('img_url')->store('ads', 'public');
            } else {
                $path = $ad->image_url;
            }
            $ad->update([
                'name' => $validData['name'],
                'description' => $validData['description'],
                'price' => $validData['price'],
                'image_url' => $path,
                'user_id' => $request->user()->id
            ]);
            return response()->json(['data' => $ad, 'message' => 'update']);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }
    public function delete(string $id, Request $request)
    {
        try {
            $ad = Ad::findOrFail($id);
            if ($ad->user_id !== $request->user()->id) {

                return response()->json(['message' => 'Forbidden'], 403);
            }
            if ($ad->image_url !== 'ads/default.jpg') {
                Storage::delete('/public/ads' . $ad->image_url);
            }
            $ad->delete();

            return response()->json(['message' => 'delete success']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Not found'], 404);
        }
    }
}
