# Guide Docker pour Symfony

Ce projet est configuré pour fonctionner avec Docker et Docker Compose.

## Prérequis

- Docker
- Docker Compose
- Make (optionnel, pour utiliser le Makefile)

## Architecture

L'application est composée de 3 services principaux :

- **nginx** : Serveur web (port 8080)
- **php** : PHP-FPM 8.2 avec Symfony 7.1
- **database** : PostgreSQL 16
- **mailer** : Mailpit (interface web sur le port 8025)

## Démarrage rapide

### Avec Make (recommandé)

```bash
# Initialisation complète du projet (build + install + migrations)
make init

# Ou étape par étape :
make build          # Construire les images
make up             # Démarrer les conteneurs
make composer-install  # Installer les dépendances
make db-create      # Créer la base de données
make db-migrate     # Exécuter les migrations
```

### Sans Make

```bash
# Construire les images
docker compose build

# Démarrer les conteneurs
docker compose up -d

# Installer les dépendances
docker compose exec php composer install

# Créer la base de données
docker compose exec php php bin/console doctrine:database:create

# Exécuter les migrations
docker compose exec php php bin/console doctrine:migrations:migrate
```

## Commandes utiles

### Via Make

```bash
make help           # Afficher toutes les commandes disponibles
make up             # Démarrer les conteneurs
make down           # Arrêter les conteneurs
make restart        # Redémarrer les conteneurs
make logs           # Afficher les logs
make shell          # Ouvrir un shell dans le conteneur PHP
make cache-clear    # Vider le cache Symfony
make test           # Exécuter les tests
make clean          # Nettoyer complètement (conteneurs + volumes)
```

### Via Docker Compose

```bash
# Voir les logs
docker compose logs -f

# Exécuter une commande Symfony
docker compose exec php php bin/console [commande]

# Accéder au shell du conteneur PHP
docker compose exec php sh

# Accéder au shell de la base de données
docker compose exec database psql -U app -d app
```

## Configuration

### Variables d'environnement

Pour utiliser Docker, copiez le fichier `.env.docker` vers `.env.local` :

```bash
cp .env.docker .env.local
```

### Ports utilisés

- **8080** : Application web (Nginx)
- **5432** : PostgreSQL (non exposé par défaut)
- **8025** : Interface Mailpit
- **1025** : SMTP Mailpit

## Accès à l'application

Une fois les conteneurs démarrés :

- Application : http://localhost:8080
- Interface mail (Mailpit) : http://localhost:8025

## Développement

### Installation de nouvelles dépendances

```bash
docker compose exec php composer require [package]
```

### Créer une nouvelle migration

```bash
docker compose exec php php bin/console make:migration
docker compose exec php php bin/console doctrine:migrations:migrate
```

### Vider le cache

```bash
docker compose exec php php bin/console cache:clear
```

## Production

Pour la production, vous devrez :

1. Modifier le `Dockerfile` pour optimiser l'image
2. Changer `APP_ENV=prod` dans le fichier `.env`
3. Utiliser des secrets sécurisés
4. Configurer un reverse proxy (Traefik, Nginx, etc.)
5. Mettre en place SSL/TLS

## Dépannage

### Les conteneurs ne démarrent pas

```bash
# Vérifier les logs
docker compose logs

# Reconstruire les images
docker compose build --no-cache
```

### Problèmes de permissions

```bash
# Donner les bonnes permissions au dossier var/
sudo chown -R $USER:$USER var/
chmod -R 775 var/
```

### Base de données non accessible

```bash
# Vérifier que le conteneur database est bien démarré
docker compose ps

# Vérifier les logs de la base de données
docker compose logs database
```

## Nettoyage

Pour tout nettoyer (conteneurs, volumes, images non utilisées) :

```bash
make clean
# ou
docker compose down -v
docker system prune -f
```
