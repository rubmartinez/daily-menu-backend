# ApiSpecification.md

# Especificación de la API

## Objetivo

Este documento define los endpoints REST del sistema.

La API está diseñada para:

* ser simple
* ser consistente
* ser fácil de consumir desde React
* permitir generación automática de código con IA

---

# Convenciones generales

## Base URL

```
/api
```

---

## Formato de respuesta estándar

```json id="resp_std"
{
  "data": {},
  "meta": {},
  "error": null
}
```

---

## Formato de error

```json id="error_std"
{
  "data": null,
  "error": {
    "code": "VALIDATION_ERROR",
    "message": "Invalid input",
    "fields": {}
  }
}
```

---

## Paginación

```json id="pagination"
{
  "data": [],
  "meta": {
    "page": 1,
    "per_page": 20,
    "total": 120
  }
}
```

---

# AUTENTICACIÓN

---

## POST /auth/register

Registra usuario.

### Request

```json
{
  "name": "string",
  "email": "string",
  "password": "string"
}
```

---

## POST /auth/login

### Request

```json
{
  "email": "string",
  "password": "string"
}
```

### Response

```json
{
  "data": {
    "token": "jwt_token",
    "user": {}
  }
}
```

---

## GET /auth/me

Devuelve usuario autenticado.

---

# RESTAURANTES

---

## GET /restaurants

Lista restaurantes.

### Query params

* lat
* lng
* radius (metros)
* search

---

## GET /restaurants/{id}

Detalle restaurante.

Incluye:

* información básica
* menú del día activo
* rating medio

---

## POST /restaurants

Crear restaurante (owner).

### Request

```json
{
  "name": "string",
  "description": "string",
  "address": "string",
  "lat": 0,
  "lng": 0,
  "phone": "string"
}
```

---

## PUT /restaurants/{id}

Actualizar restaurante.

---

## DELETE /restaurants/{id}

Eliminar restaurante.

---

# MENÚ DEL DÍA

---

## GET /menus/today

Devuelve todos los menús activos del día.

### Query params

* lat
* lng
* radius

---

## GET /restaurants/{id}/menu/today

Menú del día de un restaurante.

---

## GET /restaurants/{id}/menus

Historial de menús.

---

## POST /restaurants/{id}/menus

Crear menú del día.

### Request

```json
{
  "title": "Menu del día",
  "price": 12.50,
  "sections": [
    {
      "name": "Primeros",
      "dishes": [
        {
          "name": "Paella"
        }
      ]
    }
  ]
}
```

---

## POST /menus/{id}/publish

Publicar menú.

---

## POST /menus/{id}/duplicate

Duplicar menú anterior.

---

# MAPA

---

## GET /map/restaurants

Devuelve restaurantes visibles en mapa.

### Query params

* lat
* lng
* radius
* bounds (bbox)

---

## GET /map/menus

Menús activos dentro de área geográfica.

---

# CARTA DIGITAL

---

## GET /restaurants/{id}/menu-card

Devuelve carta completa del restaurante.

---

## POST /restaurants/{id}/menu-card

Crear carta digital.

---

## PUT /menu-card/{id}

Actualizar carta.

---

# VALORACIONES RESTAURANTES

---

## GET /restaurants/{id}/reviews

---

## POST /restaurants/{id}/reviews

### Request

```json
{
  "rating": 1-5,
  "comment": "string"
}
```

---

# VALORACIONES PLATOS

---

## GET /dishes/{id}/reviews

---

## POST /dishes/{id}/reviews

### Request

```json
{
  "rating": 1-5,
  "comment": "string"
}
```

---

# PLATOS

---

## GET /dishes/search

### Query params

* q

---

## GET /dishes/{id}

Detalle plato.

---

# FAVORITOS

---

## GET /favorites/restaurants

---

## POST /favorites/restaurants/{id}

---

## DELETE /favorites/restaurants/{id}

---

## GET /favorites/dishes

---

## POST /favorites/dishes/{id}

---

## DELETE /favorites/dishes/{id}

---

# QR

---

## GET /restaurants/{id}/qr

Devuelve QR del restaurante.

Tipos:

* menu
* card

---

# ADMIN (FUTURO / FASE 4)

---

## GET /admin/restaurants

---

## POST /admin/restaurants/{id}/verify

---

## GET /admin/users

---

# REGLAS IMPORTANTES

---

## 1. Menú del día es el núcleo

Todos los endpoints relacionados deben optimizarse para:

* lectura rápida
* geolocalización
* bajo payload

---

## 2. PostGIS obligatorio en queries geográficas

* radio
* bounding box

---

## 3. Menú siempre tiene estructura jerárquica

```
Menu → Sections → Dishes
```

---

## 4. La API es stateless

* no sesiones
* solo JWT / Sanctum

---

# MVP API (CRÍTICO)

Solo estos endpoints son necesarios para Fase 1:

### AUTH

* register
* login
* me

### RESTAURANTS

* CRUD básico
* nearby search

### MENÚ

* create
* publish
* today
* restaurant today

### MAP

* restaurants nearby

---

# OBJETIVO

Esta API está diseñada para permitir:

> construir el MVP completo en pocas semanas usando IA como generador principal de código backend y frontend.
