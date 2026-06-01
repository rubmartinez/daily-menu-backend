# DomainModel.md

# Modelo de Dominio

## Objetivo

Este documento define las entidades principales del sistema y las relaciones entre ellas.

El objetivo es crear una base de datos preparada para:

* Descubrimiento de menús del día.
* Cartas digitales.
* Valoraciones de restaurantes.
* Valoraciones de platos.
* Automatización de menús recurrentes.
* Recomendaciones futuras basadas en IA.

---

# Principios de Diseño

## El plato es una entidad de primer nivel

Los platos son uno de los activos más importantes de la plataforma.

Deben poder:

* aparecer en cartas
* aparecer en menús
* recibir valoraciones
* ser buscados
* ser recomendados
* ser analizados por IA

---

## Separar plantilla y publicación

Un restaurante puede tener:

* una plantilla de menú recurrente
* una publicación concreta para un día específico

Esto permitirá automatizar la creación de menús diarios.

---

# Entidades

---

# User

Representa cualquier usuario registrado.

## Campos

* id
* name
* email
* password
* role
* created_at
* updated_at

## Roles

* customer
* restaurant_owner
* admin

---

# Restaurant

Representa un restaurante dentro de la plataforma.

## Campos

* id
* owner_id
* name
* slug
* description
* phone
* email
* website
* address
* city
* postal_code
* latitude
* longitude
* logo_url
* cover_image_url
* is_verified
* created_at
* updated_at

## Relaciones

Restaurant

* pertenece a User
* tiene muchas cartas
* tiene muchos menús
* tiene muchas valoraciones

---

# RestaurantSchedule

Horario de apertura.

## Campos

* id
* restaurant_id
* day_of_week
* open_time
* close_time

---

# Menu

Representa un menú publicado para una fecha concreta.

## Campos

* id
* restaurant_id
* menu_template_id (nullable)
* date
* title
* description
* price
* status
* created_at
* updated_at

## Estados

* draft
* scheduled
* published
* archived

## Ejemplos

Menú publicado para:

* 15/05/2027
* 16/05/2027
* 17/05/2027

Cada día genera una instancia independiente.

---

# MenuTemplate

Plantilla reutilizable.

Permite automatización.

## Campos

* id
* restaurant_id
* name
* recurrence_type
* is_active

## Recurrence Type

* monday
* tuesday
* wednesday
* thursday
* friday
* saturday
* sunday

## Ejemplo

"Menú habitual de los martes"

---

# MenuSection

Agrupa platos dentro de un menú.

## Campos

* id
* menu_id
* name
* order

## Ejemplos

* Primeros
* Segundos
* Postres
* Bebidas

---

# Dish

Representa un plato reutilizable.

## Campos

* id
* name
* description
* image_url
* dish_type
* created_at
* updated_at

## Ejemplos

* Paella Valenciana
* Lentejas
* Flan casero

---

# MenuDish

Relación entre menú y plato.

## Campos

* id
* menu_id
* menu_section_id
* dish_id
* position

---

# MenuTemplateDish

Relación entre plantilla y platos.

## Campos

* id
* menu_template_id
* dish_id
* position

---

# MenuImage

Imágenes asociadas al menú.

## Campos

* id
* menu_id
* image_url
* source_type

## Source Type

* upload
* ocr
* generated

---

# MenuOCRJob

Procesamiento de imágenes mediante IA.

## Campos

* id
* restaurant_id
* image_url
* status
* extracted_data
* processed_at

## Estados

* pending
* processing
* completed
* failed

---

# DigitalMenu

Carta digital permanente.

## Campos

* id
* restaurant_id
* title
* description

---

# DigitalMenuCategory

Categorías de la carta.

## Campos

* id
* digital_menu_id
* name
* position

## Ejemplos

* Entrantes
* Bocadillos
* Hamburguesas
* Postres

---

# DigitalMenuItem

Elemento de carta.

## Campos

* id
* category_id
* dish_id (nullable)
* name
* description
* price
* image_url
* is_available

---

# RestaurantReview

Valoración general del restaurante.

## Campos

* id
* restaurant_id
* user_id
* rating
* comment
* created_at

---

# DishReview

Valoración de un plato.

## Campos

* id
* dish_id
* user_id
* rating
* comment
* created_at

---

# FavoriteRestaurant

Restaurantes favoritos.

## Campos

* id
* user_id
* restaurant_id

---

# FavoriteDish

Platos favoritos.

## Campos

* id
* user_id
* dish_id

---

# QRCode

Código QR generado por la plataforma.

## Campos

* id
* restaurant_id
* target_type
* target_id
* qr_url

## Target Type

* digital_menu
* daily_menu

---

# Relaciones Principales

User
→ Restaurant

Restaurant
→ Menu

Restaurant
→ MenuTemplate

Restaurant
→ DigitalMenu

Menu
→ MenuSection

MenuSection
→ MenuDish

MenuDish
→ Dish

DigitalMenu
→ DigitalMenuCategory

DigitalMenuCategory
→ DigitalMenuItem

Dish
→ DishReview

Restaurant
→ RestaurantReview

User
→ FavoriteRestaurant

User
→ FavoriteDish

---

# Entidades Futuras

No forman parte del MVP.

## DishNutrition

Información nutricional.

---

## DishAllergen

Gestión de alérgenos.

---

## UserPreference

Preferencias gastronómicas.

---

## Recommendation

Sistema de recomendaciones IA.

---

## MenuPrediction

Predicción automática de menús recurrentes.
