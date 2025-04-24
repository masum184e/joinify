# Entity Relationships

| Table             | Relationships            |
| ----------------- | ------------------------ |
| users             | hasOne user_global_roles |
|                   | hasMany club_user_roles  |
|                   | hasOne member            |
| user_global_roles | belongsTo user           |
| clubs             | hasMany club_user_roles  |
|                   | hasMany memberships      |
|                   | hasMany events           |
| club_user_roles   | belongsTo club           |
|                   | belongsTo user           |
| members           | belongsTo user           |
|                   | hasMany memberships      |
| memberships       | belongsTo member         |
|                   | belongsTo club           |
|                   | hasOne payment           |
| payments          | belongsTo membership     |
| events            | belongsTo club           |
|                   | hasMany event_guests     |
| guests            | hasMany event_guests     |
| event_guests      | belongsTo event          |
|                   | belongsTo guest          |

# Relationship Types

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
