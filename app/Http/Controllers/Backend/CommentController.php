<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.comments.index');
    }

    public function create(Request $request)
    {
        return view('backend.comments.modals.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_user_id' => 'required|exists:course_users,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'note' => 'nullable|string',
            'admin_id' => 'required|exists:admins,id',
            'is_received' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Comment::create($request->all());

        return response()->json(['success' => 'Thêm thành công.']);
    }

    public function edit(Comment $comment, Request $request)
    {
        return view('backend.comments.modals.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $validator = Validator::make($request->all(), [
            'course_user_id' => 'required|exists:course_users,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'note' => 'nullable|string',
            'admin_id' => 'required|exists:admins,id',
            'is_received' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $comment->update($request->all());

        return response()->json(['success' => 'Cập nhật thành công.']);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json(['success' => 'Course deleted successfully.']);
    }

    public function data(Request $request)
    {
        // Lưu các giá trị bộ lọc vào session
        session(['comments_filters' => $request->all()]);

        $query = Comment::with('user', 'calendar')->latest();

        if ($request->has('user_id') && $request->user_id != '') {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('calendar_id') && $request->calendar_id != '') {
            $query->where('calendar_id', $request->calendar_id);
        }

        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $comments = $query->paginate(LIMIT);

        if ($request->ajax()) {
            return view('backend.comments.partials.data', compact('comments'))->render();
        }

        return view('backend.comments.index', compact('comments'));
    }
}
