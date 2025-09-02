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
 * Settings for the confetti plugin
 *
 * @package    local_confetti
 * @copyright  2025 Odei Alba <odeialba@odeialba.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) { // Needs this condition or there is an error on login page.
    // Create the new settings page - make sure we use proper section names as per documentation
    $settings = new admin_settingpage('local_confetti', get_string('pluginname', 'local_confetti'));
    $ADMIN->add('localplugins', $settings);

    // Add settings section header.
    $settings->add(new admin_setting_heading(
        'local_confetti/settingsheader',
        get_string('settingsheader', 'local_confetti'),
        get_string('settingsdescription', 'local_confetti')
    ));

    // Add first checkbox setting - Enable on frontpage.
    $settings->add(new admin_setting_configcheckbox(
        'local_confetti/enableonfrontpage',
        get_string('enableonfrontpage', 'local_confetti'),
        get_string('enableonfrontpage_desc', 'local_confetti'),
        0 // Default value (0 = unchecked, 1 = checked).
    ));

    // Add second checkbox setting - Enable on course completion.
    $settings->add(new admin_setting_configcheckbox(
        'local_confetti/enableoncoursecompletion',
        get_string('enableoncoursecompletion', 'local_confetti'),
        get_string('enableoncoursecompletion_desc', 'local_confetti'),
        1 // Default value (0 = unchecked, 1 = checked).
    ));

    // Add third checkbox setting - Enable on successful login.
    $settings->add(new admin_setting_configcheckbox(
        'local_confetti/enableonlogin',
        get_string('enableonlogin', 'local_confetti'),
        get_string('enableonlogin_desc', 'local_confetti'),
        0 // Default value (0 = unchecked, 1 = checked).
    ));
}
