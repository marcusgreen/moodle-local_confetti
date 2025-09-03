/**
 * Confetti preview module
 *
 * @module     local_confetti/preview
 * @copyright  2025 Odei Alba <odeialba@odeialba.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
import {throwConfetti} from './confetti';

export const init = (js_settings) => {
    window.console.log(js_settings.enablesound);
    let enableSound = js_settings.enablesound;
    const previewButton = document.getElementById('local_confetti_preview_button');

    if (previewButton) {
        previewButton.addEventListener('click', (e) => {
            e.preventDefault();
            const selectedPreset = document.getElementsByName('s_local_confetti_confettipreset')[0].value;
            const customText = document.getElementsByName('s_local_confetti_confettitext')[0].value;

            window.console.log('Selected preset:', selectedPreset);
            throwConfetti({ preset: selectedPreset, text: customText, enablesound: enableSound });
        });
    }

};
