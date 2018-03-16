# GET ENVIRONMENT VARIABLES

#include .env

# INSTALL

env:
	cp .env.example .env
	@echo '✅ .env file copied'

## clean - Clean the project to remove demo assets.
clean:
	rm -rf bin/.gitkeep
	rm -rf db/.gitkeep
	rm -rf docs/.gitkeep
	rm -rf public/css/style.css
	rm -rf public/img/.gitkeep
	rm -rf public/js/application.min.js
	rm -rf resources/assets/css/style.scss
	rm -rf resources/assets/js/scripts.js
	rm -rf resources/lang/.gitkeep
	rm -rf resources/views/includes/head.html
	rm -rf resources/views/layouts/default.html
	rm -rf resources/views/mail/.gitkeep
	rm -rf resources/views/index.html
	rm -rf src/Controllers/ExampleController.php
	rm -rf src/Helpers/.gitkeep
	rm -rf src/Middlewares/ExampleMiddleware.php
	rm -rf src/Models/.gitkeep
	rm -rf src/tests/HomepageTest.php
	rm -rf tmp/logs/.gitkeep
	rm -rf tmp/views/.gitkeep
	@echo '✅ Example files cleaned'

# SERVE

## serve - Start a simple php server.
serve:
	php -S 0.0.0.0:8080 -t public

## debug - Start a php server using xdebug.
debug:
	php -S 0.0.0.0:8080 -t public -ddisplay_errors=1 -dzned_extension=xdebug.so

# TESTS

## test-unit - Launch tests.
test-unit: vendor/bin/phpunit

# SITEMAP

## sitemap - Create a sitemap.
sitemap:
	curl $(APP_URL)/sitemap/create
	@echo '✅ Sitemap created'

# ASSETS (CSS AND JS FILES)

# Assets configuration (folders and files)
# CSS
CSS_FOLDER = public/assets/css
CSS_FILES = $(CSS_FOLDER)/style.css
CSS_TEMP = $(CSS_FOLDER)/style.css
CSS_FINAL = $(CSS_FOLDER)/style.min.css
# JS
JS_FOLDER = resources/assets/js
JS_FOLDER_PUBLIC = public/assets/js
JS_FILES = $(JS_FOLDER)/scripts.js
JS_TEMP = $(JS_FOLDER_PUBLIC)/scripts.js
JS_FINAL = $(JS_FOLDER_PUBLIC)/scripts.min.js

# sass - Convert saas files to css files.
sass:
	sass resources/assets/saas/style.scss public/assets/css/style.css
	@echo '✅ Saas files converted to CSS files'

# move-js - Move js files in public folder.
move-js:
	cp $(JS_FILES) $(JS_TEMP)

# CONCAT

## concat-css - Concat css files.
concat-css:
	cat $(CSS_FILES) > $(CSS_TEMP)
	@echo '✅ Css files concatenated'

## concat-js - Concat js files.
concat-js:
	cat $(JS_FILES) > $(JS_TEMP)
	@echo '✅ Js files concatenated'

# MINIFY

## minify-css - Minifies CSS.
minify-css:
	curl -X POST -s --data-urlencode 'input@$(CSS_TEMP)' https://cssminifier.com/raw > $(CSS_FINAL)
	rm -rf $(CSS_TEMP)
	@echo '✅ CSS files minified'

## minify-js - Minifies JS.
minify-js:
	curl -X POST -s --data-urlencode 'input@$(JS_TEMP)' https://javascript-minifier.com/raw > $(JS_FINAL)
	rm -rf $(JS_TEMP)
	@echo '✅ JS files minified'

# ASSETS (CSS + JS) OPTIMISATION

## optimize-css - Concat and minify css files.
# optimize-css: sass concat-css minify-css
optimize-css: sass minify-css
	@echo '✅ CSS files optimized'

## optimize-js - Concat js files.
# optimize-js: move-js concat-js minify-js
optimize-js: move-js minify-js
	@echo '✅ JS files optimized'

## optimize - Optimize assets files.
optimize: optimize-css optimize-js
	@echo '✅ Assets files optimized'

# HELP

## help - Displays help.
help:
	@fgrep -h "## " $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/## //'
