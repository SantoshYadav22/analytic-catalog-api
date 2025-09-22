# Catalog Menu – Restaurant Order & Menu Dashboard

A modern web dashboard built with **Next.js** and **Tailwind CSS** for managing and analyzing restaurant menus and orders.

---

## **Features**

- Dynamic restaurant pages using **Next.js** dynamic routing
- Modal-based restaurant details with scrollable order trends
- Grid-based cards for quick stats: Total Orders, Revenue, Avg Order Value, Peak Hour
- View detailed restaurant information (name, cuisine, rating, peak hours)
- Track daily orders, revenue, and average order value
- Visualize order trends over a selected date range
- Fully responsive design for desktop and mobile
- Easy integration with backend services (REST APIs for fetching orders and trends with cache)

---

## **Tech Stack**

- **Frontend:** Next.js 15+, React 18+, Tailwind CSS
- **State Management:** React Hooks
- **Backend:** Laravel API services (mocked or integrated)

---

## **Installation**

### **Backend (Laravel API)**

```bash
git clone https://github.com/SantoshYadav22/analytic-catalog-api.git
cd analytic-catalog-api
composer update
npm install
php artisan key:generate
php artisan migrate:fresh --seed   # Seeds dummy data for caching
start laravel herd                 # Runs the backend API at http://analytic-catalog-api.test

git clone https://github.com/SantoshYadav22/analytic-catalog-ui.git
cd analytic-catalog-ui
npm install
npm run dev
# Open http://localhost:3000 in your browser

