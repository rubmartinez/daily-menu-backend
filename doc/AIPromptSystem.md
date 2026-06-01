# AIPromptSystem.md

# Sistema de prompts para desarrollo con IA

## Objetivo

Este documento define cómo interactuar con modelos de IA para construir el sistema de forma consistente, rápida y sin desviaciones de arquitectura.

---

# PRINCIPIO FUNDAMENTAL

La IA NO decide arquitectura.

La IA SOLO implementa.

Toda decisión estructural proviene de:

* Architecture.md
* ApiSpecification.md
* MVPBacklog.md

---

# FORMATO DE PROMPTS

## Regla base

Cada prompt debe contener:

1. Contexto mínimo
2. Tarea concreta
3. Restricciones de arquitectura
4. Output esperado

---

# PROMPT BASE (USECASE BACKEND)

## Uso estándar

```text id="usecase_prompt"
Implementa un UseCase en Laravel siguiendo esta arquitectura:

- Route → Controller → FormRequest → UseCase → Model
- No incluir lógica en Controller
- Usar Eloquent
- Usar naming del dominio existente

Contexto:
{DOMAIN CONTEXT}

Tarea:
{USECASE DESCRIPTION}

Output:
- Clase UseCase completa
- Métodos necesarios
- Sin explicación
```

---

## Ejemplo real

```text id="example_usecase"
Implementa CreateRestaurantUseCase.

Reglas:
- usar PostGIS para location
- asociar user_id autenticado
- validar input en FormRequest
- devolver DTO de restaurante creado

Output:
solo código
```

---

# PROMPT CONTROLLER

```text id="controller_prompt"
Crea un Controller en Laravel.

Reglas:
- No lógica de negocio
- Solo delegar a UseCase
- Usar FormRequest
- Seguir ApiResponse estándar

Tarea:
{CONTROLLER TASK}

Output:
solo código
```

---

# PROMPT FORMREQUEST

```text id="formrequest_prompt"
Crea un FormRequest de Laravel.

Reglas:
- validación estricta
- sin lógica adicional
- mensajes claros

Tarea:
{VALIDATION RULES}

Output:
solo código
```

---

# PROMPT MIGRACIÓN BBDD

```text id="migration_prompt"
Crea migración Laravel.

Reglas:
- PostgreSQL compatible
- incluir timestamps
- usar tipos correctos
- si hay ubicación usar PostGIS geometry(Point, 4326)

Tarea:
{TABLE DESCRIPTION}

Output:
solo código migración
```

---

# PROMPT FRONTEND COMPONENTE

```text id="frontend_component"
Crea un componente React en TypeScript.

Stack:
- React + Vite
- TailwindCSS
- React Query para datos

Reglas:
- componente funcional
- sin lógica de API dentro (usar service)
- mobile-first
- limpio y reutilizable

Tarea:
{COMPONENT DESCRIPTION}

Output:
solo código
```

---

# PROMPT FRONTEND PAGE

```text id="frontend_page"
Crea una página React.

Reglas:
- usar React Router
- usar hooks de features
- consumir API desde services/
- separar UI y lógica

Tarea:
{PAGE DESCRIPTION}

Output:
solo código
```

---

# PROMPT API SERVICE

```text id="api_service_prompt"
Crea servicio de API en frontend.

Reglas:
- usar axios instance central
- tipado TypeScript
- endpoints centralizados

Tarea:
{SERVICE DESCRIPTION}

Output:
solo código
```

---

# PROMPT POSTGIS / GEO QUERY

```text id="postgis_prompt"
Implementa consulta usando PostgreSQL + PostGIS.

Reglas:
- usar ST_DWithin para radio
- usar ST_MakePoint para coordenadas
- optimizar query
- no lógica en PHP innecesaria

Tarea:
{GEOSPATIAL REQUIREMENT}

Output:
solo query o UseCase necesario
```

---

# PROMPT DEBUG / FIX

```text id="debug_prompt"
Corrige este código manteniendo arquitectura existente.

Reglas:
- no cambiar estructura del sistema
- no añadir dependencias nuevas
- mantener UseCase pattern
- explicar solo si es necesario

Código:
{CODE}

Problema:
{ISSUE}

Output:
código corregido
```

---

# PROMPT PARA IA AGENTE (OpenCode / Copilot Chat)

```text id="agent_prompt"
Trabaja como desarrollador senior Laravel + React.

Sigue estrictamente:

Architecture.md
ApiSpecification.md
MVPBacklog.md

Reglas:
- no inventar endpoints
- no cambiar modelos
- no romper arquitectura UseCase
- dividir en pasos si es necesario

Tarea:
{TASK}

Output:
código listo para producción
```

---

# FLUJO RECOMENDADO DE USO

## Backend

1. Leer MVPBacklog
2. Copiar TASK
3. Usar prompt UseCase / Controller / Migration
4. Validar

---

## Frontend

1. Usar prompt Page / Component
2. Conectar a API existente
3. No inventar lógica backend

---

# REGLAS CRÍTICAS

## 1. IA NO puede:

* redefinir dominio
* cambiar estructura de DB
* inventar endpoints

---

## 2. IA SI puede:

* generar código completo
* refactorizar dentro del patrón
* optimizar queries
* crear UI

---

## 3. Si hay duda:

* seguir ApiSpecification.md
* no improvisar

---

# OBJETIVO FINAL DEL SISTEMA

Convertir el desarrollo en:

> ejecución de tareas pequeñas + generación automática de código consistente
