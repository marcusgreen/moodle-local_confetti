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

    // Add first checkbox setting - Enable on frontpage.
    $settings->add(new admin_setting_configcheckbox(
        'local_confetti/displayeverylogin',
        get_string('displayeverylogin', 'local_confetti'),
        get_string('displayeverylogin_desc', 'local_confetti'),
        1 // Default value (0 = unchecked, 1 = checked).
    ));

    // Confetti preset selection
    $confettipresets = [
        'realistic' => get_string('confettipresetrealistic', 'local_confetti'),
        'fireworks' => get_string('confettipresetfireworks', 'local_confetti'),
        'snow' => get_string('confettipresetsnow', 'local_confetti'),
        'school' => get_string('confettipresetschool', 'local_confetti'),
        'emoji' => get_string('confettipresetemoji', 'local_confetti'),
        'text' => get_string('confettipresettext', 'local_confetti')
    ];
    $settings->add(new admin_setting_configselect(
        'local_confetti/confettipreset',
        get_string('confettipreset', 'local_confetti'),
        get_string('confettipreset_desc', 'local_confetti'),
        'realistic', // Default value
        $confettipresets
    ));

    // Add Moodle events section header
    $settings->add(new admin_setting_heading(
        'local_confetti/moodleevents',
        get_string('moodleevents', 'local_confetti'),
        get_string('moodleevents_desc', 'local_confetti')
    ));

    $observeroptions = [];

    include("db/events.php");

    // Copy the $observers array and remove the first element
    $observeroptions = $observers;
    array_shift($observeroptions);

    // Create a new array from $observeroptions in the same format as $eventsoptions
    $observerevents = [];
    foreach ($observeroptions as $observer) {
        $eventname = $observer['eventname'];
        // Extract the last part after the last backslash
        $parts = explode('\\', $eventname);
        $eventkey = end($parts);
        // Convert to lowercase to match eventsoptions format
        $eventkey = strtolower($eventkey);
        // Add to the new array with the event key as the key
        $observerevents[$eventkey] = get_string('event_' . $eventkey, 'local_confetti', $eventkey);
    }

    $settings->add(new admin_setting_configmultiselect(
        'local_confetti/eventselect',
        get_string('eventselect', 'local_confetti'),
        get_string('eventselect_desc', 'local_confetti'),
        [], // Default selection
        $observerevents
    ));

    // Add preview button
    $previewhtml = \core\output\html_writer::start_div('form-item row');
    $previewhtml .= \core\output\html_writer::start_div('form-label col-sm-3');
    $previewhtml .= \core\output\html_writer::tag('label', get_string('previewconfetti', 'local_confetti'));
    $previewhtml .= \core\output\html_writer::end_div();
    $previewhtml .= \core\output\html_writer::start_div('form-setting col-sm-9');
    $previewhtml .= \core\output\html_writer::tag('p', get_string('previewconfetti_desc', 'local_confetti'));
    $previewhtml .= \core\output\html_writer::tag('button', get_string('previewbutton', 'local_confetti'),
        ['id' => 'local_confetti_preview_button', 'class' => 'btn btn-secondary mb-4', 'type' => 'button']);
    $previewhtml .= \core\output\html_writer::end_div();
    $previewhtml .= \core\output\html_writer::end_div();

    $settings->add(new admin_setting_heading(
        'local_confetti/previewheading',
        '',
        $previewhtml
    ));

    // Load the preview JS
    global $PAGE;
    $PAGE->requires->js_call_amd('local_confetti/preview', 'init');
}
