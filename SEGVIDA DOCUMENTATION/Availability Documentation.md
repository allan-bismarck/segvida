# SegVida

## AVAILABILITIES

#### Get All Availabilities

- **Request:**
  - **Method:** GET
  - **URL:** `http://localhost:8000/api/availabilities`
  - **Headers:**
    - Accept: application/json
    - Content-Type: application/json

- **Response:**
- **Status:** OK (200)
- **Headers:**
  - Host: localhost:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 03:39:17 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
[
    {
        "id": 1,
        "arrival_time": "08:00:00",
        "departure_time": "17:00:00",
        "day": "SEG",
        "clinic_id": 2,
        "specialist_id": 2,
        "created_at": "2024-03-24T03:38:55.000000Z",
        "updated_at": "2024-03-24T03:38:55.000000Z",
        "clinic": {
            "id": 2,
            "name": "Nome da Clínica",
            "address": "Endereço da Clínica",
            "whatsapp": "Número de WhatsApp da Clínica",
            "cnpj": "CNPJ da Clínica",
            "email": "clinica@example.com",
            "description": "Descrição da Clínica",
            "opening_hours": null,
            "photo": null,
            "created_at": "2024-03-24T02:35:59.000000Z",
            "updated_at": "2024-03-24T02:35:59.000000Z"
        },
        "specialist": {
            "id": 2,
            "name": "Nome do Especialista",
            "CRM": "CRM do Especialista (opcional)",
            "sex": "Masculino",
            "photo": null,
            "created_at": "2024-03-24T03:04:43.000000Z",
            "updated_at": "2024-03-24T03:04:43.000000Z"
        }
    }
]
```

#### Get Availability by Id

- **Request:**
  - **Method:** GET
  - **URL:** `http://localhost:8000/api/availabilities/1`
  - **Headers:**
    - Accept: application/json
    - Content-Type: application/json

- **Response:**
- **Status:** OK (200)
- **Headers:**
  - Host: localhost:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 03:39:52 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "id": 1,
    "arrival_time": "08:00:00",
    "departure_time": "17:00:00",
    "day": "SEG",
    "clinic_id": 2,
    "specialist_id": 2,
    "created_at": "2024-03-24T03:38:55.000000Z",
    "updated_at": "2024-03-24T03:38:55.000000Z",
    "clinic": {
        "id": 2,
        "name": "Nome da Clínica",
        "address": "Endereço da Clínica",
        "whatsapp": "Número de WhatsApp da Clínica",
        "cnpj": "CNPJ da Clínica",
        "email": "clinica@example.com",
        "description": "Descrição da Clínica",
        "opening_hours": null,
        "photo": null,
        "created_at": "2024-03-24T02:35:59.000000Z",
        "updated_at": "2024-03-24T02:35:59.000000Z"
    },
    "specialist": {
        "id": 2,
        "name": "Nome do Especialista",
        "CRM": "CRM do Especialista (opcional)",
        "sex": "Masculino",
        "photo": null,
        "created_at": "2024-03-24T03:04:43.000000Z",
        "updated_at": "2024-03-24T03:04:43.000000Z"
    }
}
```

#### Create Availability

- **Request:**
  - **Method:** POST
  - **URL:** `http://127.0.0.1:8000/api/availabilities`
  - **Headers:** None
- **Body:**
  ```json
  {
      "arrival_time": "08:00:00",
      "departure_time": "17:00:00",
      "day": "SEG",
      "clinic_id": 2,
      "specialist_id": 2
  }
  ```

- **Response:**
- **Status:** Created (201)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 03:38:55 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "arrival_time": "08:00:00",
    "departure_time": "17:00:00",
    "day": "SEG",
    "clinic_id": 2,
    "specialist_id": 2,
    "updated_at": "2024-03-24T03:38:55.000000Z",
    "created_at": "2024-03-24T03:38:55.000000Z",
    "id": 1
}
```

#### Edit Availability

- **Request:**
  - **Method:** PUT
  - **URL:** `http://127.0.0.1:8000/api/availabilities/1`
  - **Headers:** None
  - **Body:**
    ```json
    {
        "arrival_time": "10:00:00",
        "departure_time": "17:00:00",
        "day": "QUI",
        "clinic_id": 2,
        "specialist_id": 2
    }
    ```

- **Response:**
- **Status:** OK (200)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 03:40:46 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "id": 1,
    "arrival_time": "10:00:00",
    "departure_time": "17:00:00",
    "day": "QUI",
    "clinic_id": 2,
    "specialist_id": 2,
    "created_at": "2024-03-24T03:38:55.000000Z",
    "updated_at": "2024-03-24T03:40:46.000000Z"
}
```

#### Delete Availability

- **Request:**
  - **Method:** DELETE
  - **URL:** `http://127.0.0.1:8000/api/availabilities/1`
  - **Headers:** None
  - **Body:** None

- **Response:**
  - **Status:** OK (200)
  - **Headers:**
    - Host: 127.0.0.1:8000
    - Connection: close
    - X-Powered-By: PHP/8.2.12
    - Cache-Control: no-cache, private
    - Date: Sun, 24 Mar 2024 00:22:47 GMT
    - Content-Type: application/json
    - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "message": "Disponibilidade deletada com sucesso."
}
```

