# 🌐 Joinify

Joinify facilitates the management of clubs, members, payments, and events within an academic or organizational setting. It supports a robust role-based access system and automates administrative workflows like membership validation, event organization, and payment tracking.

# 🚀 Preview

<img src="./preview.png" />

# 🧰 Requirements

-   [PHP >= 8.1](https://www.php.net/downloads)
-   [Composer](https://getcomposer.org/)
-   [Laravel >= 10.x](https://laravel.com/docs/12.x)
-   [MySQL](https://www.mysql.com/)

# 🛠️ Installation

```shell
git clone https://github.com/masum184e/joinify.git
cd joinify

# Install PHP dependencies
composer install

# Set up environment
cp .env.example .env
php artisan key:generate

# Configure database in .env and run migrations
php artisan migrate

# Optional: Seed the database
php artisan db:seed

# Serve the application
php artisan serve
```

# 🔐 Environment Variables

```
# Database configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=joinify
DB_USERNAME=root
DB_PASSWORD=

# Default password for seeding
DEFAULT_USER_PASSWORD=defaultPassword123

# SSLCommerz Payment Gateway credentials
SSLCZ_STORE_ID=abcdefghijklmnopqrstuvwxyz
SSLCZ_STORE_PASSWORD=abcdefghijklmnopqrstuvwxyz@ssl
SSLCZ_TESTMODE=true
```

# 🧩 Database Structure

## Users

Basic user details (name, email, password, profile_picture)

### Relationships:

-   Global Role (e.g., Advisor)
-   Member (student info)
-   Club roles (President, Secretary, Accountant)

## Roles

### Global

-   Advisor

### Club Specific

-   President
-   Secretary
-   Accountant

## Clubs

-   Name, description
-   Related to members, events, and club-based roles

## Memberships

-   Links a member to a club
-   Enforces uniqueness of member per club

## Payments

-   Tracks membership payments
-   Status: pending, paid, failed

## Events

-   Belongs to a club
-   Contains event details like title, schedule, location

## Guests

-   Can be invited to events
-   Linked through a many-to-many table with events

# 🔗 Entity Relationships

1. **Users**

    - hasOne user_global_roles
    - hasMany club_user_roles
    - hasOne member

2. **User Global Roles**

    - belongsTo user

3. **Clubs**

    - hasMany club_user_roles
    - hasMany memberships
    - hasMany events

4. **Club User Roles**

    - belongsTo club
    - belongsTo user

5. **Members**

    - belongsTo user
    - hasMany memberships

6. **Memberships**

    - belongsTo member
    - belongsTo club
    - hasOne payment

7. **Payments**

    - belongsTo membership

8. **Events**

    - belongsTo club
    - hasMany event_guests

9. **Guests**

    - hasMany event_guests

10. **Event Guests**
    - belongsTo event
    - belongsTo guest

# 💬 Relationship Types

| Relationship          | Type         | One Side   | Many Side      |
| --------------------- | ------------ | ---------- | -------------- |
| User ↔ UserGlobalRole | One-to-One   | User       | UserGlobalRole |
| User → ClubUserRole   | One-to-Many  | User       | ClubUserRole   |
| Club → ClubUserRole   | One-to-Many  | Club       | ClubUserRole   |
| User ↔ Member         | One-to-One   | User       | Member         |
| Member → Membership   | One-to-Many  | Member     | Membership     |
| Club → Membership     | One-to-Many  | Club       | Membership     |
| Membership ↔ Payment  | One-to-One   | Membership | Payment        |
| Club → Event          | One-to-Many  | Club       | Event          |
| Event → EventGuest    | One-to-Many  | Event      | EventGuest     |
| Guest → EventGuest    | One-to-Many  | Guest      | EventGuest     |
| Event ↔ Guest         | Many-to-Many | Event      | Guest          |

# 🎯 Features

## 👨‍🏫 Advisor

-   View all clubs and memberships
-   Validate and manage club roles
-   Monitor payments and memberships
-   Manage all users and assign roles

## 👔 Executive Member - President, Secretary, Accountant

-   Manage club details
-   Add and approve members
-   Organize events and invite guests
-   Track and verify payments

## 👥 Member

-   Join clubs
-   View upcoming events
-   Pay membership dues
-   Request role or submit reasons for joining

## 🔐 Role-Based Access Control

### 👥 Member Management

-   Club admins (President, Accountant) can view a full list of members.
-   Each member is linked to a user account and includes student information like department and student ID.
-   Members are associated with clubs through Memberships.

### 📅 Event Management

-   Public Event Views: Anyone can view public listings and details of events for a club.
-   Admin Event Dashboard:
    -   Only secretaries or presidents can access the dashboard to:
        -   Create, view, edit, or delete events.
        -   Manage guest invitations per event.
-   Guests can be added to events by name and email (optional).
-   Events support full CRUD operations.

### 📨 Guest Management

-   Guests are linked to events via a pivot table.
-   Reusable guest records are created by email when provided.

### 💳 Membership Payment (SSLCommerz Integration)

-   New users can register as members and initiate payment for membership fees.
-   Integration with SSLCommerz allows real-time payment processing.
-   Payment flow:

    -   Creates a User, Member, Membership, and pending Payment record.
    -   Redirects to SSLCommerz hosted gateway for payment.
    -   Handles success, fail, and cancel callbacks.

-   Default payment amount is 123 BDT.

# Contribution

-   Forget password
-   Upload club banner by President
-   Update club fee by Accountant
-   Send club creation invitation to president, secretary, accountant email and verify them.
-   Update payment details after successfull payment
-   User settings
-   Remove guest during update guest
-   Prevent unverified executives(president, secretary, accountant) login
- Searching
- Pagination
- when advisor update executives member, it's email should changed as well as verified status