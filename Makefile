.DEFAULT_GOAL := help

init:
	bash ./bin/local-init.sh

lint:
	composer run lint

lint-fix:
	composer run lint-fix

shell:
	docker-compose run --rm jroman00_php-coding-standards bash

test:
	composer run test

test-coverage:
	composer run test-coverage

#############################################################
# Help Documentation
#############################################################

help:
	@echo "  Application Commands"
	@echo "  |"
	@echo "  |_ help (default)        - Show this message"
	@echo "  |_ init                  - Initialize the application and all of its dependencies"
	@echo "  |_ lint                  - Run lint checks"
	@echo "  |_ lint-fix              - Run lint checks and fix issues"
	@echo "  |_ shell                 - Start a shell session in a new container"
	@echo "  |_ test                  - Run application tests"
	@echo "  |_ test-coverage         - Run application tests with a coverage report"
	@echo "  |__________________________________________________________________________________________"
	@echo " "

.PHONY:
	init
	lint
	lint-fix
	shell
	test
	test-coverage
