# Déploiement sur Render

Ce guide explique comment déployer l'application Symfony sur Render.

## Prérequis

- Un compte Render (https://render.com)
- Un repository Git contenant votre application

## Configuration

### 1. Créer un nouveau Web Service

1. Connectez-vous à Render
2. Cliquez sur "New +" → "Web Service"
3. Connectez votre repository GitHub/GitLab

### 2. Configuration du service

- **Name**: sosya-app (ou le nom de votre choix)
- **Environment**: Docker
- **Branch**: main (ou votre branche principale)
- **Dockerfile Path**: ./Dockerfile
- **Docker Build Context Path**: .

### 3. Variables d'environnement

Ajoutez les variables d'environnement suivantes dans Render :

```bash
APP_ENV=prod
APP_SECRET=<générez-une-clé-secrète-forte>
DATABASE_URL=<url-de-votre-base-de-données>
```

**Important** : Pour générer APP_SECRET, utilisez :
```bash
php -r "echo bin2hex(random_bytes(16));"
```

### 4. Base de données

Si vous utilisez PostgreSQL sur Render :

1. Créez une base de données PostgreSQL dans Render
2. Copiez l'URL de connexion interne
3. Définissez-la comme variable d'environnement `DATABASE_URL`

### 5. Configuration du port

Render définit automatiquement la variable `PORT`. L'application est configurée pour l'utiliser automatiquement.

## Architecture

L'application utilise :
- **nginx** : serveur web sur le port défini par `$PORT`
- **PHP-FPM** : processeur PHP
- **supervisord** : gestion des deux processus

## Déploiement

Une fois la configuration terminée, cliquez sur "Create Web Service". Render va :

1. Cloner votre repository
2. Build l'image Docker (target: prod)
3. Démarrer le conteneur
4. Exposer l'application sur HTTPS

## Vérification

Après le déploiement, vous pouvez vérifier :

1. Les logs dans le dashboard Render
2. L'URL fournie par Render (format: `https://your-app.onrender.com`)

## Migrations de base de données

Pour exécuter les migrations après le déploiement :

1. Ouvrez le Shell dans le dashboard Render
2. Exécutez :
```bash
php bin/console doctrine:migrations:migrate --no-interaction
```

## Troubleshooting

### L'application se termine prématurément

- Vérifiez que tous les fichiers Docker sont présents
- Vérifiez les logs pour voir les erreurs
- Assurez-vous que DATABASE_URL est correctement configurée

### Erreurs 502

- Vérifiez que nginx et PHP-FPM démarrent correctement
- Regardez les logs supervisord

### Problèmes de permissions

- L'application gère automatiquement les permissions
- Si vous rencontrez des problèmes, vérifiez que var/ est bien writable

## Support

Pour plus d'informations sur Render :
- Documentation : https://render.com/docs
- Support : https://render.com/support
