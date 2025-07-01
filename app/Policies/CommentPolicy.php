<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function view(User $user, Comment $comment): bool
    {
        return true; // Anyone can view comments
    }

    public function create(User $user): bool
    {
        return true; // Any authenticated user can comment
    }

    public function update(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id;
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id || $user->is_admin;
    }

    public function approve(User $user): bool
    {
        return $user->is_admin;
    }
}