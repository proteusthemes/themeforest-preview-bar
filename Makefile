.PHONY: deploy

deploy:
	git checkout production
	git merge master --no-edit
	git push
	git checkout master