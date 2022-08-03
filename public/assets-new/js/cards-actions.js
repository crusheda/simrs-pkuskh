"use strict";
!function() {
    const e = [].slice.call(document.querySelectorAll(".card-collapsible"))
      , l = [].slice.call(document.querySelectorAll(".card-expand"))
      , s = [].slice.call(document.querySelectorAll(".card-close"));
    var t = document.getElementById("sortable-4");
    e && e.map(function(l) {
        l.addEventListener("click", e=>{
            e.preventDefault(),
            new bootstrap.Collapse(l.closest(".card").querySelector(".collapse")),
            l.closest(".card-header").classList.toggle("collapsed"),
            Helpers._toggleClass(l.firstElementChild, "bx-chevron-down", "bx-chevron-up")
        }
        )
    }),
    l && l.map(function(l) {
        l.addEventListener("click", e=>{
            e.preventDefault(),
            Helpers._toggleClass(l.firstElementChild, "bx-fullscreen", "bx-exit-fullscreen"),
            l.closest(".card").classList.toggle("card-fullscreen")
        }
        )
    }),
    document.addEventListener("keyup", e=>{
        if (e.preventDefault(),
        "Escape" === e.key) {
            const l = document.querySelector(".card-fullscreen");
            l && (Helpers._toggleClass(l.querySelector(".card-expand").firstChild, "bx-fullscreen", "bx-exit-fullscreen"),
            l.classList.toggle("card-fullscreen"))
        }
    }
    ),
    s && s.map(function(l) {
        l.addEventListener("click", e=>{
            // e.preventDefault(),
            // l.closest(".card").classList.add("d-none")
        }
        )
    }),
    null !== t && Sortable.create(t, {
        animation: 500,
        handle: ".card"
    })
}(),
$(function() {
    const e = $(".card-reload");
    e.length && e.on("click", function(e) {
        e.preventDefault();
        var l = $(this);
        l.closest(".card").block({
            message: '<div class="sk-fold sk-primary"><div class="sk-fold-cube"></div><div class="sk-fold-cube"></div><div class="sk-fold-cube"></div><div class="sk-fold-cube"></div></div><h5>LOADING...</h5>',
            css: {
                backgroundColor: "transparent",
                border: "0"
            },
            overlayCSS: {
                backgroundColor: $("html").hasClass("dark-style") ? "#000" : "#fff",
                opacity: .55
            }
        }),
        setTimeout(function() {
            l.closest(".card").unblock(),
            l.closest(".card").find(".card-alert").length && l.closest(".card").find(".card-alert").html('<div class="alert alert-info alert-dismissible fade show" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button><strong>Yeayy!</strong> Reload berhasil</div>')
        }, 2500)
    })
});
