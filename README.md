Catalog Menu - Restaurant Order & Menu Dashboard
Usage
Clone the repository:
git clone https://github.com/SantoshYadav22/analytic-catalog-api.git
cd analytic-catalog-api

composer update
npm install
php artisan key:generate
php artisan migrate:fresh --seed for dummy data in table for cache.

A modern web dashboard built with Next.js, and Tailwind CSS for managing and analyzing restaurant menus and orders. This application allows restaurant managers to:

View detailed restaurant information (name, cuisine, rating, peak hours).
Track daily orders, revenue, and average order value.
Visualize order trends over a selected date range.
Open restaurant details in a modal view for quick insights.
Responsive design for both desktop and mobile.
Features
Dynamic restaurant pages using Next.js dynamic routing.
Modal-based restaurant details with scrollable order trends.
Grid-based cards for quick stats: Total Orders, Revenue, Avg Order Value, Peak Hour.
Easy integration with backend services (e.g., REST APIs for fetching orders and trends with cache).
Tailwind CSS for a clean and modern UI.
Tech Stack
Frontend: Next.js 15+, React 18+, Tailwind CSS
State Management: React Hooks
Backend: API services (mocked or integrated)

