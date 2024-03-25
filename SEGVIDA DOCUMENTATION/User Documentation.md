# SegVida

## USERS

#### Show User

- **Request:**
  - **Method:** GET
  - **URL:** `http://127.0.0.1:8000/api/users/1`
  - **Headers:**
    - Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxfQ.BhBBP8RnVr8Dxj6VPKUBCBiF5ZKL24kvSzGa4Nt4pis

- **Response:**
- **Status:** OK (200)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 18:00:42 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "id": 1,
    "user_name": "allan",
    "email": "allan@email.com",
    "email_verified_at": null,
    "created_at": "2024-03-24T15:23:13.000000Z",
    "updated_at": "2024-03-24T15:23:13.000000Z"
}
```

#### Edit User

- **Request:**
- **Method:** PUT
- **URL:** `http://127.0.0.1:8000/api/users/4`
- **Headers:**
  - Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxfQ.BhBBP8RnVr8Dxj6VPKUBCBiF5ZKL24kvSzGa4Nt4pis
- **Body:**
```json
{
    "user_name": "allanbismarck",
    "email": "allanbismarck@email.com",
    "password": "12345678"
}
```

- **Response:**
- **Status:** OK (200)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 18:05:38 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "id": 4,
    "user_name": "allanbismarck",
    "email": "allanbismarck@email.com",
    "email_verified_at": null,
    "created_at": "2024-03-24T18:05:09.000000Z",
    "updated_at": "2024-03-24T18:05:38.000000Z"
}
```

#### Delete User

- **Request:**
  - **Method:** DELETE
  - **URL:** `http://127.0.0.1:8000/api/users/3`
  - **Headers:**
    - Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxfQ.BhBBP8RnVr8Dxj6VPKUBCBiF5ZKL24kvSzGa4Nt4pis

- **Response:**
- **Status:** OK (200)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 18:04:42 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "message": "Usuário deletado com sucesso"
}
```
