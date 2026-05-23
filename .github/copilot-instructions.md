# Doccario Web - Frontend Layer

This is the presentation layer built with Laravel Blade + Tabler UI.

It is NOT a backend system.

It only consumes the ASP.NET Core API.

---

## Responsibilities

- Render UI (Blade templates)
- Use Tabler UI for dashboard layout
- Send requests to backend API
- Display chat, documents, and responses

---

## Strict Rules

- NO business logic in Laravel
- NO database access
- NO AI integration
- NO document processing
- All logic comes from backend API

---

## Frontend Interactivity Rules

- Use Alpine.js for all UI reactivity (modals, dropdowns, toggles, dynamic states)
- Avoid raw JavaScript for DOM manipulation
- Do NOT create custom JS logic unless absolutely necessary
- Prefer declarative UI behavior using Alpine.js directives (x-data, x-show, x-on, etc.)

---

## Styling Rules

- Prioritize Tabler UI and Bootstrap utility classes for all styling
- Avoid custom CSS as much as possible
- Use predefined classes instead of creating new stylesheets
- Only write custom CSS when a feature cannot be achieved with existing Tabler/Bootstrap utilities
- Maintain consistency with Tabler UI design system across all pages
- Prefer reusable UI components over custom styled elements

---

## API Communication

Laravel acts as a client:

- Fetch documents from API
- Send chat messages to API
- Upload PDFs via API
- Display responses from API

---

## UI Structure

- Dashboard layout (Tabler)
- Sidebar:
  - Documents
  - Chat
  - Settings
- Main area:
  - Chat interface (like ChatGPT style)

---

## Data Flow

Frontend → API → Backend → AI → Backend → Frontend

Laravel is ONLY the UI layer.

---

## Global Context

This is a production-style SaaS frontend built for an international audience.

Even though it is a portfolio project, the UI and structure must follow real-world SaaS patterns used in modern web applications.

Prioritize:
- clean UI structure
- component reusability
- API-driven architecture
- consistency with modern SaaS dashboards# Doccario Web - Frontend Layer

This is the presentation layer built with Laravel Blade + Tabler UI.

It is NOT a backend system.

It only consumes the ASP.NET Core API.

---

## Responsibilities

- Render UI (Blade templates)
- Use Tabler UI for dashboard layout
- Send requests to backend API
- Display chat, documents, and responses

---

## Strict Rules

- NO business logic in Laravel
- NO database access
- NO AI integration
- NO document processing
- All logic comes from backend API

---

## Frontend Interactivity Rules

- Use Alpine.js for all UI reactivity (modals, dropdowns, toggles, dynamic states)
- Avoid raw JavaScript for DOM manipulation
- Do NOT create custom JS logic unless absolutely necessary
- Prefer declarative UI behavior using Alpine.js directives (x-data, x-show, x-on, etc.)

---

## Styling Rules

- Prioritize Tabler UI and Bootstrap utility classes for all styling
- Avoid custom CSS as much as possible
- Use predefined classes instead of creating new stylesheets
- Only write custom CSS when a feature cannot be achieved with existing Tabler/Bootstrap utilities
- Maintain consistency with Tabler UI design system across all pages
- Prefer reusable UI components over custom styled elements
- Do not use color classes in the HTML. Use Tabler's predefined color schemes and components to ensure consistency, and light/dark mode support without hardcoding colors in the markup.
- Support for mobile devices is required. Use Tabler's responsive grid and utility classes to ensure the UI adapts well to different screen sizes without needing custom media queries or CSS.

---

## API Communication

Laravel acts as a client:

- Fetch documents from API
- Send chat messages to API
- Upload PDFs via API
- Display responses from API

---

## UI Structure

- Dashboard layout (Tabler)
- Sidebar:
  - Documents
  - Chat
  - Settings
- Main area:
  - Chat interface (like ChatGPT style)

---

## Data Flow

Frontend → API → Backend → AI → Backend → Frontend

Laravel is ONLY the UI layer.

---

## Global Context

This is a production-style SaaS frontend built for an international audience.

Even though it is a portfolio project, the UI and structure must follow real-world SaaS patterns used in modern web applications.

Prioritize:
- clean UI structure
- component reusability
- API-driven architecture
- consistency with modern SaaS dashboards