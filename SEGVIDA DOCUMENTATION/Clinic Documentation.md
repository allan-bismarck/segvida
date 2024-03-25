# SegVida

## CLINICS

### Get All Clinics

#### Request
- **Method:** GET
- **URL:** `http://localhost:8000/api/clinics`

#### Response
- **Name:** Get All Clinicas
- **Status:** OK (200)
- **Headers:**
  - Host: localhost:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 02:32:49 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *

#### Body
```json
[
    {
        "id": 1,
        "name": "Nome da Clínica",
        "address": "Endereço da Clínica",
        "whatsapp": "Número de WhatsApp da Clínica",
        "cnpj": "CNPJ da Clínica",
        "email": "clinica@example.com",
        "description": "Descrição da Clínica",
        "opening_hours": null,
        "photo": null,
        "created_at": "2024-03-24T02:32:19.000000Z",
        "updated_at": "2024-03-24T02:32:19.000000Z",
        "specialties": [],
        "schedules": [],
        "availabilities": []
    }
]

```

### Get Clinic by Id

#### Request
- **Method:** GET
- **URL:** `http://localhost:8000/api/clinics/1`
- **Headers:**
  - Accept: application/json
  - Content-Type: application/json

#### Response
- **Status:** OK (200)
- **Headers:**
  - Host: localhost:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 02:33:17 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "id": 1,
    "name": "Nome da Clínica",
    "address": "Endereço da Clínica",
    "whatsapp": "Número de WhatsApp da Clínica",
    "cnpj": "CNPJ da Clínica",
    "email": "clinica@example.com",
    "description": "Descrição da Clínica",
    "opening_hours": null,
    "photo": null,
    "created_at": "2024-03-24T02:32:19.000000Z",
    "updated_at": "2024-03-24T02:32:19.000000Z",
    "specialties": [],
    "schedules": [],
    "availabilities": []
}

```

### Create Clinic

#### Request
- **Method:** POST
- **URL:** `http://127.0.0.1:8000/api/clinics`
- **Headers:** None
- **Body:**
  - Mode: formdata
  - Formdata:
    - name: Nome da Clínica
    - address: Endereço da Clínica
    - whatsapp: Número de WhatsApp da Clínica
    - cnpj: CNPJ da Clínica
    - email: clinica@example.com
    - description: Descrição da Clínica
    - opening_hours: Segunda a Sexta - 08h às 17h
    - image: [File: /C:/Users/Usuário/Downloads/foto.jpg]

#### Response
- **Status:** Created (201)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 02:32:19 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "message": "Clínica cadastrada com sucesso.",
    "data": {
        "name": "Nome da Clínica",
        "address": "Endereço da Clínica",
        "whatsapp": "Número de WhatsApp da Clínica",
        "cnpj": "CNPJ da Clínica",
        "email": "clinica@example.com",
        "description": "Descrição da Clínica",
        "updated_at": "2024-03-24T02:32:19.000000Z",
        "created_at": "2024-03-24T02:32:19.000000Z",
        "id": 1,
        "specialties": []
    }
}

```

### Edit Clinic

#### Request
- **Method:** POST
- **URL:** `http://127.0.0.1:8000/api/clinics/1`
- **Headers:** None
- **Body:**
  - Mode: formdata
  - Formdata:
    - name: Nome da Clínica Atualizado
    - address: Endereço da Clínica
    - whatsapp: Número de WhatsApp da Clínica
    - cnpj: CNPJ da Clínica
    - email: clinica@example.com
    - description: Descrição da Clínica
    - opening_hours[]: Segunda a Sexta - 08h às 17h
    - image: [File: /C:/Users/Usuário/Downloads/nova_foto.jpg]

#### Response
- **Status:** OK (200)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 02:34:50 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "message": "Clínica atualizada com sucesso.",
    "data": {
        "id": 1,
        "name": "Nome da Clínica Atualizado",
        "address": "Endereço da Clínica",
        "whatsapp": "Número de WhatsApp da Clínica",
        "cnpj": "CNPJ da Clínica",
        "email": "clinica@example.com",
        "description": "Descrição da Clínica",
        "opening_hours": null,
        "photo": 2,
        "created_at": "2024-03-24T02:32:19.000000Z",
        "updated_at": "2024-03-24T02:34:50.000000Z",
        "specialties": []
    }
}

```

### Delete Clinic

#### Request
- **Method:** DELETE
- **URL:** `http://127.0.0.1:8000/api/clinics/1`
- **Headers:** None
- **Body:** None

#### Response
- **Status:** OK (200)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 02:35:13 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "message": "Clínica deletada com sucesso",
    "id": "1"
}

```
