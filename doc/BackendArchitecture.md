# Architecture.md

# Arquitectura del Backend

## Stack tecnológico

* Laravel (última versión estable)
* PHP 8.x
* PostgreSQL + PostGIS
* Redis (colas y cache)
* Laravel Queue (Jobs)
* Storage S3 compatible (imágenes)
* Google Maps API (frontend)

---

# Principios de arquitectura

## 1. Separación estricta de lógica de negocio

La aplicación sigue el patrón:

> Ruta → Controller → FormRequest → UseCase → Model

---

## 2. Controllers delgados

Los controllers únicamente:

* reciben request
* validan mediante FormRequest
* delegan en UseCase

No contienen lógica de negocio.

---

## 3. UseCases como núcleo del sistema

Toda la lógica de negocio reside en:

```text
app/UseCases/
```

Cada acción importante del sistema es un UseCase independiente.

Ejemplo:

* CreateRestaurantUseCase
* PublishDailyMenuUseCase
* GetNearbyRestaurantsUseCase

---

## 4. Modelos simples (Eloquent)

Los modelos:

* representan datos
* relaciones
* scopes simples

No contienen lógica compleja.

---

## 5. Jobs para procesos asíncronos

Todo lo que no necesita respuesta inmediata se ejecuta en background:

* procesamiento de imágenes
* OCR de menús
* notificaciones
* generación de datos derivados

---

# Estructura del proyecto

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Restaurant/
│   │   │   └── RestaurantController.php
│   │   ├── Menu/
│   │   │   └── DailyMenuController.php
│   │   ├── Map/
│   │   │   └── MapController.php
│   │   └── Auth/
│   │       └── AuthController.php
│   │
│   ├── Requests/
│   │   ├── Restaurant/
│   │   │   ├── StoreRestaurantRequest.php
│   │   │   └── UpdateRestaurantRequest.php
│   │   ├── Menu/
│   │   │   ├── StoreDailyMenuRequest.php
│   │   │   └── PublishDailyMenuRequest.php
│   │   └── Auth/
│   │       └── LoginRequest.php
│   │
│   └── DTO/
│       ├── RestaurantDTO.php
│       └── MenuDTO.php
│
├── Models/
│   ├── User.php
│   ├── Restaurant.php
│   ├── DailyMenu.php
│   ├── Dish.php
│   ├── MenuItem.php
│   └── Review.php
│
├── UseCases/
│   ├── Restaurant/
│   │   ├── CreateRestaurantUseCase.php
│   │   ├── UpdateRestaurantUseCase.php
│   │   └── GetNearbyRestaurantsUseCase.php
│   │
│   ├── Menu/
│   │   ├── CreateDailyMenuUseCase.php
│   │   ├── PublishDailyMenuUseCase.php
│   │   ├── DuplicateMenuUseCase.php
│   │   └── GetTodayMenusUseCase.php
│   │
│   ├── Map/
│   │   └── GetMapRestaurantsUseCase.php
│   │
│   └── Review/
│       ├── RateRestaurantUseCase.php
│       └── RateDishUseCase.php
│
├── Jobs/
│   ├── ProcessMenuImageJob.php
│   ├── NotifyMenuPublishedJob.php
│   └── GenerateMenuAnalyticsJob.php
│
├── Services/
│   ├── GoogleMapsService.php
│   ├── ImageStorageService.php
│   └── OCRService.php
│
├── Enums/
│   ├── UserRole.php
│   ├── MenuStatus.php
│   └── DishType.php
│
└── Support/
    ├── Geo/
    │   └── PostGISHelper.php
    └── Response/
        └── ApiResponse.php
```

---

# Arquitectura de Rutas

Las rutas se agrupan por dominio:

```text
routes/
├── auth.php
├── restaurants.php
├── menus.php
├── map.php
├── reviews.php
```

Cada archivo contiene rutas REST simples:

* GET /restaurants
* POST /restaurants
* GET /menus/today
* POST /menus

---

# Patrón de ejecución

## Flujo estándar

```text
Request → Controller → FormRequest → UseCase → Model → Response
```

---

## Ejemplo

Crear menú del día:

1. Request valida datos
2. Controller delega
3. UseCase ejecuta lógica
4. Model persiste datos
5. Job opcional si hay procesamiento

---

# PostGIS (Geolocalización)

La ubicación es un elemento clave del sistema.

## Restaurant model

* location: geometry(Point, 4326)

---

## Consultas principales

### Restaurantes cercanos

```php
Restaurant::whereRaw(
    "ST_DWithin(location::geography, ST_MakePoint(?, ?)::geography, ?)",
    [$lng, $lat, $radius]
)->get();
```

---

### Bounding box (mapa)

```php
Restaurant::whereRaw(
    "ST_Within(location, ST_MakeEnvelope(?, ?, ?, ?, 4326))",
    [$xmin, $ymin, $xmax, $ymax]
)->get();
```

---

# Jobs y colas

Se utilizan para:

* OCR de menús
* procesamiento de imágenes
* notificaciones
* estadísticas futuras

---

# Autenticación

## Sistema

* Laravel Sanctum (recomendado)
* Tokens para API móvil/web

---

# API Design

## Estilo

* REST simple
* JSON estándar
* paginación consistente

---

## Ejemplo de respuesta

```json
{
  "data": [],
  "meta": {
    "page": 1,
    "per_page": 20
  }
}
```

---

# Servicios externos

## Google Maps

* frontend usa Maps API directamente
* backend solo almacena coordenadas

---

## OCR (Fase futura)

* extracción de menús desde imágenes
* ejecutado mediante Job

---

# Simplificaciones respecto a arquitecturas GIS complejas

Este proyecto NO necesita:

* multi-tenant por schema
* GeoServer
* generación dinámica de capas
* infraestructura GIS avanzada

---

# Filosofía clave

La arquitectura está optimizada para:

* velocidad de desarrollo
* claridad de dominio
* facilidad de uso con IA
* escalabilidad progresiva

---

# Objetivo

Permitir construir el sistema completo de forma incremental usando UseCases bien definidos y módulos independientes, manteniendo el backend predecible y fácil de extender.
