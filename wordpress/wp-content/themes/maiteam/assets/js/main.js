
(function () {
    const header = document.querySelector(".mai-header");
    const slides = document.querySelectorAll(".mai-hero-slide");
    const navLinks = document.querySelectorAll('.mai-navigation a[href^="#"], .mai-logo[href^="#"]');
    const sections = [
        { id: "home", el: document.getElementById("home") },
        { id: "mai-about", el: document.getElementById("mai-about") },
        { id: "mai-projects", el: document.getElementById("mai-projects") },
        { id: "mai-languages", el: document.getElementById("mai-languages") },
        { id: "contact", el: document.getElementById("contact") }
    ];

    function scrollToSection(id) {
        const section = document.getElementById(id);

        if (!section) {
            return;
        }

        section.scrollIntoView({
            behavior: "smooth",
            block: "start"
        });
    }

    function setActiveNav(id) {
        document.querySelectorAll(".mai-navigation a").forEach(function (link) {
            const href = link.getAttribute("href") || "";
            const hash = href.indexOf("#");
            const target = hash >= 0 ? href.slice(hash + 1) : href;
            link.classList.toggle("is-active", target === id);
        });
    }

    function updateHeaderState() {
        if (header) {
            header.classList.toggle("is-scrolled", window.scrollY > 40);
        }

        let current = "home";

        sections.forEach(function (section) {
            if (!section.el) {
                return;
            }

            const marker = window.scrollY + 280;

            if (marker >= section.el.offsetTop) {
                current = section.id;
            }
        });

        setActiveNav(current);
    }

    document.addEventListener("click", function (event) {
        const link = event.target.closest('a[href^="#"]');

        if (!link || !header || !header.contains(link)) {
            return;
        }

        const id = (link.getAttribute("href") || "").replace("#", "");

        if (!id) {
            return;
        }

        event.preventDefault();
        closeMemberView();
        scrollToSection(id);
        setActiveNav(id);
        history.replaceState(null, "", "#" + id);
    });

    window.addEventListener("scroll", updateHeaderState, { passive: true });
    updateHeaderState();

    function toggleCard(card) {
        if (card.dataset.flipping === "true") {
            return;
        }

        card.dataset.flipping = "true";

        const hanger = card.closest(".mai-hanger");

        if (hanger) {
            hanger.classList.add("is-paused");
        }

        card.classList.toggle("is-flipped");

        setTimeout(function () {
            card.dataset.flipping = "false";

            if (hanger && !card.classList.contains("is-flipped")) {
                hanger.classList.remove("is-paused");
            }
        }, 800);
    }

    document.querySelectorAll(".mai-id-card").forEach(function (card) {
        const photo = card.querySelector(".mai-card-photo");

        if (photo) {
            bindFlashlight(photo, false);
        }

        card.addEventListener("click", function (event) {
            if (event.target.closest("a")) {
                return;
            }

            toggleCard(card);
        });

        card.addEventListener("keydown", function (event) {
            if (event.key === "Enter" || event.key === " ") {
                event.preventDefault();
                toggleCard(card);
            }
        });
    });

    const cardWraps = document.querySelectorAll(".mai-card-wrap");
    const aboutSection = document.getElementById("mai-about");
    const introCover = document.getElementById("maiteam-cover");

    function introIsBlocking() {
        return !!(introCover && introCover.style.pointerEvents !== "none");
    }

    function resetCardDrop() {
        if (!aboutSection || !aboutSection.classList.contains("cards-started")) {
            return;
        }

        aboutSection.classList.remove("cards-started");

        cardWraps.forEach(function (wrap) {
            wrap.classList.remove("is-visible", "is-settled");

            wrap.querySelectorAll(".mai-id-card").forEach(function (card) {
                card.classList.remove("is-flipped", "is-flipping");
                card.dataset.flipping = "false";
            });

            wrap.querySelectorAll(".mai-hanger").forEach(function (hanger) {
                hanger.classList.remove("is-paused");
            });

            void wrap.offsetWidth;
        });
    }

    function startCardDrop() {
        if (!aboutSection || aboutSection.classList.contains("cards-started")) {
            return;
        }

        aboutSection.classList.add("cards-started");

        cardWraps.forEach(function (wrap) {
            wrap.classList.remove("is-visible", "is-settled");
            void wrap.offsetWidth;
            wrap.classList.add("is-visible");
        });
    }

    function aboutIsInView() {
        if (!aboutSection) {
            return false;
        }

        const rect = aboutSection.getBoundingClientRect();
        const viewport = window.innerHeight || document.documentElement.clientHeight;

        return rect.top < viewport * 0.82 && rect.bottom > 140;
    }

    function aboutIsFullyAway() {
        if (!aboutSection) {
            return true;
        }

        const rect = aboutSection.getBoundingClientRect();
        const viewport = window.innerHeight || document.documentElement.clientHeight;

        return rect.top > viewport - 40 || rect.bottom < 80;
    }

    function syncCardAnimation() {
        if (introIsBlocking() || document.body.classList.contains("mai-member-open")) {
            return;
        }

        if (aboutIsInView()) {
            startCardDrop();
            return;
        }

        if (aboutIsFullyAway()) {
            resetCardDrop();
        }
    }

    cardWraps.forEach(function (wrap) {
        wrap.addEventListener("animationend", function (event) {
            if (event.animationName === "maiBounceIn") {
                wrap.classList.add("is-settled");
            }
        });
    });

    function watchAboutOnScroll() {
        syncCardAnimation();
        window.addEventListener("scroll", syncCardAnimation, { passive: true });
    }

    if (cardWraps.length) {
        if (introIsBlocking()) {
            const introWatch = setInterval(function () {
                if (!introIsBlocking()) {
                    clearInterval(introWatch);
                    watchAboutOnScroll();
                }
            }, 200);
        } else {
            watchAboutOnScroll();
        }
    }

    if (slides.length >= 2) {
        let current = 0;

        setInterval(function () {
            slides[current].classList.remove("is-active");
            current = (current + 1) % slides.length;
            slides[current].classList.add("is-active");
        }, 5000);
    }

    const memberOverlay = document.getElementById("mai-member-overlay");
    const memberPanels = document.querySelectorAll(".mai-member");

    function getLikedMap(slug) {
        try {
            return JSON.parse(localStorage.getItem("maiteam-hearts-" + slug) || "{}") || {};
        } catch (error) {
            return {};
        }
    }

    function bindFavFan(panel) {
        const fan = panel.querySelector(".mai-fav-fan");

        if (!fan) {
            return;
        }

        const cards = fan.querySelectorAll(".mai-fav-card");
        const caption = panel.querySelector(".mai-fav-caption");

        function clearChosen() {
            cards.forEach(function (card) {
                card.classList.remove("is-chosen");
            });

            if (caption) {
                caption.textContent = "";
            }
        }

        const observer = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    fan.classList.toggle("is-fanned", entry.isIntersecting);

                    if (!entry.isIntersecting) {
                        clearChosen();
                    }
                });
            },
            {
                root: memberOverlay || null,
                threshold: 0.38
            }
        );

        observer.observe(fan);

        cards.forEach(function (card) {
            card.addEventListener("click", function (event) {
                if (event.target.closest(".mai-heart")) {
                    return;
                }

                fan.classList.add("is-fanned");

                const already = card.classList.contains("is-chosen");
                clearChosen();

                if (!already) {
                    card.classList.add("is-chosen");

                    if (caption) {
                        const label = card.querySelector("span");
                        caption.textContent = label ? label.textContent : "";
                    }
                }
            });
        });
    }

    function bindHearts(panel) {
        const slug = panel.dataset.member || "member";
        const liked = getLikedMap(slug);

        panel.querySelectorAll(".mai-heart").forEach(function (button) {
            const id = button.dataset.heart;

            if (liked[id]) {
                button.classList.add("is-liked");
                button.setAttribute("aria-pressed", "true");
            }

            button.addEventListener("click", function () {
                const nextLiked = getLikedMap(slug);
                const isLiked = button.classList.toggle("is-liked");
                button.setAttribute("aria-pressed", isLiked ? "true" : "false");
                nextLiked[id] = isLiked;
                localStorage.setItem("maiteam-hearts-" + slug, JSON.stringify(nextLiked));
            });
        });
    }

    function bindPillNav(panel) {
        const pillLinks = panel.querySelectorAll('.mai-pill-nav a[href^="#"]');

        function setActivePill(id) {
            pillLinks.forEach(function (link) {
                const target = (link.getAttribute("href") || "").replace("#", "");
                link.classList.toggle("is-active", target === id);
            });
        }

        function updatePillNav() {
            const scrollTop = memberOverlay && !memberOverlay.hidden
                ? memberOverlay.scrollTop
                : window.scrollY;
            const marker = scrollTop + 180;
            let current = "";

            pillLinks.forEach(function (link, index) {
                const id = (link.getAttribute("href") || "").replace("#", "");
                const section = document.getElementById(id);

                if (section && section.offsetTop <= marker) {
                    current = id;
                } else if (index === 0 && !current) {
                    current = id;
                }
            });

            if (current) {
                setActivePill(current);
            }
        }

        pillLinks.forEach(function (link) {
            link.addEventListener("click", function (event) {
                const id = (link.getAttribute("href") || "").replace("#", "");
                const section = document.getElementById(id);

                if (!section) {
                    return;
                }

                event.preventDefault();
                section.scrollIntoView({ behavior: "smooth", block: "start" });
                setActivePill(id);
            });
        });

        const scrollTarget = memberOverlay || window;
        scrollTarget.addEventListener("scroll", updatePillNav, { passive: true });
        updatePillNav();
    }

    let overlayCloseTimer = 0;

    function openMemberView(slug, originEvent) {
        if (!memberOverlay || !slug) {
            return;
        }

        let found = false;

        memberPanels.forEach(function (panel) {
            const active = panel.dataset.member === slug;
            panel.classList.toggle("is-active", active);

            if (active) {
                found = true;
            }
        });

        if (!found) {
            return;
        }

        window.clearTimeout(overlayCloseTimer);

        const x = originEvent && typeof originEvent.clientX === "number"
            ? originEvent.clientX
            : window.innerWidth / 2;
        const y = originEvent && typeof originEvent.clientY === "number"
            ? originEvent.clientY
            : window.innerHeight / 2;

        memberOverlay.hidden = false;
        memberOverlay.classList.remove("is-open", "is-leaving");
        memberOverlay.scrollTop = 0;
        document.body.classList.add("mai-member-open");

        const overlayRect = memberOverlay.getBoundingClientRect();
        memberOverlay.style.setProperty("--ox", (x - overlayRect.left) + "px");
        memberOverlay.style.setProperty("--oy", (y - overlayRect.top) + "px");

        void memberOverlay.offsetWidth;

        requestAnimationFrame(function () {
            memberOverlay.classList.add("is-open");
            window.setTimeout(syncScrollAppears, 80);
        });

        if (header) {
            header.classList.add("is-scrolled");
        }
    }

    function closeMemberView() {
        if (!memberOverlay || memberOverlay.hidden) {
            return;
        }

        if (memberOverlay.classList.contains("is-leaving")) {
            return;
        }

        memberOverlay.classList.remove("is-open");
        memberOverlay.classList.add("is-leaving");

        overlayCloseTimer = window.setTimeout(function () {
            memberOverlay.hidden = true;
            memberOverlay.classList.remove("is-leaving");
            document.body.classList.remove("mai-member-open");

            memberPanels.forEach(function (panel) {
                panel.classList.remove("is-active");
            });
        }, 520);
    }

    function bindFlashlight(frame, tilt) {
        const head = frame.querySelector(".mai-portrait-head");

        if (!frame || !head) {
            return;
        }

        const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

        frame.addEventListener("mousemove", function (event) {
            const rect = frame.getBoundingClientRect();
            const x = (event.clientX - rect.left) / rect.width;
            const y = (event.clientY - rect.top) / rect.height;

            frame.classList.add("is-hovering");
            frame.style.setProperty("--mx", (event.clientX - rect.left) + "px");
            frame.style.setProperty("--my", (event.clientY - rect.top) + "px");

            if (tilt && !reduceMotion) {
                frame.style.transform =
                    "rotateY(" + ((x - 0.5) * 16).toFixed(2) + "deg) rotateX(" + ((0.5 - y) * 12).toFixed(2) + "deg)";
            }

            head.classList.add("is-on");
        });

        frame.addEventListener("mouseleave", function () {
            frame.classList.remove("is-hovering");

            if (tilt) {
                frame.style.transform = "";
            }

            head.classList.remove("is-on");
        });
    }

    function bindPortraitHover(panel) {
        const portrait = panel.querySelector(".mai-member-portrait");

        if (portrait) {
            bindFlashlight(portrait, true);
        }
    }

    function bindOneOnlyHearts(panel) {
        const frame = panel.querySelector(".mai-one-only-frame");
        const layer = panel.querySelector(".mai-one-hearts");

        if (!frame || !layer) {
            return;
        }

        const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
        let lastSpawn = 0;

        function spawnHeart(x, y) {
            if (reduceMotion) {
                return;
            }

            const now = Date.now();

            if (now - lastSpawn < 70) {
                return;
            }

            lastSpawn = now;

            const heart = document.createElement("span");
            const size = 28 + Math.random() * 22;
            const drift = Math.round(Math.random() * 56 - 28);

            heart.className = "mai-float-heart";
            heart.textContent = "♥";
            heart.style.left = x + "px";
            heart.style.top = y + "px";
            heart.style.fontSize = size + "px";
            heart.style.setProperty("--drift", drift + "px");
            layer.appendChild(heart);

            heart.addEventListener("animationend", function () {
                heart.remove();
            });
        }

        function pointInFrame(clientX, clientY) {
            const rect = frame.getBoundingClientRect();
            return {
                x: clientX - rect.left,
                y: clientY - rect.top
            };
        }

        frame.addEventListener("mousemove", function (event) {
            const point = pointInFrame(event.clientX, event.clientY);
            frame.classList.add("is-hovering");
            spawnHeart(point.x, point.y);
        });

        frame.addEventListener("mouseleave", function () {
            frame.classList.remove("is-hovering");
        });

        frame.addEventListener("touchstart", function (event) {
            if (!event.touches.length) {
                return;
            }

            const point = pointInFrame(event.touches[0].clientX, event.touches[0].clientY);
            frame.classList.add("is-hovering");
            spawnHeart(point.x, point.y);
        }, { passive: true });

        frame.addEventListener("touchmove", function (event) {
            if (!event.touches.length) {
                return;
            }

            const point = pointInFrame(event.touches[0].clientX, event.touches[0].clientY);
            spawnHeart(point.x, point.y);
        }, { passive: true });

        frame.addEventListener("touchend", function () {
            frame.classList.remove("is-hovering");
        });
    }

    memberPanels.forEach(function (panel) {
        bindHearts(panel);
        bindFavFan(panel);
        bindPillNav(panel);
        bindPortraitHover(panel);
        bindOneOnlyHearts(panel);
    });

    document.querySelectorAll(".mai-more-info").forEach(function (link) {
        link.addEventListener("click", function (event) {
            if (!memberOverlay) {
                return;
            }

            event.preventDefault();
            event.stopPropagation();
            openMemberView(link.dataset.member, event);
        });
    });

    document.querySelectorAll(".mai-member-back").forEach(function (button) {
        button.addEventListener("click", function () {
            if (memberOverlay) {
                closeMemberView();
                scrollToSection("mai-about");
                setActiveNav("mai-about");
                return;
            }

            window.location.href = button.getAttribute("data-return") || "/";
        });
    });

    const appearNodes = [];

    function addAppear(el, root, tilt) {
        if (!el || el.classList.contains("mai-appear")) {
            return;
        }

        el.classList.add("mai-appear");

        if (tilt) {
            el.classList.add("mai-appear-tilt");
        }

        const siblings = el.parentElement
            ? el.parentElement.querySelectorAll(".mai-appear")
            : [];
        let index = 0;

        siblings.forEach(function (sibling, siblingIndex) {
            if (sibling === el) {
                index = siblingIndex;
            }
        });

        el.style.setProperty("--appear-delay", Math.min(index, 6) * 0.07 + "s");

        el.addEventListener("animationend", function (event) {
            if (event.target === el && (event.animationName === "mai-rise" || event.animationName === "mai-portrait-in")) {
                el.classList.add("is-settled");
            }
        });

        appearNodes.push({ el: el, root: root || null });
    }

    document.querySelectorAll(".mai-hero-content > *, .mai-about-heading > *, .mai-projects-heading > *, .mai-languages-heading > *, .mai-contact-heading > *, .mai-contact-form-title, .mai-contact-form .mai-field, .mai-contact-send, .mai-contact-side > .mai-eyebrow, .mai-contact-side-copy, .mai-social, .mai-contact-write, .mai-contact-people > li, .mai-footer-container > *").forEach(function (el) {
        addAppear(el, null, false);
    });

    document.querySelectorAll(".mai-member-section").forEach(function (section) {
        const root = section.closest("#mai-member-overlay") || null;

        section.querySelectorAll(":scope > .mai-eyebrow, :scope > h1, :scope > h2, :scope > .mai-member-role, :scope > .mai-member-dreams, :scope > .mai-school-list, :scope > .mai-fav-fan, :scope > .mai-fav-caption, :scope > .mai-one-hint, :scope > .mai-one-only").forEach(function (el) {
            addAppear(el, root, false);
        });

        section.querySelectorAll(".mai-member-portrait").forEach(function (el) {
            addAppear(el, root, true);
        });

        section.querySelectorAll(".mai-member-details li").forEach(function (el) {
            addAppear(el, root, false);
        });
    });

    function appearRootIsActive(root) {
        if (!root) {
            return !introIsBlocking();
        }

        return root.classList.contains("is-open") && !root.hidden;
    }

    function elementIsInView(el, root) {
        const rect = el.getBoundingClientRect();
        const bounds = root ? root.getBoundingClientRect() : {
            top: header ? header.getBoundingClientRect().bottom : 0,
            bottom: window.innerHeight || document.documentElement.clientHeight
        };
        const visibleTop = Math.max(rect.top, bounds.top);
        const visibleBottom = Math.min(rect.bottom, bounds.bottom);
        const visible = Math.max(0, visibleBottom - visibleTop);
        const height = Math.max(rect.height, 1);

        return visible > Math.min(height * 0.2, 64) && rect.bottom > bounds.top + 16 && rect.top < bounds.bottom - 8;
    }

    function syncScrollAppears() {
        appearNodes.forEach(function (item) {
            const canShow = appearRootIsActive(item.root) && elementIsInView(item.el, item.root);

            if (canShow) {
                if (!item.el.classList.contains("is-in")) {
                    item.el.classList.add("is-in");
                }
            } else if (item.el.classList.contains("is-in") || item.el.classList.contains("is-settled")) {
                item.el.classList.remove("is-in", "is-settled");
            }
        });
    }

    window.addEventListener("scroll", syncScrollAppears, { passive: true });

    if (memberOverlay) {
        memberOverlay.addEventListener("scroll", syncScrollAppears, { passive: true });
    }

    window.addEventListener("resize", syncScrollAppears);

    if (introIsBlocking()) {
        const appearWatch = setInterval(function () {
            if (!introIsBlocking()) {
                clearInterval(appearWatch);
                syncScrollAppears();
            }
        }, 200);
    } else {
        syncScrollAppears();
    }

    const projectCarousel = document.querySelector(".mai-project-carousel");

    if (projectCarousel) {
        const projectSlides = Array.prototype.slice.call(projectCarousel.querySelectorAll(".mai-project-slide"));
        const projectZoom = document.querySelector(".mai-project-zoom");
        const projectFrame = projectZoom ? projectZoom.querySelector(".mai-project-zoom-frame") : null;
        let projectIndex = 0;

        function placeProjects() {
            projectSlides.forEach(function (slide, slideIndex) {
                const delta = (slideIndex - projectIndex + projectSlides.length) % projectSlides.length;

                slide.classList.remove("is-active", "is-prev", "is-next", "is-hidden");

                if (delta === 0) {
                    slide.classList.add("is-active");
                } else if (delta === 1) {
                    slide.classList.add("is-next");
                } else if (delta === projectSlides.length - 1) {
                    slide.classList.add("is-prev");
                } else {
                    slide.classList.add("is-hidden");
                }
            });

            if (projectZoom && !projectZoom.hidden) {
                fillProjectZoom();
            }
        }

        function stepProjects(direction) {
            const travel = direction > 0 ? "next" : "prev";

            projectCarousel.dataset.dir = travel;

            if (projectZoom) {
                projectZoom.dataset.dir = travel;
            }

            projectIndex = (projectIndex + direction + projectSlides.length) % projectSlides.length;
            placeProjects();
        }

        function nudgeArrow(button) {
            button.classList.remove("is-pressed");
            void button.offsetWidth;
            button.classList.add("is-pressed");
        }

        function fillProjectZoom() {
            const slide = projectSlides[projectIndex];
            const visual = slide.querySelector(".mai-project-shot, .mai-project-coming");

            if (!projectFrame || !visual) {
                return;
            }

            projectFrame.classList.remove("is-switching");
            void projectFrame.offsetWidth;
            projectFrame.classList.add("is-switching");
            projectFrame.innerHTML = "";
            projectFrame.appendChild(visual.cloneNode(true));

            const description = document.createElement("aside");
            const eyebrow = document.createElement("p");
            const title = document.createElement("h3");
            const body = document.createElement("p");

            description.className = "mai-project-description";
            eyebrow.className = "mai-eyebrow";
            body.className = "mai-project-description-body";
            eyebrow.textContent = slide.getAttribute("data-label") || "";
            title.textContent = slide.getAttribute("data-title") || "";
            body.textContent = slide.getAttribute("data-description") || "";
            description.appendChild(eyebrow);
            description.appendChild(title);
            description.appendChild(body);
            projectFrame.appendChild(description);
        }

        function openProjectZoom(slideIndex) {
            if (!projectZoom) {
                return;
            }

            projectIndex = slideIndex;
            placeProjects();
            projectZoom.hidden = false;
            document.body.classList.add("mai-project-zoomed");
            fillProjectZoom();
        }

        function closeProjectZoom() {
            if (!projectZoom) {
                return;
            }

            projectZoom.hidden = true;
            document.body.classList.remove("mai-project-zoomed");
        }

        projectCarousel.querySelectorAll(".mai-project-arrow").forEach(function (button) {
            button.addEventListener("click", function () {
                nudgeArrow(button);
                stepProjects(button.classList.contains("is-next") ? 1 : -1);
            });
        });

        projectSlides.forEach(function (slide) {
            slide.addEventListener("click", function () {
                openProjectZoom(Number(slide.getAttribute("data-index")));
            });
        });

        if (projectZoom) {
            projectZoom.querySelectorAll("[data-zoom-step]").forEach(function (button) {
                button.addEventListener("click", function () {
                    nudgeArrow(button);
                    stepProjects(Number(button.getAttribute("data-zoom-step")));
                });
            });

            const backdrop = projectZoom.querySelector(".mai-project-zoom-backdrop");

            if (backdrop) {
                backdrop.addEventListener("click", closeProjectZoom);
            }
        }

        document.addEventListener("keydown", function (event) {
            if (!projectZoom || projectZoom.hidden) {
                return;
            }

            if (event.key === "Escape") {
                closeProjectZoom();
            }

            if (event.key === "ArrowRight") {
                stepProjects(1);
            }

            if (event.key === "ArrowLeft") {
                stepProjects(-1);
            }
        });

        placeProjects();
    }

    const languageList = document.querySelector(".mai-language-list");

    if (languageList) {
        const languageCards = Array.prototype.slice.call(languageList.querySelectorAll(".mai-language"));
        const scatter = [
            [-240, -150, -18],
            [120, -190, 16],
            [280, -30, -12],
            [-190, 70, 22],
            [40, 180, -16],
            [230, 140, 11],
            [-260, 30, -8],
            [170, -80, 20],
            [-50, 210, -22],
            [300, 90, 9]
        ];
        const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
        let align = reducedMotion ? 1 : 0;

        function scatterScale() {
            return Math.max(0.45, Math.min(1, window.innerWidth / 1100));
        }

        function easeInOut(value) {
            return value < 0.5
                ? 4 * value * value * value
                : 1 - Math.pow(-2 * value + 2, 3) / 2;
        }

        function targetAlign() {
            const rect = languageList.getBoundingClientRect();
            const start = window.innerHeight * 0.96;
            const end = window.innerHeight * 0.38;
            const raw = (start - rect.top) / (start - end);

            return easeInOut(Math.max(0, Math.min(1, raw)));
        }

        function paintLanguages(progress) {
            const scale = scatterScale();

            languageCards.forEach(function (card, index) {
                const lead = index * 0.055;
                const cardAlign = Math.max(0, Math.min(1, (progress - lead) / (1 - lead)));
                const point = scatter[index] || [0, 0, 0];

                card.style.setProperty("--align", cardAlign.toFixed(4));
                card.style.setProperty("--scatter-x", (point[0] * scale).toFixed(1) + "px");
                card.style.setProperty("--scatter-y", (point[1] * scale).toFixed(1) + "px");
                card.style.setProperty("--scatter-r", String(point[2]));
            });
        }

        languageCards.forEach(function (card) {
            const face = card.querySelector(".mai-language-face");

            if (!face) {
                return;
            }

            face.addEventListener("pointermove", function (event) {
                const rect = face.getBoundingClientRect();
                const x = ((event.clientX - rect.left) / rect.width) * 100;
                const y = ((event.clientY - rect.top) / rect.height) * 100;

                face.style.setProperty("--glow-x", x.toFixed(2) + "%");
                face.style.setProperty("--glow-y", y.toFixed(2) + "%");
            });

            face.addEventListener("click", function () {
                openLanguage(face);
            });
        });

        const languageZoom = document.querySelector(".mai-language-zoom");
        const languageZoomTitle = languageZoom ? languageZoom.querySelector("h3") : null;
        const languageZoomText = languageZoom ? languageZoom.querySelector(".mai-language-zoom-text") : null;
        const languageZoomCard = languageZoom ? languageZoom.querySelector(".mai-language-zoom-card") : null;
        let languageOrigin = null;
        let languageClosing = false;

        function finishLanguageClose() {
            languageClosing = false;

            if (!languageZoom) {
                return;
            }

            languageZoom.hidden = true;
            document.body.classList.remove("mai-language-zoomed");

            if (languageZoomCard) {
                languageZoomCard.style.transition = "none";
                languageZoomCard.style.transform = "none";
            }
        }

        function placeLanguageCard(face, towardFront) {
            if (!languageZoomCard || !face) {
                return;
            }

            const from = face.getBoundingClientRect();

            languageZoomCard.style.transition = "none";
            languageZoomCard.style.transform = "none";

            const to = languageZoomCard.getBoundingClientRect();
            const scale = Math.max(from.width / Math.max(to.width, 1), 0.2);
            const dx = (from.left + from.width / 2) - (to.left + to.width / 2);
            const dy = (from.top + from.height / 2) - (to.top + to.height / 2);
            const atCard = "translate(" + dx.toFixed(1) + "px, " + dy.toFixed(1) + "px) scale(" + scale.toFixed(3) + ")";
            const atFront = "translate(0, 0) scale(1)";

            languageZoomCard.style.transform = towardFront ? atCard : atFront;

            if (reducedMotion) {
                languageZoomCard.style.transform = atFront;
                return;
            }

            void languageZoomCard.offsetWidth;
            languageZoomCard.style.transition = towardFront
                ? "transform 0.55s cubic-bezier(0.22, 1, 0.36, 1)"
                : "transform 0.9s cubic-bezier(0.4, 0, 0.2, 1)";
            languageZoomCard.style.transform = towardFront ? atFront : atCard;
        }

        function openLanguage(face) {
            if (!languageZoom || !languageZoomTitle || !languageZoomText) {
                return;
            }

            languageOrigin = face;
            languageZoomTitle.textContent = face.getAttribute("data-name") || "";
            languageZoomText.textContent = face.getAttribute("data-text") || "";
            languageZoom.hidden = false;
            languageZoom.classList.remove("is-open");
            document.body.classList.add("mai-language-zoomed");
            placeLanguageCard(face, true);
            void languageZoom.offsetWidth;
            languageZoom.classList.add("is-open");
        }

        function closeLanguage() {
            if (!languageZoom || languageZoom.hidden || languageClosing) {
                return;
            }

            languageZoom.classList.remove("is-open");

            if (!languageZoomCard || !languageOrigin || reducedMotion) {
                finishLanguageClose();
                return;
            }

            languageClosing = true;
            placeLanguageCard(languageOrigin, false);

            function done(event) {
                if (event && event.propertyName && event.propertyName !== "transform") {
                    return;
                }

                languageZoomCard.removeEventListener("transitionend", done);
                finishLanguageClose();
            }

            languageZoomCard.addEventListener("transitionend", done);
            window.setTimeout(function () {
                if (languageClosing) {
                    done();
                }
            }, 1000);
        }

        if (languageZoom) {
            const languageBackdrop = languageZoom.querySelector(".mai-language-zoom-backdrop");

            if (languageBackdrop) {
                languageBackdrop.addEventListener("click", closeLanguage);
            }
        }

        document.addEventListener("keydown", function (event) {
            if (event.key === "Escape") {
                closeLanguage();
            }
        });

        paintLanguages(align);

        if (!reducedMotion) {
            let lastFrame = performance.now();

            function followLanguageAlign(now) {
                const target = targetAlign();
                const dt = Math.min(0.05, (now - lastFrame) / 1000);
                const liningUp = target >= align;
                const follow = liningUp ? 1 / (0.3 + 0.2) : 1 / 0.3;

                lastFrame = now;
                align += (target - align) * Math.min(1, follow * dt);

                if (Math.abs(target - align) < 0.0015) {
                    align = target;
                }

                paintLanguages(align);
                requestAnimationFrame(followLanguageAlign);
            }

            requestAnimationFrame(followLanguageAlign);
        }
    }

    const contactDrawer = document.querySelector(".mai-contact-drawer");
    let contactDrawerTimer = 0;

    function fillContactDrawer(button) {
        const name = button.getAttribute("data-name") || "";
        const role = button.getAttribute("data-role") || "";
        const phone = button.getAttribute("data-phone") || "";
        const email = button.getAttribute("data-email") || "";
        const portrait = button.getAttribute("data-portrait") || "";
        const more = button.getAttribute("data-more") || "#";
        const photo = contactDrawer.querySelector(".mai-contact-drawer-photo");
        const phoneLink = contactDrawer.querySelector(".mai-contact-drawer-phone");
        const emailLink = contactDrawer.querySelector(".mai-contact-drawer-email");

        contactDrawer.querySelector("#mai-contact-drawer-name").textContent = name;
        contactDrawer.querySelector(".mai-contact-drawer-role").textContent = role;
        photo.src = portrait;
        photo.alt = name;
        phoneLink.textContent = phone;
        phoneLink.href = "tel:" + phone.replace(/[^\d+]/g, "");
        emailLink.textContent = email;
        emailLink.href = "mailto:" + email;
        contactDrawer.querySelector(".mai-contact-drawer-more").href = more;
    }

    function openContactDrawer(button) {
        if (!contactDrawer) {
            return;
        }

        window.clearTimeout(contactDrawerTimer);
        fillContactDrawer(button);
        contactDrawer.hidden = false;
        document.body.classList.add("mai-contact-open");
        window.requestAnimationFrame(function () {
            contactDrawer.classList.add("is-open");
        });
    }

    function closeContactDrawer() {
        if (!contactDrawer || contactDrawer.hidden) {
            return;
        }

        contactDrawer.classList.remove("is-open");
        document.body.classList.remove("mai-contact-open");
        contactDrawerTimer = window.setTimeout(function () {
            contactDrawer.hidden = true;
        }, 420);
    }

    document.querySelectorAll(".mai-contact-person").forEach(function (button) {
        button.addEventListener("click", function () {
            openContactDrawer(button);
        });
    });

    if (contactDrawer) {
        contactDrawer.querySelector(".mai-contact-drawer-backdrop").addEventListener("click", closeContactDrawer);
        contactDrawer.querySelector(".mai-contact-drawer-close").addEventListener("click", closeContactDrawer);
    }

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            closeContactDrawer();
        }
    });

    const contactForm = document.querySelector(".mai-contact-form");

    if (contactForm) {
        const contactNote = contactForm.querySelector(".mai-contact-note");

        contactForm.addEventListener("submit", function (event) {
            event.preventDefault();

            const name = (contactForm.querySelector('[name="name"]').value || "").trim();
            const email = (contactForm.querySelector('[name="email"]').value || "").trim();
            const message = (contactForm.querySelector('[name="message"]').value || "").trim();
            const emailOk = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

            contactForm.querySelectorAll(".mai-field").forEach(function (field) {
                const input = field.querySelector("input, textarea");
                const value = (input.value || "").trim();
                const invalid = input.type === "email" ? !emailOk : value === "";
                field.classList.toggle("is-invalid", invalid);
            });

            if (!name || !emailOk || !message) {
                contactNote.hidden = false;
                contactNote.textContent = "Add your name, a real email, and a short message.";
                return;
            }

            const mail = contactForm.getAttribute("data-mail") || "";
            const subject = encodeURIComponent("Hello from " + name);
            const body = encodeURIComponent(message + "\n\n" + name + "\n" + email);

            contactNote.hidden = false;
            contactNote.textContent = "Your email app should open with this message ready to send.";
            window.location.href = "mailto:" + mail + "?subject=" + subject + "&body=" + body;
        });
    }
})();
