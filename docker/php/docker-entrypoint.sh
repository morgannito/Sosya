#!/bin/sh
set -e

# Couleurs pour les logs
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo "${GREEN}🚀 Démarrage du conteneur${NC}"

# Configurer le port nginx depuis la variable d'environnement PORT (pour Render, Heroku, etc.)
if [ -n "$PORT" ] && [ -f "/etc/nginx/http.d/default.conf" ]; then
    echo "${YELLOW}🔧 Configuration du port nginx: $PORT${NC}"
    sed -i "s/listen 8080;/listen $PORT;/g" /etc/nginx/http.d/default.conf
fi

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

# Fixer les permissions (seulement si on a les droits)
echo "${YELLOW}🔧 Configuration des permissions...${NC}"
if [ "$(id -u)" = "0" ]; then
    # On est root, on peut changer les permissions
    chown -R www-data:www-data var/ 2>/dev/null || true
    chmod -R 775 var/ 2>/dev/null || true
else
    # On n'est pas root, on fait juste chmod sur ce qu'on peut
    chmod -R 775 var/ 2>/dev/null || true
fi

# Vider le cache en développement
if [ "$APP_ENV" = "dev" ]; then
    echo "${YELLOW}🧹 Nettoyage du cache...${NC}"
    php bin/console cache:clear --no-warmup
    php bin/console cache:warmup
fi

echo "${GREEN}✅ Initialisation terminée!${NC}"

# Exécuter la commande passée au conteneur (par défaut supervisord)
exec "$@"
