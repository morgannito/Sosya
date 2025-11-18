# SoSy

## 🚀 Démarrage rapide avec Docker

### Prérequis
- Docker
- Docker Compose

### Installation et démarrage

```bash
# Démarrage automatique (recommandé)
./start.sh

# Ou manuellement avec Make
make init

# Ou avec Docker Compose
docker compose build
docker compose up -d
docker compose exec php composer install
docker compose exec php php bin/console doctrine:database:create
docker compose exec php php bin/console doctrine:migrations:migrate
```

### Accès
- **Application** : http://localhost:8080
- **Interface mail** : http://localhost:8025

### Commandes utiles
```bash
./start.sh          # Démarrer l'application
./stop.sh           # Arrêter l'application
make help           # Voir toutes les commandes Make
docker compose logs -f  # Voir les logs
```

📖 **Documentation complète** : Voir [DOCKER.md](DOCKER.md)

---

## 📖 À propos du projet

Ce projet est le fruit de mon 2 nd stage de mon BTS SIO réalisé chez krypton66.
Il a était realisé en collaboration avec AcensJJ [https://github.com/AcensJJ] (un autre étudiant du BTS et stagiaire).

SoSy est un mixe entre un site de réseaux sociaux et de site de rencontres, à l'aide de son système de publication et de son panel 
d'activité (pratiqué / aimé) à sélectionné, le site propose de solution innovante pour faire le rencontre de d'autres profils nous 
correspondant à l'aide d'une algorithme unique recherchant les autres usagers en fonction de leurs activités communes.
Pour commencer Le projet a était codé à l'aide du Framework Symfony 4,

![image](https://user-images.githubusercontent.com/45235527/96745902-e9174200-13c6-11eb-9388-d6ae349db857.png)

À l'aide de plusieurs templates HTML5 UP, nous avons pu trouver plusieurs templates qui nous correspondaient et qui nous a donc fallu faire fonctionner ensemble,

![image](https://user-images.githubusercontent.com/45235527/96745778-c9801980-13c6-11eb-8672-fa5ef27b7120.png)

Nous avons aussi utilisé la technologie Axios pour les interactions du site (like/unlike de publication, activité aimée).

![image](https://user-images.githubusercontent.com/45235527/96745379-5d051a80-13c6-11eb-8ca6-eb30405ed5d4.png)

Les images utilisées sont aussi libres de droits et retoucher à l'aide de Photoshop (filtre) afin de suivre les couleurs de notre palette du designe de notre site
[https://github.com/AcensJJ/Friends/blob/master/palette-color.png] afin d'avoir un projet plus professionnel mais aussi utilisable légalement.

![image](https://user-images.githubusercontent.com/45235527/96747858-1a910d00-13c9-11eb-9acc-748ba661be97.png)

# Resultat : 

![sosy1](https://user-images.githubusercontent.com/45235527/96745102-0ef01700-13c6-11eb-87ef-cdc793c7277e.PNG)
![sosy2](https://user-images.githubusercontent.com/45235527/96745110-10b9da80-13c6-11eb-9e86-bb154b8d0839.PNG)
