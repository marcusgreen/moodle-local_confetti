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
 * External API for confetti plugin.
 *
 * @package    local_confetti
 * @copyright  2025 Odei Alba <odeialba@odeialba.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/externallib.php");

/**
 * External API class for confetti plugin.
 *
 * @package    local_confetti
 * @copyright  2025 Odei Alba <odeialba@odeialba.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class local_confetti_external extends external_api {
    /**
     * Returns description of get_settings parameters.
     *
     * @return external_function_parameters
     */
    public static function get_settings_parameters() {
        return new external_function_parameters([]);
    }

    /**
     * Returns description of get_settings return value.
     *
     * @return external_single_structure
     */
    public static function get_settings_returns() {
        return new external_single_structure([
            'confettipreset' => new external_value(PARAM_TEXT, 'Preset style for confetti effect'),
        ]);
    }

    /**
     * Get confetti settings.
     *
     * @return array Settings for confetti
     */
    public static function get_settings() {
        // Get settings from config.
        $confettipreset = get_config('local_confetti', 'confettipreset') ?: 'basic';

        return [
            'confettipreset' => $confettipreset,
        ];
    }
}
