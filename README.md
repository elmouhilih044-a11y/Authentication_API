API d'Authentification Laravel
Description du projet

Ce projet est une API REST développée avec Laravel permettant la gestion de l'authentification et du profil utilisateur.

L'API utilise Laravel Sanctum pour l'authentification basée sur des tokens et peut être testée uniquement avec Postman (aucun frontend n'est utilisé).

L'objectif du projet est de démontrer :

    La gestion de l'identité utilisateur
    La sécurisation des routes
    La manipulation des données de profil
    Les bonnes pratiques des APIs REST

Fonctionnalités

L'utilisateur peut :

    Créer un compte
    Se connecter et recevoir un token d'accès
    Se déconnecter
    Consulter son profil
    Modifier son profil
    Changer son mot de passe
    Supprimer son compte

Toutes les routes liées au profil sont protégées par authentification.
Technologies utilisées

    Laravel
    Laravel Sanctum
    MySQL
    Postman

Installation du projet
1 Cloner le projet

git clone https://github.com/votre-username/laravel-auth-api.git

2 Aller dans le dossier du projet

cd laravel-auth-api

3 Installer les dépendances

composer install

4 Créer le fichier d'environnement

cp .env.example .env

5 Configurer la base de données dans .env

Exemple :

DB_DATABASE=auth_api
DB_USERNAME=root
DB_PASSWORD=

6 Générer la clé de l'application

php artisan key:generate

7 Lancer les migrations

php artisan migrate

8 Lancer le serveur

php artisan serve

L'API sera disponible sur :

http://127.0.0.1:8000

Authentification

Cette API utilise Laravel Sanctum pour l'authentification par token.

Après la connexion, l'API retourne un token qui doit être envoyé dans les headers pour accéder aux routes protégées.

Exemple :

Authorization: Bearer YOUR_TOKEN

Routes de l'API
Routes publiques
Inscription

POST /api/register

Body :

name
email
password

Réponse :

Account created successfully

Statut : 201
Connexion

POST /api/login

Body :

email
password

Réponse :

Login successful
token

Statut : 200
Routes protégées

Ces routes nécessitent un token d'authentification.

Si aucun token n'est fourni, l'API retourne :

Unauthorized

Statut : 401
Consulter le profil

GET /api/me

Réponse :

Profile fetched successfully

Statut : 200
Modifier le profil

PUT /api/me

Body :

name
email

Réponse :

Profile updated successfully

Statut : 200
Changer le mot de passe

PUT /api/me/password

Body :

current_password
new_password
new_password_confirmation

Réponses possibles :
Situation 	Message 	Statut
Mot de passe actuel incorrect 	Current password is incorrect 	422
Succès 	Password updated successfully 	200
Déconnexion

POST /api/logout

Réponse :

Logout successful

Statut : 200
Supprimer le compte

DELETE /api/me

Réponse :

Account deleted successfully

Statut : 200
Test de l'API

L'API peut être testée avec Postman.

Scénario de test :

    POST /api/register → créer un compte
    POST /api/login → récupérer le token
    GET /api/me sans token → Unauthorized
    GET /api/me avec token → succès
    PUT /api/me → modifier le profil
    PUT /api/me/password → changer le mot de passe
    POST /api/logout → déconnexion
    GET /api/me avec l'ancien token → Unauthorized

Sécurité

    Les mots de passe sont hachés avant stockage
    Les routes sensibles sont protégées par token
    Un utilisateur ne peut accéder qu'à son propre profil
    L'email doit être unique
    Validation des données sur toutes les requêtes
