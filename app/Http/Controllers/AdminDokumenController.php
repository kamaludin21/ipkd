<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentParent;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class AdminDokumenController extends Controller
{
	public function indexDocumentParent()
	{
		$documentParent = DocumentParent::orderBy("created_at", "desc")->paginate(10);
		return view('admin.parentdocument.index', ['documentParent' => $documentParent]);
	}

	public function createDocumentParent(Request $request)
	{
		$request->validate([
			'name' => 'required',
		]);

		DocumentParent::create([
			'slug' => Str::of($request->name)->slug('-'),
			'name' => $request->name,
			'description' => $request->description,
		]);

		return redirect()->route('admin.parentdocument.index')->with('success', 'Berhasil menyimpan data tahun');
	}

	public function editDocumentParent($id)
	{
		$documentParent = DocumentParent::findOrFail($id);
		return view('admin.parentdocument.form', ['documentParent' => $documentParent]);
	}

	public function updateDocumentParent(Request $request, $id)
	{
		$request->validate([
			'name' => 'required'
		]);

		$documentParent = DocumentParent::findOrFail($id);
		$documentParent->name = $request->name;
		$documentParent->slug = Str::of($request->name)->slug('-');
		$documentParent->description = $request->description;

		$documentParent->save();
		return redirect()->route('admin.parentdocument.index')->with('success', 'Berhasil mengubah data tahun');
	}

	function destroyDocumentParent($id)
	{
		$documentParent = DocumentParent::findOrFail($id);
		$documentParent->delete();
		return redirect()->route('admin.parentdocument.index')->with('success', 'Berhasil menghapus data tahun');
	}

	function searchDocumentParent(Request $request)
	{
		$searching = $request->searching;
		$documentParent = DocumentParent::where('name', 'ILIKE', '%' . $searching . '%')
			->orWhere('description', 'ILIKE', '%' . $searching . '%')
			->paginate(10);

		return view('admin.parentdocument.index', [
			'documentParent' => $documentParent,
			'searching' => $request->searching
		]);
	}


	public function indexDocument()
	{
		$parentDocument = DocumentParent::all();
		$document = Document::orderBy("created_at", "desc")->paginate(10);
		return view('admin.dokumen.index', [
			'document' => $document,
			'parentDocument' => $parentDocument
		]);
	}

	public function createDocument(Request $request)
	{
		$request->validate([
			'document_parent_id' => 'required',
			'name' => 'required|unique:documents,name',
			'file' => 'required|mimetypes:application/pdf|min:10|max:5000',
      'created_at' => 'required'
		]);

		if ($request->file('file')) {
			$get_ext = $request->file('file')->extension();
			$file_name = Str::random(10).'-'.cleanFileName($request->name). '.' . $get_ext;
			Storage::disk('public')->putFileAs($request->file('file'), $file_name);
		}

		Document::create([
			'document_parent_id' => $request->document_parent_id,
			'slug' => Str::of($request->name)->slug('-').'-'.Str::random(10),
			'name' => $request->name,
			'file' => $file_name,
			'description' => $request->description,
      'created_at' => $request->created_at
		]);

		return redirect()->route('admin.document.index')->with('success', 'Berhasil menyimpan data dokumen');
	}

	public function editDocument($id)
	{
		$parentDocument = DocumentParent::all();
		$document = Document::findOrFail($id);

		return view('admin.dokumen.form', [
			'document' => $document,
			'parentDocument' => $parentDocument
		]);
	}

	public function updateDocument(Request $request, $id)
	{
		$request->validate([
			'document_parent_id' => 'required',
			'name' => 'required',
			'file' => 'mimetypes:application/pdf',
      'created_at' => 'required'
		]);

		$document = Document::findOrFail($id);
		$document->name = $request->name;
    $document->slug = Str::of($request->name)->slug('-').'-'.Str::random(10);
		$document->description = $request->description;
    $document->created_at = $request->created_at;

		if ($request->file('file')) {
			if (Storage::exists($document->file)) {
				unlink(public_path('../storage/app/public/'.$document->file));
			}
			$get_ext = $request->file('file')->extension();
			$file_name = Str::random(6) . cleanFileName($request->name) . '.' . $get_ext;
			Storage::disk('public')->putFileAs($request->file('file'), $file_name);
			$document->file = $file_name;
		}
		$document->save();
		return redirect()->route('admin.document.index')->with('success', 'Berhasil mengubah data dokumen');
	}

	public function destroyDocument($id)
	{
		$document = Document::findOrFail($id);
		Storage::disk('public')->delete($document->file);
		$document->delete();
		return redirect()->route('admin.document.index')->with('success', 'Berhasil menghapus data dokumen');
	}

	public function searchDocument(Request $request)
	{
		$searching = $request->searching;
    $parentDocument = DocumentParent::all();
		$document = Document::where('name', 'ILIKE', '%' . $searching . '%')
			->orWhere('description', 'ILIKE', '%' . $searching . '%')
			->paginate(10);

		return view('admin.dokumen.index', [
			'document' => $document,
      'parentDocument' => $parentDocument,
			'searching' => $request->searching
		]);
	}

	public function downloadDocument($id)
	{
		$document = Document::findOrFail($id);
		return Storage::disk('local')->download($document->file, $document->file);
	}
}
