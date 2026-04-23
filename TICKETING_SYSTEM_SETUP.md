# Ticketing System Setup Guide

## 📋 What's Been Created

A complete support ticketing system has been integrated into your Laravel project with the following features:

### Database Models

1. **Ticket** - Main ticket model with status, priority, and tracking
2. **TicketCategory** - Categorize tickets (Technical Support, Billing, etc.)
3. **TicketReply** - Handle conversations within tickets

### Controllers

- **TicketController** - Full CRUD operations for tickets

### Views (Blade Templates)

- `resources/views/tickets/index.blade.php` - Ticket listing with filters and stats
- `resources/views/tickets/create.blade.php` - Create new ticket form
- `resources/views/tickets/edit.blade.php` - Edit ticket form
- `resources/views/tickets/show.blade.php` - Ticket detail with replies

### Routes

All routes are protected with `auth` middleware:

```
GET    /tickets              → tickets.index    (List all user tickets)
GET    /tickets/create       → tickets.create   (Create form)
POST   /tickets              → tickets.store    (Store new ticket)
GET    /tickets/{id}         → tickets.show     (View ticket detail)
GET    /tickets/{id}/edit    → tickets.edit     (Edit form)
PUT    /tickets/{id}         → tickets.update   (Update ticket)
DELETE /tickets/{id}         → tickets.destroy  (Delete ticket)
PATCH  /tickets/{id}/close   → tickets.close    (Close ticket)
POST   /tickets/{id}/reply   → tickets.reply    (Add reply)
```

### Navbar Integration

- Added "Support Tickets" link in the user dropdown menu
- Easy access for authenticated users

### Home Page Integration

- Added support section with call-to-action buttons
- Both authenticated and guest users can see this section

---

## ⚙️ Setup Instructions

### Step 1: Run Migrations

```bash
php artisan migrate
```

This will create three tables:

- `ticket_categories` - For ticket categories
- `tickets` - Main tickets table
- `ticket_replies` - For ticket conversations

### Step 2: Seed Default Categories

```bash
php artisan db:seed --class=TicketCategorySeeder
```

This will create 6 default ticket categories:

- Technical Support
- Billing & Payment
- Account & Access
- General Inquiry
- Feature Request
- Bug Report

### Step 3: Update User Model (Optional but Recommended)

Add relationships to your `User` model:

```php
// In app/Models/User.php

public function tickets()
{
    return $this->hasMany(Ticket::class);
}

public function ticketReplies()
{
    return $this->hasMany(TicketReply::class);
}

// Check if user is admin (if you have this)
public function isAdmin()
{
    return $this->role === 'admin'; // or however you determine admin status
}
```

---

## 🎯 Features

### For Users (Authenticated)

✅ Create support tickets with title, description, category, and priority
✅ Track ticket status (Open, In Progress, Pending, Resolved, Closed)
✅ View detailed ticket information
✅ Edit tickets (only when status is Open or Pending)
✅ Add replies/responses to tickets
✅ View conversation history
✅ Close/resolve tickets
✅ Filter tickets by status and priority
✅ Search tickets by title, ticket number, or description
✅ View dashboard stats (total, open, closed, urgent tickets)

### Ticket Statuses

- **Open** - Newly created ticket
- **In Progress** - Support team is working on it
- **Pending** - Waiting for user info/action
- **Resolved** - Issue has been fixed
- **Closed** - Ticket is closed (final state)

### Priority Levels

- 🟢 **Low** - Can wait, non-urgent
- 🟡 **Medium** - Normal priority
- 🔴 **High** - Needs quick attention
- ⚫ **Urgent** - Critical issue, immediate attention needed

---

## 📱 User Flow

1. **Create Ticket**
    - User goes to Dashboard → Support Tickets → Create New
    - Fill in title, description, category, priority
    - System generates unique ticket number (e.g., TKT-1-20250414120000-ABC1)

2. **View Tickets**
    - See list of all their tickets with stats
    - Filter by status, priority, or search
    - Click to view details

3. **Manage Ticket**
    - View full ticket details
    - Add replies/responses
    - Edit ticket (if still open)
    - Close ticket when resolved

4. **Track Progress**
    - See ticket timeline
    - View all replies in conversation
    - Monitor status changes

---

## 🔑 Authorization

- Users can only see/edit their own tickets
- Admins can view all tickets (update controller if needed)
- Users can only edit tickets with status: Open or Pending
- Users can only delete tickets with status: Open
- Only ticket creator or admin can add replies

---

## 🛠️ Customization

### Change Default Categories

Edit `database/seeders/TicketCategorySeeder.php` and modify the categories array

### Change Statuses/Priorities

Update the enum values in `app/Models/Ticket.php`:

```php
enum('status', ['open', 'in_progress', 'pending', 'resolved', 'closed'])
enum('priority', ['low', 'medium', 'high', 'urgent'])
```

### Modify Styling

- All views use Bootstrap classes
- Match your project's color scheme
- Primary color is `#0d6efd` (blue)

### Add Admin Features

You might want to add:

- Admin panel to view all tickets
- Status/priority management for admins
- Response templates
- Auto-assign tickets to support team

---

## 🐛 Troubleshooting

### Migration Errors

```bash
# If migrations already exist, fresh start:
php artisan migrate:fresh --seed
```

### Routes Not Found

Make sure routes are in `routes/web.php` within the `middleware('auth')` group

### Navbar Link Not Showing

Check that navbar includes authenticated user dropdown with dashboard link

### 404 Errors

Run `php artisan route:list` to verify all routes are registered

---

## 📚 Files Created/Modified

### New Files Created:

- `database/migrations/2025_04_14_000000_create_ticket_categories_table.php`
- `database/migrations/2025_04_14_000001_create_tickets_table.php`
- `database/migrations/2025_04_14_000002_create_ticket_replies_table.php`
- `database/seeders/TicketCategorySeeder.php`
- `app/Models/Ticket.php`
- `app/Models/TicketCategory.php`
- `app/Models/TicketReply.php`
- `app/Http/Controllers/TicketController.php`
- `resources/views/tickets/index.blade.php`
- `resources/views/tickets/create.blade.php`
- `resources/views/tickets/show.blade.php`
- `resources/views/tickets/edit.blade.php`

### Modified Files:

- `routes/web.php` - Added ticket routes and controller import
- `resources/views/partials/navbar.blade.php` - Added Support Tickets link
- `resources/views/home.blade.php` - Added support section with CTA

---

## ✅ Next Steps

1. ✅ Run migrations: `php artisan migrate`
2. ✅ Seed categories: `php artisan db:seed --class=TicketCategorySeeder`
3. ✅ Test the system by creating a ticket
4. ✅ Customize styling to match your brand
5. ✅ Add admin panel for managing tickets (optional)
6. ✅ Set up email notifications (optional)

---

## 📞 Support

For issues with the ticketing system, check:

1. All migrations have run: `php artisan migrate:status`
2. Routes are registered: `php artisan route:list | grep ticket`
3. User is authenticated when accessing ticket routes
4. Database tables exist

---

**Status**: ✅ Ready for deployment!
