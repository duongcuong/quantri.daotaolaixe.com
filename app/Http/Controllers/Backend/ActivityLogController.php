<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index()
    {
        $activities = Activity::latest()->paginate(LIMIT);
        return view('backend.activity-log.index', compact('activities'));
    }
}
