/**
 * GiftMed Tema — scroll reveal, menu mobile e micro-interações.
 */
(function () {
	"use strict";

	var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

	/* Sticky header shadow */
	var header = document.querySelector(".gm-header");
	if (header) {
		var onScroll = function () {
			header.classList.toggle("is-scrolled", window.scrollY > 8);
		};
		onScroll();
		window.addEventListener("scroll", onScroll, { passive: true });
	}

	/* Mobile menu */
	var toggle = document.querySelector(".gm-menu-toggle");
	var mobileNav = document.querySelector(".gm-nav-mobile");
	if (toggle && mobileNav) {
		toggle.addEventListener("click", function () {
			var open = toggle.getAttribute("aria-expanded") === "true";
			toggle.setAttribute("aria-expanded", open ? "false" : "true");
			mobileNav.classList.toggle("is-open", !open);
		});

		mobileNav.querySelectorAll("a").forEach(function (link) {
			link.addEventListener("click", function () {
				toggle.setAttribute("aria-expanded", "false");
				mobileNav.classList.remove("is-open");
			});
		});
	}

	/* Smooth scroll for in-page anchors */
	document.querySelectorAll('a[href*="#"]').forEach(function (anchor) {
		anchor.addEventListener("click", function (event) {
			var href = this.getAttribute("href");
			if (!href) {
				return;
			}

			var hashIndex = href.indexOf("#");
			if (hashIndex === -1) {
				return;
			}

			var id = href.slice(hashIndex);
			if (id === "#") {
				return;
			}

			var target = document.querySelector(id);
			if (!target) {
				return;
			}

			var samePage =
				href.charAt(0) === "#" ||
				this.pathname === window.location.pathname;

			if (!samePage) {
				return;
			}

			event.preventDefault();
			target.scrollIntoView({
				behavior: reduceMotion ? "auto" : "smooth",
				block: "start",
			});
			history.pushState(null, "", id);
		});
	});

	/* Scroll reveal via Intersection Observer */
	var reveals = document.querySelectorAll(".reveal");
	if (!reveals.length) {
		return;
	}

	if (reduceMotion || !("IntersectionObserver" in window)) {
		reveals.forEach(function (el) {
			el.classList.add("is-visible");
		});
		return;
	}

	var observer = new IntersectionObserver(
		function (entries, obs) {
			entries.forEach(function (entry) {
				if (!entry.isIntersecting) {
					return;
				}
				entry.target.classList.add("is-visible");
				obs.unobserve(entry.target);
			});
		},
		{
			threshold: 0.12,
			rootMargin: "0px 0px -40px 0px",
		}
	);

	reveals.forEach(function (el) {
		observer.observe(el);
	});
})();
