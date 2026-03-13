# Contributing to Centrlizing

Thank you for your interest in improving the Auto Leasing Management System! To maintain code quality and security, please follow these guidelines.

---

## How to Contribute

### Reporting Bugs
* Check existing Issues to see if the bug has already been reported.
* Provide a clear description of the bug, including steps to reproduce it and screenshots if applicable.

### Suggesting Features
* Open an Issue with the `enhancement` label.
* Describe the use case (e.g., "As an admin, I want to filter applications by date").

### Pull Request (PR) Process
1.  **Fork** the repo and create a feature branch (`git checkout -b feature/amazing-feature`).
2.  **Frontend & Admin Panel:** Ensure that any changes to the admin interface do not break the authorization flow.
3.  **Database Integrity:** If your change modifies the database schema (applications, admin list), include clear instructions or migration scripts.
4.  **No Hardcoded Secrets:** Never commit real passwords, API keys, or database credentials. Use `.env` files.
5.  **Submit PR:** Link it to the related Issue and describe your changes.

---

## Development Standards

* **Clean Code:** Use meaningful names for variables and functions (e.g., `processLeasingRequest()` instead of `doStuff()`).
* **Security First:** Always validate user-provided data on the server side.
* **UI Consistency:** Ensure that new elements match the existing design for both customers and administrators.

---

## Admin Management
When contributing features related to Admin Management (adding/deleting admins), ensure that **only existing admins** can perform these actions and that the system cannot be left without at least one super-admin.

---

Thanks for helping us build a better leasing platform!
