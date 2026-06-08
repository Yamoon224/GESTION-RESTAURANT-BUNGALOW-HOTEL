# Authenticating requests

To authenticate requests, include an **`Authorization`** header with the value **`"Bearer {YOUR_SYNC_API_TOKEN}"`**.

All authenticated endpoints are marked with a `requires authentication` badge in the documentation below.

Envoyez le jeton dans le header `Authorization: Bearer {token}` ou via `X-Api-Token`.
