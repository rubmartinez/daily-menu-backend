# AIDevWorkflow.md

# Flujo de desarrollo con IA

## Objetivo

Definir un proceso diario de trabajo para construir el MVP utilizando IA como desarrollador principal, manteniendo consistencia arquitectónica y velocidad de ejecución.

---

# PRINCIPIO FUNDAMENTAL

La IA construye.

El desarrollador decide.

---

# CICLO DE DESARROLLO (CORE LOOP)

Cada feature se construye siguiendo este ciclo:

## 1. Seleccionar tarea

Desde:

* MVPBacklog.md

---

## 2. Entender contexto

Leer:

* ApiSpecification.md
* Architecture.md
* DomainModel.md (si aplica)

---

## 3. Generar implementación con IA

Usar:

* AIPromptSystem.md

Ejemplo:

> “Implementa TASK 4.4 (PublishDailyMenuUseCase)”

---

## 4. Integrar código

* conectar UseCase → Controller → Route
* verificar naming
* revisar estructura

---

## 5. Validar funcionalidad

* test manual rápido
* Postman o frontend básico
* comprobar respuesta API

---

## 6. Cerrar tarea

* marcar TASK como completada
* continuar siguiente tarea

---

# FLUJO DIARIO DE TRABAJO

## Día de desarrollo ideal

---

## BLOQUE 1 (30–60 min)

* seleccionar 2–3 tareas pequeñas del backlog
* generar código con IA
* integrar backend

---

## BLOQUE 2 (60–120 min)

* validar endpoints
* corregir errores
* refactor mínimo si es necesario

---

## BLOQUE 3 (opcional frontend)

* conectar endpoint a React
* test visual básico

---

# REGLAS DE CONSISTENCIA

## 1. Nunca improvisar arquitectura

Si algo no está en:

* Architecture.md
* ApiSpecification.md

👉 no existe

---

## 2. No mezclar capas

* Controller = delega
* UseCase = lógica
* Model = datos

---

## 3. IA siempre trabaja en tareas pequeñas

❌ mal:

> “haz toda la app de menús”

✔ bien:

> “implementa CreateDailyMenuUseCase”

---

## 4. Cambios grandes están prohibidos sin actualización documental

Si algo cambia:

* actualizar ApiSpecification.md
* actualizar MVPBacklog.md

---

# GESTIÓN DE ERRORES

## Si algo falla:

1. no reescribir todo
2. aislar UseCase afectado
3. regenerar con IA usando prompt DEBUG
4. validar solo ese flujo

---

# DEFINICIÓN DE “DONE”

Una tarea está terminada cuando:

* endpoint funciona
* datos correctos en DB
* cumple API spec
* frontend puede consumirlo (si aplica)

---

# ESTRATEGIA DE VELOCIDAD

## Regla clave

> Siempre trabajar en vertical slices pequeños

Ejemplo correcto:

* CreateRestaurantUseCase
* endpoint
* test en mapa

NO:

* todo backend primero
* todo frontend después

---

# CONTROL DE CALIDAD

Cada día revisar:

* coherencia de endpoints
* consistencia de nombres
* duplicación de lógica
* uso correcto de UseCases

---

# USO DE IA (ESTRATEGIA ÓPTIMA)

## IA se usa para:

* generar código completo
* refactorizar UseCases
* crear endpoints
* generar componentes React
* escribir queries PostGIS

---

## IA NO se usa para:

* decidir arquitectura
* redefinir dominio
* cambiar API sin control

---

# OBJETIVO FINAL DEL WORKFLOW

Permitir que una sola persona:

> construya un sistema completo tipo startup usando IA como equipo de desarrollo paralelo

---

# MÉTRICA DE ÉXITO

El sistema es exitoso si:

* se completan 5–10 tasks/día
* backend avanza sin bloqueos
* frontend se conecta sin reescrituras
* no hay cambios constantes de arquitectura

---

# RESULTADO FINAL

Este workflow convierte el desarrollo en:

> ejecución sistemática de tareas pequeñas + generación automática de código consistente + validación continua
