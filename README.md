# 🛍️ Delivery App – Laravel REST API Backend

A RESTful API backend for a delivery application, built using **Laravel**. This API allows users to browse products by category and store, manage their profiles, place and edit orders, maintain a favorites list, and verify their account via OTP email using **Gmail SMTP**. Laravel Sanctum is used for secure token-based authentication.

---

## ✨ Features

- 🔐 **Authentication**
  - User registration and login
  - OTP email verification via **Gmail SMTP**
  - Token-based API security (Laravel Sanctum)

- 👤 **User Profile**
  - View and update profile info
  - Upload or change avatar image

- 🛒 **Product Browsing**
  - Browse product categories
  - View stores under each category
  - Browse products in a store
  - View product details
  - Search by product or store name

- ❤️ **Favorites**
  - Add/remove products to/from favorites
  - View favorites by product category

- 🧺 **Cart & Orders**
  - Add/remove/edit products in the cart
  - Place new orders
  - Edit or cancel orders
  - View past orders

- 📦 **Stock Handling**
  - Product stock is updated when:
    - An order is delivered
    - An order is canceled or removed

---

## 🔧 Tech Stack

- **Laravel 11**
- **MySQL**
- **Laravel Sanctum**
- **Gmail SMTP** (OTP delivery)
- **Postman** (API testing)

---

## 🗂️ Project Structure

```bash
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── Api/
│   │           ├── Auth/
│   │           │   ├── LoginController.php
│   │           │   └── RegisterController.php
│   │           ├── CartController.php
│   │           ├── CategoryController.php
│   │           ├── FavoriteController.php
│   │           ├── OrderController.php
│   │           ├── OrderItemController.php
│   │           ├── ProductController.php
│   │           ├── ProfileController.php
│   │           ├── SearchController.php
│   │           └── StoreController.php
│
│   ├── Models/
│   │   ├── CartItem.php
│   │   ├── Category.php
│   │   ├── Favorite.php
│   │   ├── Order.php
│   │   ├── OrderItem.php
│   │   ├── Product.php
│   │   ├── Profile.php
│   │   ├── Store.php
│   │   ├── User.php
│   │   └── UserPhoto.php
│
├── database/
│   ├── seeders/
│   │   ├── CategorySeeder.php
│   │   ├── ProductSeeder.php
│   │   ├── StoreSeeder.php
│   │   └── UserSeeder.php
├── routes/
│   └── api.php
├── database/
│   └── migrations/
├── tests/
│   └── Feature/
├── .env.example
├── composer.json
└── README.md
```
---

## 📍 Key API Endpoints

### 🚀 Authentication & User Management

- **POST** `/register`  
  Register a new user.

- **POST** `/verify-otp`  
  Verify the OTP sent to the user's email for account activation.

- **POST** `/login`  
  Log in with email and password.

- **POST** `/logout`  
  Log out the authenticated user.

---

### 🛍️ Products, Categories & Stores

- **GET** `/categories`  
  Retrieve a list of all product categories.

- **GET** `/categories/{categoryId}/stores`  
  Get the list of stores under a specific category.

- **GET** `/stores/{storeId}/products`  
  Get the list of products for a specific store.

- **GET** `/stores/{storeId}/products/{productId}`  
  View detailed information about a specific product.

- **GET** `/home/products`  
  Display a curated list of products for the home page.

---

### 🛒 Cart Management

- **POST** `/cart`  
  Add a product to the cart.

- **PUT** `/cart/{cartItemId}`  
  Update the quantity of a product in the cart.

- **DELETE** `/cart/{cartItemId}`  
  Remove a product from the cart.

- **GET** `/cart`  
  View all items currently in the cart.

---

### 📦 Order Management

- **GET** `/orders`  
  Get a list of all orders placed by the authenticated user.

- **GET** `/orders/{orderId}`  
  View details of a specific order.

- **POST** `/orders`  
  Create a new order.

- **DELETE** `/orders/{orderId}`  
  Cancel a specific order.

- **GET** `/orders/{orderId}/items/{itemId}`  
  View details of a specific item in an order.

- **PUT** `/orders/{orderId}/items/{itemId}`  
  Update a specific item in an order.

- **DELETE** `/orders/{orderId}/items/{itemId}`  
  Remove an item from an order.

---

### 💖 Favorites

- **GET** `/favorites`  
  Retrieve the user's list of favorite products.

- **POST** `/favorites`  
  Add a product to the user's favorites.

- **DELETE** `/favorites`  
  Remove a product from the user's favorites.

---

### 👤 User Profile Management

- **GET** `/profile`  
  Get the authenticated user's profile data.

- **GET** `/profile/photos`  
  Retrieve available profile photo options.

- **PUT** `/profile/photo`  
  Update the user's profile photo.

- **PUT** `/profile/password`  
  Change the user's password.

- **PUT** `/profile/first-name`  
  Update the user's first name.

- **PUT** `/profile/last-name`  
  Update the user's last name.

- **PUT** `/profile/email`  
  Change the user's email address.

- **PUT** `/profile/phone-number`  
  Update the user's phone number.

- **PUT** `/profile/location`  
  Update the user's location.

---

## 📌 Notes

- All routes for **authentication**, **profile**, **favorites**, **orders**, and **cart** are protected by `auth:sanctum`.  
  Make sure the user is authenticated before accessing them.

- Use **Laravel Sanctum** tokens for authentication in all secured requests.

---