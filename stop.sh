#!/bin/bash

# Couleurs
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${YELLOW}🛑 Arrêt de l'application Docker${NC}\n"

docker compose down

echo -e "\n${GREEN}✅ Application arrêtée${NC}\n"
