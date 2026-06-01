# Modules.md

# Módulos del Sistema

## Objetivo

Este documento divide la plataforma en módulos funcionales independientes.

Cada módulo representa una capacidad de negocio del sistema.

La implementación se organiza en fases de desarrollo para permitir una entrega incremental y validación temprana del producto.

---

# Fases de desarrollo

En lugar de MVP/V1/Futuro, el sistema se divide en 4 fases:

## Fase 1 — MVP real (Validación del producto)

Objetivo: validar que los restaurantes publican menús y los usuarios los consultan.

---

## Fase 2 — Retención y facilidad de uso

Objetivo: reducir fricción en restaurantes y mejorar adopción.

---

## Fase 3 — Engagement del usuario

Objetivo: aumentar recurrencia y valor de la plataforma.

---

## Fase 4 — Inteligencia y escalado

Objetivo: automatización, IA y ventajas competitivas.

---

# Módulo 1: Gestión de Usuarios

## Estado

Fase 1

---

## Objetivo

Permitir autenticación y roles básicos.

---

## Tipos de usuario

### Cliente

* consultar restaurantes
* consultar menús

### Propietario

* gestionar restaurantes
* gestionar menús

### Admin

* moderación básica

---

## Funcionalidades

* Registro
* Login
* Perfil básico

---

# Módulo 2: Gestión de Restaurantes

## Estado

Fase 1

---

## Objetivo

Crear y visualizar restaurantes en el sistema.

---

## Funcionalidades

* Crear restaurante
* Editar información básica
* Ubicación (lat/lng)
* Información de contacto

---

# Módulo 3: Menú del Día

## Estado

Fase 1

---

## Objetivo

Core del producto: publicación diaria de menús.

---

## Funcionalidades

* Crear menú diario
* Publicar menú
* Editar menú
* Ver menú actual
* Historial básico

---

# Módulo 4: Descubrimiento en Mapa

## Estado

Fase 1

---

## Objetivo

Permitir descubrir restaurantes cercanos con menú activo.

---

## Funcionalidades

* Mapa con restaurantes
* Geolocalización
* Ver menú del día desde mapa

---

# Módulo 5: Consulta de Menús

## Estado

Fase 1

---

## Objetivo

Visualización rápida del menú del día.

---

## Funcionalidades

* Ver menú de hoy
* Ver restaurante asociado
* Precio
* Platos incluidos

---

# Módulo 6: Carta Digital

## Estado

Fase 2

---

## Objetivo

Dar valor adicional al restaurante para mejorar adopción.

---

## Funcionalidades

* Carta digital básica
* Categorías
* Productos
* Precios

---

# Módulo 7: Automatización de Menús

## Estado

Fase 2

---

## Objetivo

Reducir esfuerzo operativo de los restaurantes.

---

## Funcionalidades

* Duplicar menú anterior
* Plantillas simples por día
* Repetición semanal básica

---

# Módulo 8: QR Dinámicos

## Estado

Fase 2

---

## Objetivo

Facilitar acceso físico a menús y cartas.

---

## Funcionalidades

* Generar QR
* Acceso a carta o menú
* Descarga de QR

---

# Módulo 9: Valoraciones de Restaurantes

## Estado

Fase 3

---

## Objetivo

Introducir feedback general del restaurante.

---

## Funcionalidades

* Puntuación
* Comentario
* Media de valoración

---

# Módulo 10: Valoraciones de Platos

## Estado

Fase 3

---

## Objetivo

Crear base de datos de calidad de platos.

---

## Funcionalidades

* Valorar platos
* Comentarios
* Media por plato

---

# Módulo 11: Favoritos

## Estado

Fase 3

---

## Objetivo

Mejorar retención de usuarios.

---

## Funcionalidades

* Guardar restaurantes
* Guardar platos

---

# Módulo 12: OCR de Menús

## Estado

Fase 4

---

## Objetivo

Automatizar la creación de menús desde imágenes.

---

## Flujo

1. Subida de imagen
2. IA detecta contenido
3. Generación de menú
4. Confirmación del restaurante

---

# Módulo 13: Panel de Administración

## Estado

Fase 4

---

## Objetivo

Gestión interna de la plataforma.

---

## Funcionalidades

* Gestión de usuarios
* Gestión de restaurantes
* Moderación

---

# Módulo 14: Rankings

## Estado

Fase 4

---

## Objetivo

Generar descubrimiento avanzado.

---

## Ejemplos

* Mejores menús del día
* Mejores platos
* Mejores restaurantes calidad/precio

---

# Módulo 15: Recomendaciones Inteligentes

## Estado

Fase 4

---

## Objetivo

Personalización basada en datos.

---

## Funcionalidades

* Recomendación de restaurantes
* Recomendación de platos
* Similitud entre usuarios

---

# Módulo 16: Nutrición y Alérgenos

## Estado

Fase 4

---

## Objetivo

Capa avanzada de información alimentaria.

---

## Funcionalidades

* Calorías
* Alérgenos
* Información nutricional

---

# Resumen de Fase 1 (MVP real)

La Fase 1 debe ser extremadamente simple:

* Usuarios básicos
* Restaurantes
* Menú del día
* Mapa
* Consulta de menú

Nada más.

---

# Objetivo del sistema

Validar dos cosas:

1. Los restaurantes publican menús de forma recurrente.
2. Los usuarios usan la plataforma para decidir dónde comer.

Todo lo demás es optimización posterior.
