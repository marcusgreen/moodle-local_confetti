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
        throwConfetti('realistic');
};

export const throwConfetti = (preset) => {
        if (preset === 'realistic') {
                realisticConfetti();
        } else if (preset === 'fireworks') {
                fireworksConfetti();
        } else if (preset === 'snow') {
                snowConfetti();
        } else if (preset === 'school') {
                schoolConfetti();
        } else if (preset === 'emoji') {
                customConfetti('🦄');
        } else if (preset === 'text') {
                customConfetti('You passed!!!');
        } else {
                confetti();
        }
};

export const realisticConfetti = () => {
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
};

export const fireworksConfetti = () => {
        var duration = 15 * 1000;
        var animationEnd = Date.now() + duration;
        var defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

        var interval = setInterval(function () {
                var timeLeft = animationEnd - Date.now();

                if (timeLeft <= 0) {
                        return clearInterval(interval);
                }

                var particleCount = 50 * (timeLeft / duration);
                // since particles fall down, start a bit higher than random
                confetti({ ...defaults, particleCount, origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 } });
                confetti({ ...defaults, particleCount, origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 } });
        }, 250);
};

export const snowConfetti = () => {
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
                                '#26ccff'
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

export const schoolConfetti = () => {
        var end = Date.now() + (15 * 1000);

        // go Buckeyes!
        var colors = ['#bb0000', '#ffffff'];

        (function frame() {
                confetti({
                        particleCount: 2,
                        angle: 60,
                        spread: 55,
                        origin: { x: 0 },
                        colors: colors
                });
                confetti({
                        particleCount: 2,
                        angle: 120,
                        spread: 55,
                        origin: { x: 1 },
                        colors: colors
                });

                if (Date.now() < end) {
                        requestAnimationFrame(frame);
                }
        }());
};

export const customConfetti = (content) => {
        setTimeout(shoot(content), 0);
        setTimeout(shoot(content), 100);
        setTimeout(shoot(content), 200);
};

export const fire = (particleRatio, opts) => {
        var count = 200;
        var defaults = {
                origin: { y: 0.7 }
        };
        confetti({
                ...defaults,
                ...opts,
                particleCount: Math.floor(count * particleRatio)
        });
};

export const randomInRange = (min, max) => {
        return Math.random() * (max - min) + min;
};

export const shoot = (emoji) => {
        var scalar = 2;
        var unicorn = confetti.shapeFromText({ text: emoji, scalar });

        var defaults = {
                spread: 360,
                ticks: 60,
                gravity: 0,
                decay: 0.96,
                startVelocity: 20,
                shapes: [unicorn],
                scalar
        };

        confetti({
                ...defaults,
                particleCount: 30
        });

        confetti({
                ...defaults,
                particleCount: 5,
                flat: true
        });

        confetti({
                ...defaults,
                particleCount: 15,
                scalar: scalar / 2,
                shapes: ['circle']
        });
};
