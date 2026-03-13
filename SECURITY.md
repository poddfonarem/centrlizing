# Security Policy

## Supported Versions

We provide security updates for the following versions:

| Version | Supported          |
| ------- | ------------------ |
| Main    | :white_check_mark: |
| < 1.0.0 | :x:                |

## Data Protection Principles

As this application handles user applications and administrative access, we prioritize:

1.  **Secure Authentication:** Admin access must be protected. We recommend using strong passwords and environment variables for sensitive keys.
2.  **Input Validation:** All user inputs (Leasing applications, "Call me back" requests) should be sanitized to prevent SQL Injection and XSS attacks.
3.  **Minimal Data Retention:** Personal data from applicants should only be stored as long as necessary for processing.

## Reporting a Vulnerability

**Do not report security vulnerabilities via public GitHub issues.**

If you discover a vulnerability related to:
* Bypassing admin authentication.
* Unauthorized access to user applications.
* Database leaks.

Please report it privately via:
**GitHub Private Vulnerability Reporting** (preferred).

We will respond within **24-48 hours** and provide a timeline for the fix. Please do not disclose the issue publicly until a patch is released.
