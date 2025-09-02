/**
 * Confetti animation module
 *
 * @module     local_confetti/confetti
 * @copyright  2025 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import confetti from './confetti/confetti';

export const init = () => {
        window.console.log('Confetti init');
        confetti();
        window.console.log('Confetti done');
};
