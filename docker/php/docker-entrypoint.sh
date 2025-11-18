#!/bin/sh
set -e

# Couleurs pour les logs
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo "${GREEN}🚀 Démarrage du conteneur PHP-FPM${NC}"

# Attendre que la base de données soit prête
if [ "$DATABASE_URL" ]; then
    echo "${YELLOW}⏳ Attente de la base de données...${NC}"
    until php -r "new PDO('$DATABASE_URL');" 2>/dev/null; do
        echo "${YELLOW}⏳ Base de données non disponible - attente...${NC}"
        sleep 2
    done
    echo "${GREEN}✅ Base de données prête!${NC}"
fi

# Créer les répertoires nécessaires s'ils n'existent pas
mkdir -p var/cache var/log var/sessions

# Fixer les permissions
echo "${YELLOW}🔧 Configuration des permissions...${NC}"
chown -R www-data:www-data var/
chmod -R 775 var/

# Vider le cache en développement
if [ "$APP_ENV" = "dev" ]; then
    echo "${YELLOW}🧹 Nettoyage du cache...${NC}"
    php bin/console cache:clear --no-warmup
    php bin/console cache:warmup
fi

echo "${GREEN}✅ Initialisation terminée!${NC}"

# Exécuter la commande passée au conteneur (par défaut php-fpm)
exec "$@"
