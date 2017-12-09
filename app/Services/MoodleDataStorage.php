<?php

namespace App\Services;

use App\Models\User;
use App\Models\DB\User as DBUser;

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

        $dbUser = DBUser::updateOrCreate(
            ['user_name' => $user->username],
            ['user_name' => $user->username, 'site_id' => $siteID]
        );

        return $dbUser->user_id;

    }

}