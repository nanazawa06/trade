const mix = require('laravel-mix');
mix.js("resources/js/app.js", "public/js")
    .js("resources/js/show.js", "public/js")
    .js("resources/js/deal.js", "public/js")
    .autoload( {"jquery": [ '$', 'window.jQuery' ]})
    .sass('resources/sass/app.scss', 'public/css')
  .postCss("resources/css/app.css", "public/css", [
	      require("tailwindcss"),
	    ]);

