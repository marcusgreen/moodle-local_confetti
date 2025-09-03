<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Event observer for Confetti plugin
 *
 * @package    local_confetti
 * @copyright  2025 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_confetti;
/**
 * Event observer class for Confetti plugin
 *
 * @package    local_confetti
 * @copyright  2025 Odei Alba <odeialba@odeialba.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class observer {
    /**
     * Callback function to trigger confetti when a user logs in
     *
     * @param \core\event\user_loggedin $event The event object
     * @return bool True on success
     */
    public static function confetti_callback() {
        global $SESSION;

        if (get_config('local_confetti', 'enableonfrontpage') != 1) {
            return false;
        }

        $SESSION->throw_confetti = true;

        return true;
    }
}
