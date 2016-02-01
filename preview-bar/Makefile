.PHONY: build css js

build: css js

css:
	compass compile --force
	cd stylesheets/ ; \
	postcss --use autoprefixer --replace style.css ; \
	cssnano style.css style.min.css --no-zindex

js:
	cd js/ ; \
	uglifyjs -c -m -o main.min.js main.js
