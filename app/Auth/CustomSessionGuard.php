<?php

namespace App\Auth;

use Illuminate\Auth\SessionGuard;
use Illuminate\Contracts\Auth\Authenticatable;

class CustomSessionGuard extends SessionGuard
{
    /**
     * Override logout method to avoid cookie jar errors
     *
     * @return void
     */
    public function logout()
    {
        $user = $this->user();

        // Clear out user session data
        $this->clearUserDataFromStorage();

        // Reset the user without relying on cookie jar
        $this->user = null;

        // Clear remember me token if we have a user
        if ($user) {
            try {
                $this->cycleRememberToken($user);
            } catch (\Exception $e) {
                // Ignore any errors with cookie jar
            }
        }

        // Fire the logout event
        if (isset($this->events)) {
            $this->events->dispatch('auth.logout', [$user]);
        }
    }

    /**
     * Override getCookieJar to avoid throwing error when not set
     *
     * @return \Illuminate\Contracts\Cookie\QueueingFactory|null
     */
    public function getCookieJar()
    {
        try {
            return parent::getCookieJar();
        } catch (\RuntimeException $e) {
            // Return null if cookie jar isn't set
            return null;
        }
    }
}
