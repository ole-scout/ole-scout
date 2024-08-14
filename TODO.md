# Basics

-   [x] Disable cookies before consent
-   [ ] Cookie consent modal
    -   [x] Implement filament form without Livewire
    -   [x] Show cookie consent form in a modal
    -   [x] i18n-ify legal basis field
    -   [x] convert duration into machine-readable format
    -   [x] Load cookie definitions from db (with translations!)
    -   [x] Create seeder for dummy cookies
    -   [x] Load app's provider details for system cookies from db (settings)
    -   [ ] Hard-code dfns for system cookies & functional for YT/Vimeo (others too?) <-
    -   [ ] Store copy of full dfn to allow tracking which version was used
    -   [ ] Record viewport size, submission event & used version
    -   [ ] Persist consent on login (with timestamps, etc)
    -   [ ] Validate consent request body

# Auth

-   [ ] Login
-   [ ] Signup
-   [ ] Forgot password

# User settings

-   [ ] Consent settings

# Admin panel

-   [ ] Manage site config
    -   [ ] Cookie consent options
    -   [ ] Toggle video providers (YT/Vimeo)
    -   [ ] Edit site title
    -   [ ] Audit log
-   [ ] Manage users
    -   [ ] Edit user data
    -   [ ] Edit user credentials
    -   [ ] Manage roles
    -   [ ] Edit user permissions / roles
    -   [ ] Create user
    -   [ ] Schedule user for deletion (soft delete)
-   [ ] GDPR export for user
    -   [ ] Queue GDPR export job
    -   [ ] GDPR export job
    -   [ ] Zip bundle job
    -   [ ] Offer job result download (Filament db notification?)
    -   [ ] User downloads view
