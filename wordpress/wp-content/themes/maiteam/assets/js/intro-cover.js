
(function () {
    const cover = document.getElementById("maiteam-cover");
    const loader = document.getElementById("maiteam-loader");

    if (!cover || !loader) return;
    if (cover.dataset.initialized === "true") return;
    cover.dataset.initialized = "true";

    let progress = 0;
    let targetProgress = 0;
    let ready = false;
    let animationFrame = null;

    let upwardGestures = 0;
    let lastGestureTime = 0;

    let touchStartY = 0;
    let touchStartTime = 0;
    let touchReturnGestures = 0;
    let touchLastGestureTime = 0;

    const smoothness = 0.075;
    const scrollSensitivity = 0.0012;
    const gestureDelay = 350;

    function lockPage() {
        document.documentElement.style.overflow = "hidden";
        document.body.style.overflow = "hidden";
    }

    function unlockPage() {
        document.documentElement.style.overflow = "";
        document.body.style.overflow = "";
    }

    function animate() {
        const difference = targetProgress - progress;

        progress += difference * smoothness;

        if (Math.abs(difference) < 0.0005) {
            progress = targetProgress;
        }

        cover.style.transform = "translate3d(0," + (-progress * 100) + "%,0)";
        cover.style.pointerEvents = progress >= 0.999 ? "none" : "auto";

        if (progress >= 0.999) {
            unlockPage();
        } else {
            lockPage();
        }

        if (progress !== targetProgress) {
            animationFrame = requestAnimationFrame(animate);
        } else {
            animationFrame = null;
        }
    }

    function updateTarget(value) {
        targetProgress = Math.max(0, Math.min(1, value));

        if (animationFrame === null) {
            animationFrame = requestAnimationFrame(animate);
        }
    }

    function startCoverAgain() {
        upwardGestures = 0;
        touchReturnGestures = 0;
        updateTarget(0.88);
    }

    lockPage();

    window.addEventListener("load", function () {
        setTimeout(function () {
            loader.classList.add("done");

            setTimeout(function () {
                cover.classList.add("intro-start");
                ready = true;
            }, 650);
        }, 1500);
    });

    window.addEventListener("wheel", function (e) {
        if (!ready) return;

        if (e.deltaY > 0 && targetProgress < 1) {
            e.preventDefault();
            upwardGestures = 0;
            updateTarget(targetProgress + e.deltaY * scrollSensitivity);
            return;
        }

        if (e.deltaY < 0 && targetProgress < 1) {
            e.preventDefault();
            updateTarget(targetProgress + e.deltaY * scrollSensitivity);
            return;
        }

        if (e.deltaY < 0 && targetProgress >= 1 && window.scrollY <= 0) {
            e.preventDefault();

            const now = Date.now();

            if (now - lastGestureTime > gestureDelay) {
                upwardGestures++;
                lastGestureTime = now;
            }

            if (upwardGestures >= 3) {
                startCoverAgain();
            }
        }
    }, { passive: false });

    window.addEventListener("touchstart", function (e) {
        if (!e.touches.length) return;

        touchStartY = e.touches[0].clientY;
        touchStartTime = Date.now();
    }, { passive: true });

    window.addEventListener("touchend", function (e) {
        if (!ready) return;

        const changed = e.changedTouches[0];
        if (!changed) return;

        const distance = changed.clientY - touchStartY;
        const duration = Date.now() - touchStartTime;

        if (
            distance > 35 &&
            targetProgress >= 1 &&
            window.scrollY <= 0 &&
            duration < 1200
        ) {
            const now = Date.now();

            if (now - touchLastGestureTime > gestureDelay) {
                touchReturnGestures++;
                touchLastGestureTime = now;
            }

            if (touchReturnGestures >= 3) {
                startCoverAgain();
            }
        }
    }, { passive: true });

    window.addEventListener("touchmove", function (e) {
        if (!ready || !e.touches.length) return;

        const currentY = e.touches[0].clientY;
        const movement = touchStartY - currentY;

        touchStartY = currentY;

        if (movement > 0 && targetProgress < 1) {
            e.preventDefault();
            updateTarget(targetProgress + movement * 0.003);
            return;
        }

        if (movement < 0 && targetProgress < 1) {
            e.preventDefault();
            updateTarget(targetProgress + movement * 0.003);
        }
    }, { passive: false });

    window.addEventListener("keydown", function (e) {
        if (!ready) return;

        if (["ArrowDown", "PageDown", " "].includes(e.key) && targetProgress < 1) {
            e.preventDefault();
            updateTarget(targetProgress + 0.15);
        }

        if (["ArrowUp", "PageUp"].includes(e.key) && targetProgress < 1) {
            e.preventDefault();
            updateTarget(targetProgress - 0.15);
        }

        if (["ArrowUp", "PageUp"].includes(e.key) && targetProgress >= 1 && window.scrollY <= 0) {
            e.preventDefault();
            upwardGestures++;

            if (upwardGestures >= 3) {
                startCoverAgain();
            }
        }
    });
})();
