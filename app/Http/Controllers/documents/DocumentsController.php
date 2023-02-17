<?php

namespace App\Http\Controllers\documents;

use App\Http\Controllers\Controller;
use App\Models\Documents;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function index()
    {
        $documents = Documents::all();
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'file' => 'required|mimes:pdf|max:2048',
            'description' => 'max:550',
        ]);

        $document = new Documents;
        $document->name = $request->name;
        $document->description = $request->description;
        $document->create = date('Y-m-d');
        $document->update = date('Y-m-d');
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file->move(public_path() . '/documents', $file->getClientOriginalName());
            $document->document = $file->getClientOriginalName();
        }

        $document->save();

        return redirect()->route('index.document')->with('guardar', 'ok');
    }

    public function edit(Documents $data)
    {
        return view('documents.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'file' => 'nullable|mimes:pdf|max:2048',
            'description' => 'max:550',
        ]);

        $document = Documents::findOrFail($id);

        $oldFilePath = public_path('documents/' . $document->document);

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $file->move(public_path('documents'), $file->getClientOriginalName());

            $document->document = $file->getClientOriginalName();

            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        $document->name = $request->name;
        $document->description = $request->description;
        $document->update = date('Y-m-d');
        $document->save();

        return redirect()->route('index.document')->with('editar', 'ok');
    }

    public function delete(Request $request)
    {
        $id = $request->route('id');
        $document = Documents::find($id);

        $filename = $document->document;
        $filepath = public_path('documents/' . $filename);
        if (file_exists($filepath)) {
            unlink($filepath);
        }

        $document->delete();

        return redirect()->route('index.document')->with('eliminar', 'ok');
    }

    public function preview(Documents $data)
    {
        return view('documents.preview', compact('data'));
    }
}
