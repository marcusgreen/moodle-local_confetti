/**
 * Confetti animation module
 *
 * @module     local_confetti/confetti
 * @copyright  2025 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import confettilib from './confettilib';

export const init = () => {
        window.console.log('Confetti init');
        confettilib();
        window.console.log('Confetti done');
};
