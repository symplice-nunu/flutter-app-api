<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Postcategory;


class PostcategoryController extends Controller
{
    
    public function getAllPostcategorys() {
      $postcategorys = Postcategory::get()->toJson(JSON_PRETTY_PRINT);
      return response($postcategorys, 200);
    }

     public function getPostcategory($id) {
      if (Postcategory::where('id', $id)->exists()) {
        $postcategory = Postcategory::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($postcategory, 200);
      } else {
        return response()->json([
          "message" => "Postcategory not found"
        ], 404);
      }
    }

     public function createPostcategory(Request $request) {
      $postcategory = new Postcategory;
      $postcategory->category_name = $request->category_name;
      $postcategory->save();

      return response()->json([
        "message" => "Postcategory created"
      ], 201);
    }

    public function updatePostcategory(Request $request, $id) {
      if (Postcategory::where('id', $request->id)->exists()) {
        $postcategory = Postcategory::find($request->id);

        $postcategory->category_name = is_null($request->category_name) ? $postcategory->category_name : $request->category_name;
        $postcategory->save();

        return response()->json([
          "message" => "Postcategory updated successfully"
        ], 200);
      } else {
        return response()->json([
          "message" => "Postcategory not found"
        ], 404);
      }
    }

    public function deletePostcategory ($id) {
      if(Postcategory::where('id', $id)->exists()) {
        $postcategory = Postcategory::find($id);
        $postcategory->delete();

        return response()->json([
          "message" => "Postcategory deleted"
        ], 202);
      } else {
        return response()->json([
          "message" => "Postcategory not found"
        ], 404);
      }
    }
}
