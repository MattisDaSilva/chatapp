# Chat Sécurisé - Guide d'Installation

Ce guide fournit des instructions de base pour installer et exécuter le projet Laravel.

## Prérequis

- PHP 
- Composer
- Node.js et npm
- Serveur web (Apache, Nginx, etc.)
- MySQL ou un autre système de gestion de base de données pris en charge par Laravel
- Homestead (pour l'utilisation de l'environnement de développement homestead.yaml)

## Installation

1. Clonez le dépôt du projet depuis GitHub dans le répertoire ``Homestead/code`` :

```php
    git clone https://github.com/MattisDaSilva/chatapp.git 
```

2. Accédez au répertoire du projet :

```php
    cd chatapp
```
3. Installez les dépendances PHP à l'aide de Composer :

```php
    composer install
```

4. Installez les dépendances JavaScript via npm :

```php
    npm install
```
5. Compilez les ressources frontales avec npm :

```php
    npm run build
```

6. Copiez le fichier `.env.example` et renommez-le en `.env` :

```php
    cp .env.example .env
```

7. Générez une clé d'application Laravel :

```php
    php artisan key:generate
```
8. Configurez les informations de la base de données dans le fichier `.env`.

9. Ajoutez les détails du site dans votre fichier `homestead.yaml` (si vous utilisez Homestead) :

   ```yaml
   sites:
       - map: monsite.test
         to: /chemin/vers/le/projet/public
    ```
10. Ajoutez l'entrée correspondante dans le fichier /etc/hosts :

```etc\hosts
    192.168.10.10   monsite.test
```

11. Exécutez les migrations pour créer les tables de base de données :

```php
    php artisan migrate
```

12. Exécutez les seeders pour remplir la base de données avec l'utilisateur admin :

```php
    php artisan db:seed --filter=AdminSeeder
```
