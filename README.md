# 🌐 Joinify

Joinify facilitates the management of clubs, members, payments, and events within an academic or organizational setting. It supports a robust role-based access system and automates administrative workflows like membership validation, event organization, and payment tracking.

# 🚀 Preview

[<img src="./preview.png" width="100%">](https://drive.google.com/uc?export=view&id=13aj-ym2m4Xeva-bEZwalX4xYYu2-em2C)

<a href="https://joinify.up.railway.app/">Live</a>

## Credentials

### Admin

```
email: admin@gmail.com
password: admin@gmail.com
```

### President

```
email: president@gmail.com
password: president@gmail.com
```

### Secretary

```
email: secretary@gmail.com
password: secretary@gmail.com
```

### Accountant

```
email: accountant@gmail.com
password: accountant@gmail.com
```

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

# Routes

## `/home`

-   Controlled by `HomeController.index`.
-   It shows verified popular clubs dynamically.
-   Allow only `GET` method.

### Popular Clubs

1. `$popularClubs = Club::withCount('memberships','userRoles')`
    - `withCount('memberships', 'userRoles')` will add two extra columns to the result `memberships_count`, `user_roles_count`
2. `->orderBy('memberships_count', 'desc')` - sorts the clubs in descending order of their membership count.
3. `->take(3)` - Limits the result to the top 3 clubs
4. `->get()` - Executes the query

## `/clubs`

-   Controller by `ClubController.publicIndex`.
-   It shows all verified clubs(ID, Name, Description, Fee, Banner, Created At).
-   Allow only `GET` method.
-   `select` will be fetched only the specific fields.

## `/clubs/{{ clubId }}`

-   Controlled by `ClubController.show`.
-   It shows a specific verified club (ID, Name, Description, Fee, Banner, Created At) details.
-   Allow only `GET` method.
-   `findOrFail($clubId)` - Looks for a club with the given ID. If not found, automatically throws a 404 error.
-   `abort(404)` - sends a **Not Found** response.

## `/clubs/{{ clubId }}/join`

-   Controlled by `ClubController.joinClub`.
-   It shows joining form of a verified club(shows).
-   Allow only `GET` method.

## `/pay/{{ clubId }}`

-   Controlled by `SslCommerzPaymentController.index`.
-   Allow only `POST` method.
-   It redirect to `SslCommerz` and show payment UI.
-   It store member details and set payment status `pending` and redirect to `/success` or `/fail` or `/cancel`.

## `/success`

-   Controlled by `SslCommerzPaymentController.success`.
-   Allow only `POST` method.
-   It shows the succeded payment details with transaction id.
-   It ignore the csrf token verification.

## `/fail`

-   Controlled by `SslCommerzPaymentController.fail`.
-   Allow only `POST` method.
-   It shows the failed status.
-   It ignore the csrf token verification.

## `/cancel`

-   Controlled by `SslCommerzPaymentController.cancel`.
-   Allow only `POST` method.
-   It shows the cancelled status.
-   It ignore the csrf token verification.

## `/login` and `/signin`

-   Controlled by `AuthController.index`(`GET`) and `AuthController.login`(`POST`).
-   It shows and handle login form.
-   Allow both `GET` and `POST` method.
-   `$request->only` method passes only the email and password to the `attempt()` method.
-   `Auth::attempt()` checks if the email and password match a user in the database.

## `/logout`

-   Controlled by `AuthController.logout`
-   It show nothing just remove the authentication session.
-   Allow only `GET` method.
-   `Auth::logout();` logs the user out by removing their authentication data from the session.
-   `invalidate()` clears all session data, making sure any old session information is discarded.
-   `regenerateToken()` generates a new CSRF token to help prevent session fixation attacks.

<!--
## dashboard

### advisor

### president

### secretary

### accountant
-->

## `/dashboard/clubs`

-   Controlled by `ClubController.index`
-   It shows all the club(both verified and non-verified) list to authorized `advisor`.
-   Allow only `GET` method.

## `/dashboard/clubs/create`

-   Controlled by `ClubController.create`
-   It shows club creation form only to authorized `advisor`
-   Allow only `GET` method.

## `/dashboard/clubs/{{ clubId }}/edit`

-   Controlled by `ClubController.edit`
-   It shows club updation form as well as existing club details only to authorized `advisor`
-   Allow only `GET` method.

## `/dashboard/clubs/{{ clubId }}`

-   Allow `GET`, `POST`, `DELETE`, `PUT` method

### `GET`

-   Controlled by `ClubController.show`
-   It only allow for `Authorized` `Advisor`
-   It shows club details icluding membership count and club revenue

### `POST`

-   Controlled by `ClubController.store`
-   It only allow for `Authorized` `Advisor`
-   Store executives credentials first, then club details and assign executives role. If error occured, it remove the uploaded club banner

### `PUT`

-   Controlled by `ClubController.update`
-   It only allow for `Authorized` `Advisor`
-   It just update the modifed value, keep everything as it is

### `DELETE`

-   Controlled by `ClubController.destroy`
-   It only allow for `Authorized` `Advisor`
-   Before removing club details, it remove the club banner first

<!--
## `/dashboard/clubs/{{ clubId }}/events`

## `/dashboard/clubs/{{ clubId }}/events/create`

## `/dashboard/clubs/{{ clubId }}/events/{{ eventId }}/edit`

## `/dashboard/clubs/{{ clubId }}/events/{{ eventId }`

-   Allow `GET`, `POST`, `DELETE`, `PUT` method

### `GET`

### `POST`

### `DELETE`

### `PUT`
-->

# Contribution

-   Forget password, remember me.
-   Upload club banner by president.
-   Update club fee by accountant.
-   Send club creation invitation to president, secretary, accountant email and verify them.
-   User settings.
-   Remove guest during update guest.
-   when advisor update executives member, it's email should changed as well as verified status.
-   Implement event schedule handling feature.
- Show events sorted order.
- Show event guests list.
- Show guest name during editing event information.