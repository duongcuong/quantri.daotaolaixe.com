<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\ImportLog;
use App\Models\ImportRow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ImportController extends Controller
{
    public function data(Request $request)
    {
        $query = ImportLog::latest();

        $imports = $query->paginate(LIMIT);

        if ($request->ajax()) {
            return view('backend.imports.data', compact('imports'))->render();
        }

        return view('backend.imports.data', compact('imports'));
    }

    public function show($importLogId)
    {
        $importLog = ImportLog::findOrFail($importLogId);
        $importRows = ImportRow::where('import_log_id', $importLogId)->paginate(LIMIT);

        return view('backend.imports.show', compact('importLog', 'importRows'));
    }
}
