default: help

run_in_docker=docker run -v `pwd`:/opt/project zerosuxx/php-dev:latest

help: ## This help message
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' -e 's/:.*#/: #/' | column -t -s '##'

install: ## Install dependencies
	composer install

docker-install: ## Install dependencies in docker
	$(run_in_docker) composer install

test: ## Run tests
	composer test

docker-test: ## Run tests in docker
	$(run_in_docker) composer test
