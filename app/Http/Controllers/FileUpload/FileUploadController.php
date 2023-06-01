<?php

namespace App\Http\Controllers\FileUpload;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\FileUpload;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
class FileUploadController extends Controller
{
    public function fileUpload(Request $request)
    {
        $url = route('insert-file');
        return view('fileUpload.fileuploadview', compact('url'));
    }
    public function insertFile(Request $request)
    {
        if (isset($request->file)) {
            $file = time() . '.' . $request->file->getClientOriginalExtension();
            $path = public_path('assets/UploadedFiles');
            if (!File::exists($path)) {
                File::makeDirectory($path);
            }
            $request->file->move($path, $file);
        }
        DB::beginTransaction();
        try {
            $data = array(
                'name' => $request->fileName,
                'file' => $file ?? 'demo.png',
                'password' => $request->password,
            );
            FileUpload::create($data);
            Session::flash('message', 'File Uploaded Successfully!');
            Session::flash('alert-class', 'alert-success');
            DB::commit();
        } catch (\Exception $ex) {
            Log::error(['Error' => $ex->getMessage()]);
            DB::rollBack();
            Session::flash('message', 'The email is already registered kindly try with another email');
            Session::flash('alert-class', 'alert-warning');
        }
        return redirect()->back();
    }
    public function uploadedFilesList(Request $request)
    {
        $search = $request['search'] ? $request['search'] : "";
        if (($search !== "")) {
            $allFiles = FileUpload::where('name', 'LIKE', "%$search%")->orderby('id', 'DESC')->paginate(10);
        } else {
            $allFiles = FileUpload::orderby('id', 'DESC')->paginate(10);
        }
        return view('fileUpload.uploadedFileslist', compact('allFiles', 'search'));
    }
    public function uploadFile(Request $request)
    {
        if (isset($request->file)) {
            $file = time() . '.' . $request->file->getClientOriginalExtension();
            $path = public_path('assets/UploadedFiles');
            if (!File::exists($path)) {
                File::makeDirectory($path);
            }
            $request->file->move($path, $file);
        }
        FileUpload::where('id', $request->id)->update([
            'name' => $request->fileName, 'password' => $request->filePassword,
            'file' =>isset($request->file)  ? $file : $request->hiddenFile
        ]);
        Session::flash('message', 'File Updated Successfully!');
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }
    public function filePasswordValidation (Request $request)
    {
        $fileId = Crypt::decrypt($request->fileId);
        return view('filePasswordValidation',compact('fileId'));
    }
}
