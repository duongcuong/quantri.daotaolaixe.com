const mix = require("laravel-mix");

mix.js("vuejs/vue.js", "public/js")
    .vue()
    .postCss("vuejs/css/vue.css", "public/css", []);
