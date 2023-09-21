<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentParent;
use Illuminate\Http\Request;

class DocumentParentController extends Controller
{
    public function index()
    {
      $parentDocument = DocumentParent::all();
      $parentDocumentData = DocumentParent::all()->first();
      $document = Document::where('document_parent_id', $parentDocumentData->id)->get();


      return view('dokumen.index', [
        'parentDocument' => $parentDocument,
        'parentDocumentData' => $parentDocumentData,
        'document' => $document
      ]);
    }

    public function parent($parent)
    {
      $parentDocument = DocumentParent::all();
      $parentDocumentData = DocumentParent::where("slug", $parent)->first();
      $document = Document::where('document_parent_id', $parentDocumentData->id)->get();

      // return $parentDocumentData->id;

      return view('dokumen.index', [
        'parentDocument' => $parentDocument,
        'parentDocumentData' => $parentDocumentData,
        'document' => $document
      ]);
    }
}
