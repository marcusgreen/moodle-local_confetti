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
 * Confetti animation module
 *
 * @module     local_confetti/confetti
 * @copyright  2025 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import confetti from './confetti/confetti';

export const init = () => {
        fire(0.25, {
                spread: 26,
                startVelocity: 55,
        });
        fire(0.2, {
                spread: 60,
        });
        fire(0.35, {
                spread: 100,
                decay: 0.91,
                scalar: 0.8
        });
        fire(0.1, {
                spread: 120,
                startVelocity: 25,
                decay: 0.92,
                scalar: 1.2
        });
        fire(0.1, {
                spread: 120,
                startVelocity: 45,
        });
        snow();
};

var count = 200;
var defaults = {
  origin: { y: 0.7 }
};

export const fire = (particleRatio, opts) => {
  confetti({
    ...defaults,
    ...opts,
    particleCount: Math.floor(count * particleRatio)
  });
};
export const randomInRange = (min, max) => {
        return Math.random() * (max - min) + min;
};
export const snow = () => {
        var duration = 2 * 1000;
        var animationEnd = Date.now() + duration;
        var skew = 1;

        (function frame() {
                var timeLeft = animationEnd - Date.now();
                var ticks = Math.max(200, 500 * (timeLeft / duration));
                skew = Math.max(0.8, skew - 0.001);

                confetti({
                        particleCount: 1,
                        startVelocity: 0,
                        ticks: ticks,
                        origin: {
                                x: Math.random(),
                                // since particles fall down, skew start toward the top
                                y: (Math.random() * skew) - 0.2
                        },
                        colors: [
                                '#26ccff',
                                '#a25afd',
                                '#ff5e7e',
                                '#88ff5a',
                                '#fcff42',
                                '#ffa62d',
                                '#ff36ff'
                        ],
                        shapes: ['circle'],
                        gravity: randomInRange(0.4, 0.6),
                        scalar: randomInRange(0.4, 1),
                        drift: randomInRange(-0.4, 0.4)
                });

                if (timeLeft > 0) {
                        requestAnimationFrame(frame);
                }
        }());
};