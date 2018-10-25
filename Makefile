default: help

help: ## This help message
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' -e 's/:.*#/: #/' | column -t -s '##'

install: ## Install dependencies
	composer install

docker-install: ## Install dependencies in docker
	bash -c "`awk 'match($$0, /docker-test\": \".*\"/) { print substr($$0, RSTART+15, RLENGTH-16) }' composer.json`"

tst: ## Run tests
	composer test

docker-tst: ## Run tests in docker
	composer docker-test