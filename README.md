# Setup

---

## Prérequis

- PHP >= 8.1  
- Composer  
- SQLite ou MySQL  
- Redis (pour la queue Laravel)  
- Laravel 10  

---

## Installation rapide

1. **Cloner le repo et installer les dépendances**

```bash
git clone <repository_url>
cd <folder>
composer install
cp .env.example .env
```

Configuration SQLite

Si tu utilises SQLite, modifie .env :

```bash
DB_CONNECTION=sqlite
DB_DATABASE=/chemin/vers/votre/projet/database/policymate.sqlite
```

Créer le fichier SQLite vide si nécessaire :

```bash
mkdir -p database
touch database/policymate.sqlite
```

Configuration Redis et Queue

Dans .env :

```bash
QUEUE_CONNECTION=redis
REDIS_CLIENT=predis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
REDIS_PASSWORD=null
```

Laravel utilisera Redis pour les jobs en arrière-plan (import CSV, etc.).

Lancer les migrations

`php artisan migrate`

Démarrer le serveur de développement

`php artisan serve`

L’URL de base sera par défaut [http://127.0.0.1:8000](http://127.0.0.1:8000)
Importer les données CSV

Placer ton fichier sales.csv dans storage/app/.

Ensuite, accéder à l’URL :

[http://127.0.0.1:8000/import](http://127.0.0.1:8000/import)

Le traitement se fait en arrière-plan (queue Redis). Les erreurs sont loggées dans storage/logs/laravel.log.

Rapports disponibles

Top produits par chiffre d’affaires :
[http://127.0.0.1:8000/report/topproducts/3](
http://127.0.0.1:8000/report/topproducts/3)

Chiffre d’affaires mensuel pour une année donnée :
[http://127.0.0.1:8000/report/monthly-revenue/2025](
http://127.0.0.1:8000/report/monthly-revenue/2025)

Top clients par chiffre d’affaires :
[http://127.0.0.1:8000/report/top-customers/5](
http://127.0.0.1:8000/report/top-customers/5)
Tests

Tests unitaires et fonctionnels avec PHPUnit / Laravel :

`php artisan test --filter=ImportCsvTest`

Les tests vérifient l’import CSV, les validations et la création des enregistrements.

Bonnes pratiques appliquées

TDD et granularité des tests : Chaque test vérifie un seul comportement (import réussi, import échoué, fichier vide).

Utilisation de Storage::fake() pour les tests afin de ne pas écrire sur le disque.

Logging des erreurs CSV pour tracer les lignes invalides.

Queues avec Redis pour le traitement asynchrone des imports.

Eloquent performant : agrégations et relations utilisées côté base de données plutôt qu’en PHP.

Notes

Les données CSV doivent avoir le header :

order_id,order_date,customer_email,product_sku,product_name,unit_price,quantity

Les emails doivent être valides et les valeurs numériques positives.

Pour toute erreur dans le CSV, la ligne est ignorée et un warning est loggé.
