# Mini P - Réservation de propriétés (squelette)

Ce dépôt contient une base pour une application de réservation de type Airbnb (Laravel 10, Blade + Tailwind, Inertia/Vue possible).

Installation rapide

1. Copier .env et configurer votre base MySQL

```bash
cp .env.example .env
composer install
php artisan key:generate
```

2. Migrer et seed

```bash
php artisan migrate
php artisan db:seed
```

3. Démarrer

```bash
npm install
npm run dev
php artisan serve
```

Architecture

- Migrations: `properties`, `property_images`, `reservations`, `reviews`, `payments`.
- Modèles: `Property`, `PropertyImage`, `Reservation`, `Review`, `Payment`.
- Services: `AvailabilityService`, `BookingService`, `PaymentServiceMock`.
- Controllers RESTful pour propriétés, réservations et avis.
- Form Requests pour valider les entrées utilisateur.
- Policies basiques: modulation admin/owner.

MCD (Mermaid)

```mermaid
erDiagram
    USERS ||--o{ PROPERTIES : owns
    PROPERTIES ||--o{ PROPERTY_IMAGES : has
    PROPERTIES ||--o{ RESERVATIONS : booked_in
    USERS ||--o{ RESERVATIONS : makes
    RESERVATIONS ||--o{ PAYMENTS : has
    PROPERTIES ||--o{ REVIEWS : receives
    USERS ||--o{ REVIEWS : writes
    RESERVATIONS ||--o{ REVIEWS : may_generate
```

Prochaines étapes recommandées

- Intégrer Inertia + Vue pour le calendrier (ressource `resources/js/Pages`).
- Implémenter UI Blade/Tailwind pour les listing/détail.
- Brancher Stripe/PayPal via `PaymentServiceMock`.
- Ajouter tests PHPUnit pour Availability & BookingService.

Sécurité & bonnes pratiques

- Validation via FormRequest (déjà en place pour les endpoints principaux).
- Utiliser Policies pour restreindre accès (exemples fournis).
- Toujours vérifier disponibilité côté serveur avant création de réservation.

Si vous voulez, je peux :

- Implémenter le composant Vue calendrier (sélection de plages + affichage des dates bloquées).
- Ajouter pages Inertia/Vue pour les flows réservation et paiement mock.
- Écrire les tests unitaires pour `AvailabilityService` et `BookingService`.
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
