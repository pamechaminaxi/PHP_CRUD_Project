# 🧑‍💻 PHP CRUD Project (Tailwind + DataTables)

This is a simple **PHP CRUD application** built using **Core PHP, MySQL, Tailwind CSS and DataTables**.
The project demonstrates full CRUD operations with validation, image upload and soft delete.

---

## 📌 Features

* 📋 List records using **DataTables**

  * Search
  * Pagination
  * Sorting
* ➕ Insert record with validation
* ✏️ Update record with validation
* 🗑️ Delete record using **Soft Delete**
* 🖼️ Image upload support
* 📱 Fully responsive form using **Tailwind CSS**
* 💾 Database schema included

---

## 🛠️ Tech Stack

| Technology   | Use                       |
| ------------ | ------------------------- |
| PHP          | Backend                   |
| MySQL        | Database                  |
| Tailwind CSS | UI Styling                |
| DataTables   | Table search & pagination |
| HTML/CSS     | Frontend                  |

---

## 📂 Project Structure

```
PHP_POC/
│
├── src/
│   ├── index.php
│   ├── update.php
│   ├── db.php
│   ├── input.css
│   ├── output.css
│   └── uploads/
│
├── UserData.sql
├── package.json
├── package-lock.json
└── .gitignore
```

---

## ⚙️ Installation Steps

### 1️⃣ Clone the repository

```
git clone https://github.com/pamechaminaxi/PHP_CRUD_Project.git
cd PHP_CRUD_Project
```

---

### 2️⃣ Setup Database

1. Open **phpMyAdmin**
2. Create new database:

```
UserData
```

3. Import the file:

```
UserData.sql
```

---

### 3️⃣ Configure Database Connection

Open file:

```
src/db.php
```

Update credentials:

```php
$this->con = new mysqli("localhost","root","","UserData");
```

---

### 4️⃣ Install Tailwind CSS (First time only)

```
npm install
```

Run Tailwind watcher:

```
npx @tailwindcss/cli -i ./src/input.css -o ./src/output.css --watch
```

---

### 5️⃣ Run Project

Open in browser:

```
http://localhost/PHP_POC/src/index.php
```

---

## 🗄️ Database Structure

Table: **users**

| Field         | Type                    |
| ------------- | ----------------------- |
| id            | INT (Primary Key)       |
| name          | VARCHAR                 |
| email         | VARCHAR                 |
| mobile        | VARCHAR                 |
| gender        | VARCHAR                 |
| date_of_birth | DATE                    |
| address       | TEXT                    |
| profile_img   | VARCHAR                 |
| status        | TINYINT                 |
| is_deleted   | TIMESTAMP               |


---

## 🧠 CRUD Flow

| Operation   | File       |
| ----------- | ---------- |
| Create      | index.php  |
| Read/List   | index.php  |
| Update      | update.php |
| Soft Delete | db.php     |

---

## ⭐ Notes

This project is created for **learning and practice purposes**.
You can use and modify it for educational projects.

