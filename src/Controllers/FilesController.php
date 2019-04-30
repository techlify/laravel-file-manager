<?php

namespace Techlify\FileManager\Controllers;

use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Techlify\FileManager\Models\File;

/**
 * Controller to handle files management tasks
 * 
 * @author Joshua Kissoon
 * @since 20180125
 */
class FilesController extends Controller
{

    /**
     * handle moving the uploaded file to storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $raw_file = \Request::file('fileData');
        $extension = $raw_file->getClientOriginalExtension();

        $date = date("Ymd");
        $dir = File::FILE_SUB_URL . $date . "/";

        if (!Storage::makeDirectory($dir))
        {
            return response()->json(['error' => "Unable to create directory. "], 422);
        }

        $file = $dir . $raw_file->getFilename() . '.' . $extension;

        if (!Storage::put($file, \Illuminate\Support\Facades\File::get($raw_file)))
        {
            return response()->json(['error' => "Unable to upload file. "], 422);
        }

        return array("file" => $file);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->hasPermission("file_read"))
        {
            return response()->json(['error' => "You are unauthorized to perform this action. "], 401);
        }

        $filters = request(['owner_id', 'sort_by']);

        $items = File::filter($filters)->get();

        return array("items" => $items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->hasPermission("file_create"))
        {
            return response()->json(['error' => "You are unauthorized to perform this action. "], 401);
        }

        $this->validate(request(), [
            "filename" => "required",
            "owner_id" => "required|integer",
            "owner_type" => "required",
        ]);

        $item = new File();
        $item->owner_id = request('owner_id');
        $item->filename = request('filename');
        $item->title = request('title') ?: "";
        $item->owner_type = request("owner_type");

        /* Check if the File was Added */
        if (!$item->save())
        {
            return array("file" => $item, "success" => false, "message" => "Failed to add File. ");
        }

        return array("file" => $item, "success" => true, "message" => "Successfully added File. ");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->hasPermission("file_update"))
        {
            return response()->json(['error' => "You are unauthorized to perform this action. "], 401);
        }
        $this->validate(request(), [
            "title" => "required",
        ]);

        $file = File::find($id);
        $preObject = $file->toJson();
        $file->title = request('title');

        /* Check if File was Updated */
        if (!$file->update())
        {
            return array("file" => $file, "success" => false, "message" => "Failed to update File. ");
        }
        return array("file" => $file, "success" => true, "message" => "Successfully updated File. ");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->hasPermission("file_delete"))
        {
            return response()->json(['error' => "You are unauthorized to perform this action. "], 401);
        }
        $file = File::find($id);
        $deleted = $file->delete();

        /* Check if File was deleted */
        if (!$deleted)
        {
            return array("file" => $file, "success" => false, "message" => "Failed to delete File. ");
        }
        return array("file" => $file, "success" => true, "message" => "Successfully deleted File. ");
    }

}
