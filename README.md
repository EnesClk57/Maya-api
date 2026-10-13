# Maya API

Maya API est une API backend développée avec Symfony 7 et API Platform pour gérer un catalogue de produits, des catégories, des utilisateurs et des ressources multimédia. Le projet met en avant une architecture API REST/JSON moderne, avec validation des données, sécurité, gestion des fichiers uploadés et base de données relationnelle.

## Description pour les recruteurs

Ce projet démontre ma capacité à concevoir et développer un backend complet, fiable et évolutif pour une application e-commerce ou de gestion de catalogue. J’ai construit une API orientée produit avec des ressources bien structurées, une logique métier claire, une authentification sécurisée et des mécanismes de validation pour garantir la qualité des données.

Ce type de projet montre que je maîtrise :
- la création d’API REST avec Symfony et API Platform,
- la modélisation de données relationnelles avec Doctrine ORM,
- la sécurisation des endpoints via JWT,
- la gestion des fichiers et images via VichUploader,
- l’architecture backend moderne et la qualité de code.

Ce projet est un bon exemple de mon approche : transformer des besoins fonctionnels en services API propres, bien documentés, sécurisés et prêts à évoluer.

## Stack technique

- PHP 8.2
- Symfony 7.2
- API Platform
- Doctrine ORM
- MySQL / MariaDB
- Lexik JWT Authentication Bundle
- VichUploaderBundle
- Composer

## Fonctionnalités

- Gestion des produits
- Gestion des catégories
- Recherche et filtres sur les ressources
- Upload d’images associés aux catégories et produits
- Validation des champs et contraintes métier
- Authentification sécurisée avec JWT
- API documentée et exploitable via JSON

## Structure du projet

```text
Maya-api/
├── config/             # Configuration Symfony
├── migrations/         # Migrations Doctrine
├── public/             # Point d’entrée HTTP
├── src/                # Code applicatif
│   ├── Entity/         # Entités Doctrine
│   ├── Repository/     # Repositories
│   ├── Controller/     # Contrôleurs
│   ├── Serializer/     # Sérialisation personnalisée
│   └── ...
├── templates/          # Templates Twig
├── .env                # Variables d’environnement
├── composer.json       # Dépendances PHP
├── symfony.lock        # Lock file Symfony
├── README.md           # Documentation du projet
└── ...
```

## Prérequis

- PHP 8.2+
- Composer
- MySQL ou MariaDB
- Symfony CLI (recommandé)

## Installation

1. Cloner le projet :

```bash
git clone https://github.com/EnesClk57/Maya-api.git
cd Maya-api
```

2. Installer les dépendances :

```bash
composer install
```

3. Configurer la base de données dans le fichier `.env` :

```env
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/maya_md?serverVersion=8.0.31"
```

4. Créer la base de données puis exécuter les migrations :

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

5. Démarrer le serveur Symfony :

```bash
symfony serve
```

ou

```bash
php -S 127.0.0.1:8000 -t public
```

## Vérification rapide

L’API est généralement accessible sur :

```text
http://127.0.0.1:8000
```

L’API Platform expose les endpoints et la documentation automatique selon la configuration installée.

## Commandes utiles

```bash
# Lister les routes
php bin/console debug:router

# Vérifier les dépendances Symfony
php bin/console about

# Effacer le cache
php bin/console cache:clear

# Vérifier l’état du projet
php bin/console lint:yaml
```

## Exemple de message pour un portfolio / GitHub

> Backend API Symfony for a product catalog management system. I built this project to practice and demonstrate API-first development with secure authentication, data validation, and file upload handling. The application exposes structured endpoints for products and categories, integrates with Doctrine ORM, and follows a clean backend architecture suitable for e-commerce, inventory, or digital catalog use cases.

## Objectif du projet

Ce projet a pour but de démontrer la capacité à concevoir un backend structuré, maintenable et orienté produit, dans un cadre professionnel réaliste. Il représente une base solide pour un portfolio technique et met en évidence la maîtrise des bonnes pratiques backend en Symfony.
