# MVPExecutionPlan.md

# Plan de ejecución del MVP (2–3 semanas)

## Objetivo

Este documento define el orden exacto de implementación del sistema.

El objetivo es construir el MVP de forma incremental siguiendo este flujo:

> BBDD → Backend → Frontend → Validación → Ajustes finales

---

# Principios del plan

## 1. Diseño primero

La base de datos define todo el sistema.

---

## 2. Backend primero

Toda la lógica de negocio debe estar completa antes del frontend final.

---

## 3. Frontend después

El frontend se construye sobre una API estable.

---

## 4. Validación temprana obligatoria

Se incluye un checkpoint visual mínimo para evitar desalineación UX.

---

# FASE 1 — Diseño de base de datos (Día 1–2)

## Objetivo

Definir completamente el modelo de datos del sistema.

---

## Día 1 — Modelado principal

Tablas principales:

* users
* restaurants
* menus
* menu_sections
* dishes
* reviews_restaurants
* reviews_dishes

---

## Día 2 — Relaciones y geolocalización

### PostGIS

* restaurants.location (Point, 4326)
* índices espaciales (GIST)

---

### Relaciones clave

* Restaurant → Menus (1:N)
* Menu → Sections (1:N)
* Section → Dishes (1:N)

---

## Resultado

✔ Domain Model cerrado
✔ migraciones listas
✔ estructura estable

---

# FASE 2 — Backend (Día 3–10)

Arquitectura obligatoria:

> Route → Controller → FormRequest → UseCase → Model

---

# Día 3 — Base del backend

* Laravel setup
* Sanctum auth
* estructura UseCases
* ApiResponse estándar

---

# Día 4 — Autenticación

UseCases:

* RegisterUserUseCase
* LoginUserUseCase
* GetMeUseCase

Endpoints:

* POST /auth/register
* POST /auth/login
* GET /auth/me

---

# Día 5–6 — Restaurantes

UseCases:

* CreateRestaurantUseCase
* UpdateRestaurantUseCase
* GetRestaurantsUseCase
* GetNearbyRestaurantsUseCase

Endpoints:

* POST /restaurants
* GET /restaurants
* GET /restaurants/{id}

---

### PostGIS clave

```sql
ST_DWithin(location, point, radius)
```

---

# Día 7–8 — Menú del día (CORE DEL SISTEMA)

UseCases:

* CreateDailyMenuUseCase
* PublishDailyMenuUseCase
* DuplicateMenuUseCase
* GetTodayMenusUseCase

Endpoints:

* POST /restaurants/{id}/menus
* POST /menus/{id}/publish
* POST /menus/{id}/duplicate
* GET /menus/today
* GET /restaurants/{id}/menu/today

---

## Estructura de menú

* Sections
* Dishes
* Price global

---

# Día 9 — Mapa backend

UseCases:

* GetMapRestaurantsUseCase

Endpoints:

* GET /map/restaurants
* GET /map/menus

---

# Día 10 — Valoraciones

UseCases:

* RateRestaurantUseCase
* RateDishUseCase

Endpoints:

* POST /restaurants/{id}/reviews
* GET /restaurants/{id}/reviews

---

# CHECKPOINT OBLIGATORIO (fin Día 10)

## Mini frontend de validación (MUY simple)

Objetivo:

* ver mapa
* ver restaurantes
* ver menú del día

---

Si esto no funciona → NO avanzar.

---

# FASE 3 — Frontend completo (Día 11–17)

Stack:

* React
* TypeScript
* Tailwind
* React Query
* Google Maps

---

# Día 11–12 — Base frontend

* routing
* auth
* API layer
* layout base

---

# Día 13–14 — MAPA (CRÍTICO)

* Google Maps integration
* markers restaurantes
* popup menú del día
* click → restaurante

---

# Día 15 — Restaurante page

* info restaurante
* menú del día
* valoraciones

---

# Día 16 — UX optimización

* loading states
* skeletons
* mobile polish

---

# Día 17 — búsqueda y filtros

* search restaurants
* filtros por distancia

---

# FASE 4 — Preparación lanzamiento (Día 18–21)

---

# Día 18

* deploy backend
* deploy frontend

---

# Día 19

* seed de restaurantes en Albacete
* pruebas reales

---

# Día 20

* ajustes UX
* fixes críticos

---

# Día 21

* lanzamiento controlado
* onboarding manual de restaurantes

---

# MVP RESULTADO FINAL

El sistema debe permitir:

## Usuarios

* ver mapa
* ver restaurantes
* ver menús del día

---

## Restaurantes

* crear restaurante
* publicar menú diario
* duplicar menús

---

# FUERA DEL MVP

* OCR
* IA
* rankings
* favoritos
* carta avanzada
* recomendaciones

---

# OBJETIVO FINAL

Validar en condiciones reales:

> si los restaurantes publican menús de forma constante y si los usuarios usan el mapa para decidir dónde comer
