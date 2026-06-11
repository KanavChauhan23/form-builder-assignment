# Frontend UI Developer Assignment — Form Builder

A drag-and-drop Form Builder built on the provided Laravel scaffold.

## Live Preview
> Run locally with `php artisan serve` → open `http://localhost:8000`

---

## Setup (3 steps)

```bash
# 1. Install PHP dependencies
composer install

# 2. Copy environment file (APP_KEY is already set)
cp .env.example .env

# 3. Serve
php artisan serve
```

No database migrations required. No npm/build step required.

---

## Features Built

| Feature | Status |
|---|---|
| Drag fields from palette onto canvas | ✅ |
| Reorder fields by dragging handle | ✅ |
| All 18 field types (Text, Textarea, Number, Email, Phone, Date, File, Dropdown, Radio, Checkbox, Title, Description, New Line, Page Break, Hidden, State, City, State & City) | ✅ |
| Edit icon → Field Options panel (Label, Placeholder, Min/Max chars, Options list, Required toggle, CSS Class, Default value) | ✅ |
| Duplicate field | ✅ |
| Delete with confirmation toast | ✅ |
| Form title (max 200 chars, live counter) | ✅ |
| Submission URL display | ✅ |
| Form Preview modal | ✅ |
| Next → prints full JSON schema to console + modal | ✅ |
| Cancel (clears form with confirm) | ✅ |
| Undo / Redo (Ctrl+Z / Ctrl+Y, unlimited) | ✅ |
| LocalStorage persistence (survives page refresh) | ✅ |
| Responsive down to 1024px | ✅ |
| Blade components (`<x-form-input>`) | ✅ |
| Settings tab | ✅ |

---

## Drag-and-Drop Library

**SortableJS v1.15.2** — loaded via CDN (`cdnjs.cloudflare.com`).

**Why SortableJS:**
- Supports both *cross-list clone-dragging* (palette → canvas) and *within-list reordering* with a single API
- Zero dependencies, no build step needed — drops straight into a Laravel Blade project
- Battle-tested (100M+ weekly npm downloads), works reliably across all browsers
- Lightweight (~30KB), far less overhead than jQuery UI Sortable

---

## Sample JSON Output (clicking "Next")

```json
{
  "formTitle": "Contact Us",
  "submissionUrl": "http://localhost:8000/submit-form",
  "createdAt": "2026-06-11T10:30:00.000Z",
  "totalFields": 4,
  "fields": [
    {
      "id": "f17496312340abc",
      "type": "text",
      "label": "Full Name",
      "required": true,
      "placeholder": "Enter your full name...",
      "minChars": "2",
      "maxChars": "100"
    },
    {
      "id": "f17496312341def",
      "type": "email",
      "label": "Email Address",
      "required": true,
      "placeholder": "you@example.com"
    },
    {
      "id": "f17496312342ghi",
      "type": "dropdown",
      "label": "Subject",
      "required": false,
      "options": ["General Inquiry", "Technical Support", "Billing"]
    },
    {
      "id": "f17496312343jkl",
      "type": "textarea",
      "label": "Message",
      "required": true,
      "placeholder": "Write your message..."
    }
  ]
}
```

---

## Project Structure (changed files)

```
resources/
  views/
    form.blade.php                    ← Main form builder view + all JS
    layouts/admin.blade.php           ← Layout (adds SortableJS CDN + form-builder.css)
    components/
      field-tiles.blade.php           ← Draggable palette tiles (all 18 types)
      field-options.blade.php         ← Edit panel (label, placeholder, options, etc.)
      form-input.blade.php            ← Reusable <x-form-input> Blade component
app/
  Http/Controllers/GuestController.php  ← Sets $title, renders form view
public/
  css/form-builder.css               ← All builder styles (Inter font, CSS variables)
routes/
  web.php                            ← Single route: / → GuestController
```

---

## Assumptions

1. No backend persistence required — form state is saved to `localStorage`.
2. Bootstrap 4 + jQuery are already included via the project's `includes/js.blade.php` and `includes/css.blade.php`.
3. The "Next" button logs the JSON schema to `console.log` and displays it in a modal — no HTTP POST endpoint is required per the assignment spec.
4. Internet access is available to load SortableJS from cdnjs and the Inter font from Google Fonts.
