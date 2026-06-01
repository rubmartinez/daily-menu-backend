# MVPBacklog.md

# Backlog técnico del MVP

## Objetivo

Este documento divide la construcción del sistema en tareas pequeñas, ejecutables y ordenadas.

Cada tarea está diseñada para:

* durar entre 1 y 2 horas
* ser delegable a IA (Copilot / OpenCode)
* no requerir decisiones de arquitectura adicionales

---

# REGLAS DE EJECUCIÓN

* No cambiar arquitectura durante la implementación
* Seguir UseCase pattern estrictamente
* No añadir features fuera del MVP
* Cada tarea debe ser funcional y testeable

---

# FASE 1 — BASE DE DATOS

---

## TASK 1.1 — Users table

* Crear migración users
* Campos:

  * id
  * name
  * email
  * password
  * role
  * timestamps

---

## TASK 1.2 — Restaurants table

* Crear migración restaurants
* Campos:

  * id
  * user_id
  * name
  * description
  * address
  * location (PostGIS Point)
  * phone
  * timestamps

---

## TASK 1.3 — Menus table

* Crear migración menus
* Campos:

  * id
  * restaurant_id
  * title
  * price
  * status (draft/published)
  * date
  * timestamps

---

## TASK 1.4 — Menu sections

* menu_sections table
* menu_id
* name
* order

---

## TASK 1.5 — Dishes

* dishes table
* menu_section_id
* name
* description (nullable)

---

## TASK 1.6 — Reviews

### restaurants_reviews

* user_id
* restaurant_id
* rating
* comment

### dishes_reviews

* user_id
* dish_id
* rating
* comment

---

# FASE 2 — AUTH

---

## TASK 2.1 — Sanctum setup

* instalar Sanctum
* configurar middleware
* auth guard API

---

## TASK 2.2 — RegisterUserUseCase

* validar input
* crear usuario
* devolver token

---

## TASK 2.3 — LoginUserUseCase

* validar credenciales
* devolver token

---

## TASK 2.4 — GetMeUseCase

* devolver usuario autenticado

---

# FASE 3 — RESTAURANTES

---

## TASK 3.1 — CreateRestaurantUseCase

* crear restaurante
* asociar user_id
* guardar location

---

## TASK 3.2 — UpdateRestaurantUseCase

* actualizar datos básicos

---

## TASK 3.3 — GetRestaurantsUseCase

* listar restaurantes

---

## TASK 3.4 — GetNearbyRestaurantsUseCase ⭐

* usar PostGIS ST_DWithin
* filtrar por lat/lng/radius

---

## TASK 3.5 — RestaurantController

* conectar endpoints REST

---

# FASE 4 — MENÚ DEL DÍA (CORE)

---

## TASK 4.1 — CreateDailyMenuUseCase

* crear menú
* estado draft

---

## TASK 4.2 — AddMenuSectionsUseCase

* añadir secciones
* ordenar

---

## TASK 4.3 — AddDishesUseCase

* añadir platos a sección

---

## TASK 4.4 — PublishDailyMenuUseCase ⭐

* cambiar estado a published
* fijar fecha actual

---

## TASK 4.5 — DuplicateMenuUseCase ⭐

* clonar menú anterior
* duplicar secciones y platos

---

## TASK 4.6 — GetTodayMenusUseCase ⭐

* obtener menús publicados hoy

---

## TASK 4.7 — GetRestaurantTodayMenuUseCase

* menú activo de restaurante

---

# FASE 5 — MAPA (BACKEND)

---

## TASK 5.1 — GetMapRestaurantsUseCase

* restaurantes con menú activo

---

## TASK 5.2 — GetMapMenusUseCase

* menús por zona geográfica

---

# FASE 6 — REVIEWS

---

## TASK 6.1 — RateRestaurantUseCase

* crear review restaurante

---

## TASK 6.2 — RateDishUseCase

* crear review plato

---

## TASK 6.3 — GetRestaurantReviewsUseCase

---

# FASE 7 — CHECKPOINT FRONTEND MÍNIMO

---

## TASK 7.1 — Map basic page (React)

* render Google Maps
* fetch restaurantes
* markers

---

## TASK 7.2 — Menu popup

* mostrar menú del día en marker click

---

## TASK 7.3 — Restaurant page

* info básica
* menú del día

---

# FASE 8 — FRONTEND COMPLETO

---

## TASK 8.1 — Auth UI

* login
* register

---

## TASK 8.2 — Restaurant pages

* list
* detail

---

## TASK 8.3 — Menu pages

* render menú completo
* sections + dishes

---

## TASK 8.4 — Search + filters

* por distancia
* por nombre

---

## TASK 8.5 — UX polish

* loading states
* skeletons
* mobile optimization

---

# FASE 9 — DEPLOY

---

## TASK 9.1 — Backend deploy

* configurar env production
* migrate DB

---

## TASK 9.2 — Frontend deploy

* build production
* hosting

---

## TASK 9.3 — Seed data

* crear restaurantes en Albacete
* menus reales

---

# MVP FINAL CHECK

El sistema debe permitir:

* ver mapa
* ver restaurantes
* ver menú del día
* publicar menú desde backend

---

# DEFINICIÓN DE ÉXITO

Si en 7 días de uso real:

* restaurantes suben menús sin fricción
* usuarios consultan antes de comer

👉 el MVP es válido
