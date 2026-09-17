<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Comment;
use App\Models\ProjectLike;
use Illuminate\Support\Facades\Auth;

class InteractionController extends Controller
{
    // Fungsi untuk Like / Unlike Project
    public function toggleLike(Project $project)
    {
        $userId = Auth::id();

        $existingLike = ProjectLike::where('project_id', $project->id)
                                   ->where('user_id', $userId)
                                   ->first();

        if ($existingLike) {
            // Jika sudah dilike, maka batalkan (Unlike)
            $existingLike->delete();
            $project->decrement('likes_count');
            $liked = false;
        } else {
            // Jika belum, berikan Like baru
            ProjectLike::create([
                'project_id' => $project->id,
                'user_id' => $userId
            ]);
            $project->increment('likes_count');
            $liked = true;
        }

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $project->fresh()->likes_count
        ]);
    }
    public function storeComment(Request $request, Project $project)
{
    $request->validate([
        'comment' => 'nullable|string|max:500',
        'parent_id' => 'nullable|exists:comments,id',
        'type' => 'required|in:text,gift,sticker,gif',
        'attachment' => 'nullable|string',
    ]);

    if ($request->type === 'text' && empty(trim($request->comment))) {
        return response()->json(['success' => false, 'message' => 'Komentar tidak boleh kosong.'], 422);
    }

    // Tentukan body berdasarkan tipe input
    $body = $request->comment;
    if ($request->type === 'gift') {
        $body = 'Mengirim sebuah Hadiah 🎁';
    } elseif ($request->type === 'sticker') {
        $body = 'Mengirim sebuah Stiker ✨';
    } elseif ($request->type === 'gif') {
        $body = 'Mengirim sebuah GIF 🎬';
    }

    $comment = $project->comments()->create([
        'user_id' => auth()->id(),
        'parent_id' => $request->parent_id,
        'body' => $body,
        'type' => $request->type,
        'attachment' => $request->attachment,
    ]);

    $user = auth()->user();

    return response()->json([
        'success' => true,
        'id' => $comment->id,
        'parent_id' => $comment->parent_id,
        'comment' => $comment->body,
        'type' => $comment->type,
        'attachment' => $comment->attachment,
        'user_name' => $user->name,
        'user_initial' => strtoupper(substr($user->name, 0, 1)),
        'user_avatar' => $user->avatar,
        'created_at' => $comment->created_at->diffForHumans(),
        'total_comments' => $project->comments()->count()
    ]);
}
}