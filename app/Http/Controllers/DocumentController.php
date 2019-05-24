<?php

namespace App\Http\Controllers;

use App\Document;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $documents = Document::all();

        return view('document.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('document.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $uploadedFile = $request->file('file');
            $originalName = $uploadedFile->getClientOriginalName();
            $filename     = uniqid('', false) . '.' . $uploadedFile->getClientOriginalExtension();

            $document                = new Document;
            $document->original_name = $originalName;
            $document->filename      = $filename;

            $document->save();

            Storage::disk('uploads')->putFileAs(
                '/',
                $uploadedFile,
                $filename
            );
        } catch (Exception $e) {
            alert()->error($e->getMessage());
            redirect()->back();
        }

        alert()->success('Document created successfully!');

        return redirect('/documents');
    }
}
