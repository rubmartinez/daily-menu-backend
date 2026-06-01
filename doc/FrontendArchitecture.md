# FrontendArchitecture.md

# Arquitectura del Frontend

## Stack tecnológico

* React (Vite)
* TypeScript
* TailwindCSS
* React Router
* React Query (TanStack Query)
* Google Maps JavaScript API
* Axios

---

# Principios de arquitectura

## 1. Frontend basado en features

El frontend no se organiza por tipo de archivo, sino por dominio:

* restaurants
* menus
* map
* reviews
* auth

---

## 2. Separación clara UI / lógica / API

* UI components → visual
* hooks → lógica
* services → llamadas API
* pages → composición

---

## 3. API-first

Todo el frontend depende de la API definida en Laravel.

No hay lógica duplicada.

---

# Estructura del proyecto

```text id="fe_struct"
src/
├── app/
│   ├── router/
│   │   └── AppRouter.tsx
│   ├── providers/
│   │   ├── AuthProvider.tsx
│   │   └── QueryProvider.tsx
│
├── pages/
│   ├── Home/
│   ├── Map/
│   ├── Restaurant/
│   ├── Menu/
│   └── Auth/
│
├── features/
│   ├── restaurants/
│   │   ├── components/
│   │   ├── hooks/
│   │   └── services/
│   │
│   ├── menus/
│   │   ├── components/
│   │   ├── hooks/
│   │   └── services/
│   │
│   ├── map/
│   │   ├── components/
│   │   ├── hooks/
│   │   └── services/
│   │
│   └── reviews/
│       ├── components/
│       ├── hooks/
│       └── services/
│
├── components/
│   ├── ui/
│   ├── layout/
│   └── shared/
│
├── services/
│   ├── api.ts
│   ├── http.ts
│   └── endpoints.ts
│
├── hooks/
│   ├── useAuth.ts
│   └── useGeolocation.ts
│
├── types/
│   ├── restaurant.ts
│   ├── menu.ts
│   └── user.ts
│
├── utils/
│   ├── format.ts
│   ├── geo.ts
│   └── constants.ts
│
└── styles/
    └── globals.css
```

---

# Pantallas principales (Pages)

## 1. HomePage

* búsqueda rápida
* acceso a mapa
* restaurantes destacados

---

## 2. MapPage ⭐ (core UX)

* Google Maps
* markers de restaurantes
* preview de menú del día
* filtros

---

## 3. RestaurantPage

* info restaurante
* menú del día
* carta digital
* reviews

---

## 4. MenuPage

* detalle completo del menú
* platos
* precio
* valoración

---

## 5. AuthPage

* login / registro

---

# Features (arquitectura por dominio)

---

## Restaurants Feature

Responsable de:

* listado de restaurantes
* detalle restaurante
* creación (owner)
* edición

---

## Menus Feature ⭐

Responsable de:

* menú del día
* historial
* duplicación visual
* render de platos

---

## Map Feature ⭐

Responsable de:

* Google Maps integration
* markers
* clustering
* geolocation
* filtros por radio

---

## Reviews Feature

Responsable de:

* rating restaurante
* rating platos
* comentarios

---

# Gestión de estado

## React Query (obligatorio)

Se usa para:

* fetching API
* cache
* sincronización

---

## Estado global mínimo

Solo para:

* usuario autenticado
* filtros de mapa

---

# API Layer

```text id="api_layer"
services/
  api.ts        → cliente base Axios
  endpoints.ts  → rutas centralizadas
```

---

# Map Architecture (Google Maps)

## Principios

* backend NO renderiza mapas
* frontend es dueño del mapa
* backend solo entrega coordenadas

---

## Flujo

1. fetch restaurantes
2. render markers
3. click marker → preview menu
4. open detail page

---

# Types (crítico para IA)

Todos los modelos deben estar tipados:

* Restaurant
* Menu
* Dish
* User

Esto mejora mucho la productividad con IA.

---

# UI Principles

* mobile-first
* mapa como pantalla principal
* 1 acción principal por pantalla
* información muy rápida (no formularios largos)

---

# Comunicación con backend

## REST API

* JSON puro
* paginación estándar
* errores consistentes

---

# Performance

* lazy loading por páginas
* caching con React Query
* mapa solo en MapPage (no global)

---

# Filosofía del frontend

El frontend está diseñado para:

* descubrir restaurantes en segundos
* ver menú del día sin fricción
* decidir dónde comer rápidamente

---

# Objetivo

Convertir el mapa en el punto de entrada principal del sistema y el menú del día en la unidad de decisión clave del usuario.
