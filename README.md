# ole-scout

# User data

The user data is split into multiple separate models:

-   The `Account` model represents a user account in the system and is used for internal authorization and local authentication.
-   The `User` model represents a single human using an `Account`. Shared accounts will create a new `User` for each session.
-   The `Persona` model represents a single human's identity within the system. Every `User` has exactly one `Persona`.
-   The `AccountIdentity` model represents an identity that can be used by an `Account` to authenticate against an (external) `IdentityProvider`.

This creates some deviations from the traditional Laravel authentication system:

-   The `remember_token` is stored in the `User` model as expected, but the password hash, email and email verification status are stored in the `Account` model.
-   Authentication logic for external authentication is specific to the `IdentityProvider` and credentials are stored in the `AccountIdentity` model.
-   Models that are specific to a single human reference the `User` model while models that are only interested in the identity of a human reference the `Persona` model.
-   We need our own `UserProvider` because the builtin one directly writes to the users table.

# Metadata

We want to move icons out of the database and into the filesystem so we're not currently including them in the migrations/models.

The `author` and `clearance` fields are currently not implemented. We should gather feedback about how they are currently used by our customers before implementing them.

## License

Copyright (c) 2024 Foss & Haas GmbH. All rights reserved.

This software is distributed under the terms of the [Microsoft Reference Source License (MS-RSL)](/LICENSE), which is not an Open Source license.

Please [contact the copyright holder](mailto:info@foss-haas.de) to obtain a license for non-reference use of the software.
