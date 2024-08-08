# Basics

-   [x] Disable cookies before consent
-   [ ] Cookie consent modal <-
    -   [x] Implement filament form without Livewire
    -   [x] Show cookie consent form in a modal
    -   [ ] i18n-ify legal basis field
    -   [ ] convert duration into machine-readable format
    -   [ ] Load cookie definitions from db (with translations!)
    -   [ ] Hard-code dfns for system cookies & functional for YT/Vimeo (others too?)
    -   [ ] Create seeder for dummy cookies
    -   [ ] Load app's provider details for system cookies from db (settings?)
    -   [ ] Persist consent on login (with timestamps)

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
