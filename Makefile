.DEFAULT_GOAL := help

.PHONY: help
help: ## Show the help docs (DEFAULT)
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage: make COMMAND\n\nCommands: \033[36m\033[0m\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)

.PHONY: init
init: ## Initialize the application and all of its dependencies
	bash ./bin/local-init.sh

.PHONY: lint
lint: ## Run lint checks
	docker compose run --rm jroman00.php-coding-standards composer run lint

.PHONY: lint-fix
lint-fix: ## Run lint checks and fix issues
	docker compose run --rm jroman00.php-coding-standards composer run lint-fix

.PHONY: shell
shell: ## Start a shell session in a new container
	docker compose run --rm jroman00.php-coding-standards bash

.PHONY: test
test: ## Run applications tests
	docker compose run --rm jroman00.php-coding-standards composer run test

.PHONY: test-coverage
test-coverage: ## Run application tests with a coverage report
	docker compose run --rm jroman00.php-coding-standards composer run test-coverage
