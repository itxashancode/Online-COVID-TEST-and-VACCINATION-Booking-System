Claude, act as a Senior Auditor for this Junior Dev project.

1. Fix Syntax & Type-Hints (CRITICAL):

In AdminVaccineController.php and other controllers: Fix the return type hints. If a function returns view(), change the return type to : View or : Renderable. If it returns a redirect, change it to : RedirectResponse. (Import these classes at the top).
In EmailVerificationPromptController.php: Fix the syntax error on line 13. Look for an unexpected semicolon.
Blade Audit: Scan all dashboard and layout files. Ensure every @if, @foreach, and @auth is properly closed with @endif, @endforeach, or @endauth.
2. Fix Lucide Icons:

Ensure lucide.createIcons(); is called at the very end of the layout files.
Re-check all icon names (e.g., use virus-2 or activity instead of virus).
3. Data Flow & Cleanliness:

Remove ALL emojis from the views. Replace them with Lucide icons.
Ensure dashboard() and index() methods are actually fetching data from the database and passing it to the view using compact().
If a Blade block is inside {{-- --}}, evaluate if it belongs in the project. If it does, uncomment it and fix it.
4. Model Integrity:

Ensure all Models have the $fillable property matching the SQL.md schema. No mass assignment errors allowed!
Style: Comment every logic block. Keep it simple and junior-friendly. Follow README.md strictly.