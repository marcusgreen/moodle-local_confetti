/**
 * Confetti preview module
 *
 * @module     local_confetti/preview
 * @copyright  2025 Odei Alba <odeialba@odeialba.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
import {throwConfetti} from './confetti';

/**
 * Initialize the preview button
 *
 * @method init
 */
export const init = () => {
    const previewButton = document.getElementById('local_confetti_preview_button');

    if (previewButton) {
        previewButton.addEventListener('click', (e) => {
            e.preventDefault();
            const selectedPreset = document.getElementsByName('s_local_confetti_confettipreset')[0].value;
            window.console.log('Selected preset:', selectedPreset);
            throwConfetti(selectedPreset);
        });
    }

};
