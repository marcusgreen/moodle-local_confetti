/**
 * Confetti preview module
 *
 * @module     local_confetti/preview
 * @copyright  2025 Odei Alba <odeialba@odeialba.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

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
            // Dispatch a custom event that your colleague can listen for
            const presetSelect = document.getElementById('id_s_local_confetti_confettipreset');
            const preset = presetSelect ? presetSelect.value : 'basic';

            // Create and dispatch custom event with the preset information
            const previewEvent = new CustomEvent('local_confetti:preview', {
                bubbles: true,
                detail: {
                    preset: preset
                }
            });

            document.dispatchEvent(previewEvent);

            // Log for debugging
            window.console.log('Confetti preview requested for preset:', preset);
        });
    }
};
