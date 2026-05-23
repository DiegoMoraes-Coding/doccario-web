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

## Global Context

This is a production-style SaaS frontend built for an international audience.

Even though it is a portfolio project, the UI and structure must follow real-world SaaS patterns used in modern web applications.

Prioritize:
- clean UI structure
- component reusability
- API-driven architecture
- consistency with modern SaaS dashboards