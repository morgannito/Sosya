.PHONY: help build up down restart logs shell composer-install db-migrate db-create clean

# Couleurs pour la sortie
GREEN  := $(shell tput -Txterm setaf 2)
YELLOW := $(shell tput -Txterm setaf 3)
WHITE  := $(shell tput -Txterm setaf 7)
RESET  := $(shell tput -Txterm sgr0)

help: ## Afficher cette aide
	@echo ''
	@echo 'Utilisation:'
	@echo '  ${YELLOW}make${RESET} ${GREEN}<target>${RESET}'
	@echo ''
	@echo 'Targets:'
	@awk 'BEGIN {FS = ":.*?## "} { \
		if (/^[a-zA-Z_-]+:.*?##.*$$/) {printf "    ${YELLOW}%-20s${GREEN}%s${RESET}\n", $$1, $$2} \
		else if (/^## .*$$/) {printf "  ${WHITE}%s${RESET}\n", substr($$1,4)} \
		}' $(MAKEFILE_LIST)

build: ## Construire les images Docker
	docker compose build --no-cache

up: ## Démarrer les conteneurs
	docker compose up -d
	@echo "${GREEN}Application démarrée sur http://localhost:8080${RESET}"

down: ## Arrêter les conteneurs
	docker compose down

restart: down up ## Redémarrer les conteneurs

logs: ## Afficher les logs
	docker compose logs -f

shell: ## Ouvrir un shell dans le conteneur PHP
	docker compose exec php sh

shell-nginx: ## Ouvrir un shell dans le conteneur Nginx
	docker compose exec nginx sh

composer-install: ## Installer les dépendances Composer
	docker compose exec php composer install

composer-update: ## Mettre à jour les dépendances Composer
	docker compose exec php composer update

db-create: ## Créer la base de données
	docker compose exec php php bin/console doctrine:database:create --if-not-exists

db-migrate: ## Exécuter les migrations
	docker compose exec php php bin/console doctrine:migrations:migrate --no-interaction

db-fixtures: ## Charger les fixtures
	docker compose exec php php bin/console doctrine:fixtures:load --no-interaction

cache-clear: ## Vider le cache
	docker compose exec php php bin/console cache:clear

test: ## Exécuter les tests
	docker compose exec php php bin/phpunit

clean: ## Nettoyer les conteneurs, volumes et images
	docker compose down -v
	docker system prune -f

init: build up composer-install db-create db-migrate ## Initialisation complète du projet
	@echo "${GREEN}Projet initialisé avec succès!${RESET}"
	@echo "${GREEN}Accédez à l'application sur http://localhost:8080${RESET}"
