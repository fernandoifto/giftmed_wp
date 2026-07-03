/**
 * GiftMed Tema — interações leves da home.
 */
(function () {
	"use strict";

	document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
		anchor.addEventListener("click", function (event) {
			var id = this.getAttribute("href");
			if (!id || id === "#") {
				return;
			}

			var target = document.querySelector(id);
			if (!target) {
				return;
			}

			event.preventDefault();
			target.scrollIntoView({ behavior: "smooth", block: "start" });
		});
	});
})();
