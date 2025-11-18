#!/bin/bash

# Couleurs
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${YELLOW}📦 Démarrage de l'application Symfony avec Docker${NC}\n"

# Vérifier que nous sommes dans le bon répertoire
if [ ! -f "Dockerfile" ]; then
    echo -e "${RED}❌ Erreur: Dockerfile non trouvé${NC}"
    echo -e "${YELLOW}💡 Assurez-vous d'être dans le répertoire du projet${NC}"
    exit 1
fi

# Copier le fichier .env.docker vers .env.local s'il n'existe pas
if [ ! -f ".env.local" ]; then
    echo -e "${YELLOW}📝 Création de .env.local depuis .env.docker${NC}"
    cp .env.docker .env.local
fi

# Construire les images
echo -e "${YELLOW}🔨 Construction des images Docker...${NC}"
docker compose build

# Démarrer les conteneurs
echo -e "${YELLOW}🚀 Démarrage des conteneurs...${NC}"
docker compose up -d

# Attendre que les conteneurs soient prêts
echo -e "${YELLOW}⏳ Attente du démarrage des services...${NC}"
sleep 5

# Installer les dépendances
echo -e "${YELLOW}📦 Installation des dépendances Composer...${NC}"
docker compose exec -T php composer install

# Créer la base de données
echo -e "${YELLOW}🗄️  Création de la base de données...${NC}"
docker compose exec -T php php bin/console doctrine:database:create --if-not-exists || true

# Exécuter les migrations
echo -e "${YELLOW}🔄 Exécution des migrations...${NC}"
docker compose exec -T php php bin/console doctrine:migrations:migrate --no-interaction || true

echo -e "\n${GREEN}✅ Application démarrée avec succès!${NC}\n"
echo -e "${GREEN}🌐 Accédez à l'application :${NC}"
echo -e "   - Application web : ${YELLOW}http://localhost:8080${NC}"
echo -e "   - Interface mail : ${YELLOW}http://localhost:8025${NC}\n"
echo -e "${YELLOW}📋 Commandes utiles :${NC}"
echo -e "   - Voir les logs : ${GREEN}docker compose logs -f${NC}"
echo -e "   - Arrêter : ${GREEN}docker compose down${NC}"
echo -e "   - Shell PHP : ${GREEN}docker compose exec php sh${NC}"
echo -e "   - Ou utilisez : ${GREEN}make help${NC}\n"
