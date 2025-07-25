# 📱 ToDo&Co

**Amélioratyion d'un MVP**  
Développé par **Jessica GARRIDO**  
🎓 *Projet de formation Développeuse d'application PHP/Symfony - OpenClassrooms*

![Codacy Badge](https://insight.symfony.com/projects/8329888e-b887-45b4-874a-2e05e4141477/big.svg) <!-- Remplacez xxx par l'ID réel du projet -->

---

## 🛠️ Environnement de développement

- **Symfony** 7.2  
- **Bootstrap** 5.3  
- **Composer** 2.8.8  
- **WampServer** 3..3.7
  - Apache 2.4.63  
  - PHP 8.2 
  - MySQL 8.4..4

---

## 📥 Installation

### 🔹 Cloner le dépôt GitHub

```bash
git clone https://github.com/jessicagarrido/to-do-list.git
```
### 🔹 Installer les dépendances

```bash
composer install
```

---

### 🔹 Configurer les variables d'environnement

1. Copiez le fichier `.env` et renommez-le en `.env.local` à la racine du projet.
2. Modifiez la ligne suivante pour définir vos identifiants de base de données, et décommentez-la (retirez le `#` devant) :

```dotenv
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=8.0.32&charset=utf8mb4"
```

**Exemple (par défaut Wamp) :**

```dotenv
DATABASE_URL="mysql://root:@127.0.0.1:3306/todolist"
```

---

## 🧱 Base de données

### 🔸 Création de la base de données

```bash
php bin/console doctrine:database:create
```

### 🔸 Générer les migrations

```bash
php bin/console make:migration
```

### 🔸 Appliquer les migrations

```bash
php bin/console doctrine:migrations:migrate
```

---

### 🔸 Charger des données de démo (fixtures)

```bash
php bin/console doctrine:fixtures:load
```

> Confirmez avec `yes` lorsque demandé.

---

## 👥 Utilisateurs de démonstration

### 🔐 Administrateur

- **username_1** / `todo2025`

### 👤 Utilisateurs classiques

- **test_user** / `todo2025`

---

## 🧪 Tests & environnement de test

### 🔸 Préparer la base de test

1. Exporter la base `todolist` dans un fichier `.sql` via PhpMyAdmin.
2. Créer une nouvelle base appelée `todolist_test`.
3. Importer le fichier `.sql` pour initialiser la base de test.

---

### 🔸 Exécuter les tests unitaires ou fonctionnels

```bash
php bin/phpunit tests/Entity/TaskEntityTest.php
php bin/phpunit tests/Controller/TaskControllerTest.php
```

⚠️ Les tests modifient la base `todolist_test`.  
Réimportez le `.sql` si besoin pour la réinitialiser.

---

## 📊 Couverture de tests avec XDebug

> Installez XDebug : [https://xdebug.org/docs/install](https://xdebug.org/docs/install)

### 🔸 Générer le rapport HTML de couverture

```bash
vendor/bin/phpunit --coverage-html reports/
```

---

## ▶️ Lancer le serveur Symfony

```bash
symfony server:start
```

## 👨‍💻 Auteur

Jessica GARRIDO
📘 OpenClassrooms - Formation Développeur PHP/Symfony
