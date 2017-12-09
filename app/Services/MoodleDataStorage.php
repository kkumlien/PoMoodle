<?php

namespace App\Services;

use App\Models\User;
use App\Models\DB\User as DBUser;
use Illuminate\Support\Facades\Log;

/**
 * Stores data from Moodle into our own database
 *
 * Class MoodleDataStorage
 * @package App\Services
 */
class MoodleDataStorage
{

    /**
     * Stores user data from Moodle containing user and course information
     * and returns the user ID
     *
     * @param User $user
     * @param int $siteID
     * @return DBUser/user_id
     */
    public function storeUserData(User $user, $siteID)
    {

        Log::debug("Attempting to create user if it doesn't exist: " . trim($user->username));

        $dbUser = DBUser::firstOrCreate(
            ['user_name' => trim($user->username), 'site_id' => $siteID]
        );

        return $dbUser->user_id;

    }

}