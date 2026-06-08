# Documentation API de synchronisation

Cette documentation decrit les endpoints exposes pour synchroniser les produits et les commandes avec un systeme tiers.

## Authentification

Toutes les routes documentees ici sont protegees par un jeton d'API.

Envoyez l'un des headers suivants :

- `Authorization: Bearer {SYNC_API_TOKEN}`
- `X-Api-Token: {SYNC_API_TOKEN}`

## Webhook commande

Lorsqu'une commande est enregistree dans l'application, un webhook HTTP `POST` est envoye uniquement si `ORDER_WEBHOOK_URL` est defini dans le fichier `.env`.

Le payload contient les informations completes de la commande, ses lignes et les produits associes.