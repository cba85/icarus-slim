# INSTALL

copy-env:
	cp .env.example .env

## clean - Clean the project to remove demo assets.
clean:
	@echo 'clean'

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

# GET ENVIRONNEMENT VARIABLE

#include .env

# SITEMAP

## sitemap - Create a sitemap.
sitemap:
	curl $(APP_URL)/sitemap/create

# CSS

# Assets folders
CSS_FOLDER = public/assets/css
JS_FOLDER = public/assets/js

# Patterns matching CSS files that should be minified. Files with a -min.css
# suffix will be ignored.
CSS_FILES = $(filter-out %.min.css,$(wildcard \
	$(CSS_FOLDER)/*.css \
))

# Patterns matching JS files that should be minified. Files with a -min.js
# suffix will be ignored.
JS_FILES = $(filter-out %.min.js,$(wildcard \
	$(JS_FOLDER)/*.js \
))

# Commands
CSS_MINIFIER = curl -X POST -s --data-urlencode 'input@CSS_TMP' https://cssminifier.com/raw
JS_MINIFIER = curl -X POST -s --data-urlencode 'input@JS_TMP' https://javascript-minifier.com/raw

CSS_MINIFIED = $(CSS_FILES:.css=.min.css)
JS_MINIFIED = $(JS_FILES:.js=.min.js)

## minify - Minifies CSS and JS.
minify: minify-css minify-js

## minify-css - Minifies CSS.
minify-css: $(CSS_FILES) $(CSS_MINIFIED)

## minify-js - Minifies JS.
minify-js: $(JS_FILES) $(JS_MINIFIED)

%.min.css: %.css
	@echo '  Minifying $< ==> $@'
	$(subst CSS_TMP,$(<),$(CSS_MINIFIER)) > $@
	@echo

%.min.js: %.js
	@echo '  Minifying $< ==> $@'
	$(subst JS_TMP,$(<),$(JS_MINIFIER)) > $@
	@echo

## minify-clean - Removes minified CSS and JS files.
minify-clean:
	rm -f $(CSS_MINIFIED) $(JS_MINIFIED)

# CONCAT

# JS files
JS_FINAL = $(JS_FOLDER)/application.min.js

JS_TARGETS = $(JS_FOLDER)/scripts.min.js \
             $(JS_FOLDER)/test.min.js

$(JS_FINAL): $(JS_MINIFIED)
	cat $^ >$@
	rm -f $^

## concat-js - Concat js files.
concat-js: $(JS_FINAL)

# CSS files
CSS_FINAL = $(CSS_FOLDER)/application.min.css
CSS_TARGETS = $(CSS_FOLDER)/style.min.css \
              $(CSS_FOLDER)/test.min.css

$(CSS_FINAL): $(CSS_TARGETS)
	cat $^ >$@
	rm -f $(CSS_TARGETS)

## concat-css - Concat css files.
concat-css: $(CSS_FINAL)

# Concat all

## concat - Concat assets.
concat: $(JS_FINAL) $(CSS_FINAL)

# HELP

## help - Displays help.
help:
	@fgrep -h "## " $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/## //'
