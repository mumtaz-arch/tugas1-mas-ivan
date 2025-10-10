# Laravel Authentication & Content Management System

A Laravel application built with Laravel Breeze authentication as the foundation, featuring user registration with photo uploads, content management system with CRUD operations for posts, role-based authorization, and search functionality.

## Features

### Authentication System
- Login and registration forms with improved UI/UX
- Enhanced error handling with clear messages
- Password confirmation validation
- Photo upload during registration (JPG, JPEG, PNG, max 2MB)

### User Management
- Register with photo upload functionality
- Photo storage in `public/photos` directory
- User profile management

### Content Management System (Posts)
- Full CRUD operations for posts
- Image upload for posts
- Publish/unpublish functionality
- Automatic user_id assignment based on logged-in user
- Post storage in `public/posts` directory

### Authorization & Security
- Middleware and policy-based access control
- Admin can access all posts
- Regular users can manage only their own posts
- Auth middleware protection on all user-facing pages

### Public Features
- Homepage displaying published posts (sorted by publish date)
- Search functionality on homepage (by title/content)
- Post detail page with full content, image, author, and publish date
- Search functionality on users and posts admin pages

## Technical Implementation

### Models
- User (with photo field)
- Post (with user_id, title, content, image, publish_date, is_publish)

### Controllers
- AuthController (customized from Breeze)
- PostController (CRUD operations)
- UserController (with search functionality)
- HomeController (public homepage)

### Views
- Customized authentication views
- Posts CRUD views
- User management views
- Public homepage and post detail views

### Storage
- User photos stored in `public/photos`
- Post images stored in `public/posts`

## Setup Instructions

1. Clone the repository
2. **IMPORTANT**: This project requires PHP version 8.2 or higher. If you're running an older version of PHP, please upgrade before continuing.
3. Install dependencies:
   ```
   composer install
   npm install
   ```
4. Copy environment file:
   ```
   cp .env.example .env
   ```
5. Generate application key:
   ```
   php artisan key:generate
   ```
6. Configure your database in the `.env` file
7. Run migrations:
   ```
   php artisan migrate
   ```
8. Build assets:
   ```
   npm run build
   ```
   or for development:
   ```
   npm run dev
   ```
9. Seed the database if needed:
   ```
   php artisan db:seed
   ```
10. Start the development server:
   ```
    php artisan serve
   ```

## File Structure

- Authentication views: `resources/views/auth/`
- Post views: `resources/views/posts/`
- User views: `resources/views/users/`
- Homepage views: `resources/views/home/`
- User photos: `public/photos/`
- Post images: `public/posts/`

## Search Functionality

- Homepage: Search posts by title or content
- Users page: Search users by name or email
- Posts page: Search posts by title or content

## Contributing

1. Fork the repository
2. Create your feature branch
3. Make your changes
4. Commit your changes
5. Push to the branch
6. Create a new Pull Request

## License

This project is open source and available under the [MIT License](LICENSE).