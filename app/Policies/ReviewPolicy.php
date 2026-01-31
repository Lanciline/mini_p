<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;

class ReviewPolicy
{
    public function moderate(User $user, Review $review)
    {
        return ($user->is_admin ?? false);
    }
}
