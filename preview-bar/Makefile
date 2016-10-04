.PHONY: build css js

build: css js

css:
	compass compile --force
	cd stylesheets/ ; \
	postcss --use autoprefixer --replace style.css ; \
	postcss --use cssnano -o style.min.css style.css ; \

js:
	cd js/ ; \
	uglifyjs -c -m -o main.min.js main.js
