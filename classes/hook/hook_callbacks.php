<?php
namespace local_confetti\hook;

use core_user\hook\after_login_completed as after_login_completed_hook;
use core\hook\output\before_http_headers as before_http_headers_hook;

class hook_callbacks {
    /**
     * Called after login is completed.
     *
     * @param after_login_completed_hook $hook
     */
    public static function login_callback(after_login_completed_hook $hook): void {
        global $SESSION, $PAGE;

        error_log('ARO: AFTER LOGIN COMPLETED');
        // Set a flag so we can load JS on the next rendered page.
        $SESSION->local_confetti_afterlogin = true;

        $PAGE->requires->js_call_amd('local_confetti/confetti', 'init');

        error_log('ARO: AFTER JS CALL IN AFTER LOGIN COMPLETED');
    }

    public static function before_http_headers_callback(before_http_headers_hook $hook): void {
        global $PAGE;

        if (!empty($_SESSION['confetti_afterlogin'])) {
            error_log('ARO: BEFORE HTTP HEADERS - SESSION FLAG FOUND');

            unset($_SESSION['confetti_afterlogin']);

            $PAGE->requires->js_call_amd('local_confetti/confetti', 'init');

            error_log('ARO: AFTER JS CALL IN BEFORE HTTP HEADERS');
        } else {
            error_log('ARO: BEFORE HTTP HEADERS - NO SESSION FLAG - NOT LOADING JS');
        }
    }
}
