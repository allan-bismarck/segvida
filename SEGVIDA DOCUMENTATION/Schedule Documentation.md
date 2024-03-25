# SegVida

## SCHEDULES

### Get All Schedules

#### Request
- **Method:** GET
- **URL:** `http://localhost:8000/api/schedules`
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
  - Date: Sun, 24 Mar 2024 03:09:10 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "data": [
        {
            "id": 1,
            "type": "Online",
            "reason_for_consultation": "Consulta de rotina",
            "start_time": "2024-03-20T09:00:00",
            "end_time": "2024-03-20T10:00:00",
            "payment": "Particular",
            "clinic_id": 2,
            "specialist_id": 2,
            "patient_id": 2,
            "created_at": "2024-03-24T03:08:49.000000Z",
            "updated_at": "2024-03-24T03:08:49.000000Z",
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
            },
            "patient": {
                "id": 2,
                "name": "Nome do Paciente (obrigatório)",
                "date_of_birth": "1999-01-01",
                "sex": "Masculino",
                "address": "Endereço (opcional)",
                "whatsapp": "Número de Whatsapp (opcional)",
                "email": "pacient@example.com",
                "rg": "Número do RG (opcional)",
                "cpf": "Número do CPF (opcional)",
                "user_name": "user_name_usuario",
                "photo": null,
                "created_at": "2024-03-24T03:08:30.000000Z",
                "updated_at": "2024-03-24T03:08:30.000000Z"
            }
        }
    ]
}

```

### Get Schedules by Id

#### Request
- **Method:** GET
- **URL:** `http://localhost:8000/api/schedules/1`
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
  - Date: Sun, 24 Mar 2024 03:09:41 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "data": {
        "id": 1,
        "type": "Online",
        "reason_for_consultation": "Consulta de rotina",
        "start_time": "2024-03-20T09:00:00",
        "end_time": "2024-03-20T10:00:00",
        "payment": "Particular",
        "clinic_id": 2,
        "specialist_id": 2,
        "patient_id": 2,
        "created_at": "2024-03-24T03:08:49.000000Z",
        "updated_at": "2024-03-24T03:08:49.000000Z",
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
        },
        "patient": {
            "id": 2,
            "name": "Nome do Paciente (obrigatório)",
            "date_of_birth": "1999-01-01",
            "sex": "Masculino",
            "address": "Endereço (opcional)",
            "whatsapp": "Número de Whatsapp (opcional)",
            "email": "pacient@example.com",
            "rg": "Número do RG (opcional)",
            "cpf": "Número do CPF (opcional)",
            "user_name": "user_name_usuario",
            "photo": null,
            "created_at": "2024-03-24T03:08:30.000000Z",
            "updated_at": "2024-03-24T03:08:30.000000Z"
        }
    }
}

```

### Create Schedule

#### Request
- **Method:** POST
- **URL:** `http://127.0.0.1:8000/api/schedules`
- **Headers:** (None)
- **Body:**
```json
{
    "type": "Online",
    "reason_for_consultation": "Consulta de rotina",
    "start_time": "2024-03-20T09:00",
    "end_time": "2024-03-20T10:00",
    "payment": "Particular",
    "clinic_id": 2,
    "specialist_id": 2,
    "patient_id": 2
}
```
#### Response
- **Status:** Created (201)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 03:08:49 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "message": "Agenda criada com sucesso",
    "data": {
        "type": "Online",
        "reason_for_consultation": "Consulta de rotina",
        "start_time": "2024-03-20T09:00",
        "end_time": "2024-03-20T10:00",
        "payment": "Particular",
        "clinic_id": 2,
        "specialist_id": 2,
        "patient_id": 2,
        "updated_at": "2024-03-24T03:08:49.000000Z",
        "created_at": "2024-03-24T03:08:49.000000Z",
        "id": 1
    }
}
```

#### Edit Schedule

- **Request:**
- **Method:** PUT
- **URL:** `http://127.0.0.1:8000/api/schedules/1`
- **Headers:** None
- **Body:**
```json
{
    "type": "Presencial",
    "reason_for_consultation": "Consulta de rotina",
    "start_time": "2024-03-20T09:00",
    "end_time": "2024-03-20T10:00",
    "payment": "Convênio",
    "clinic_id": 2,
    "specialist_id": 2,
    "patient_id": 2
}
```

- **Response:**
- **Status:** OK (200)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 03:28:09 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "message": "Agenda atualizada com sucesso",
    "data": {
        "id": 1,
        "type": "Presencial",
        "reason_for_consultation": "Consulta de rotina",
        "start_time": "2024-03-20T09:00",
        "end_time": "2024-03-20T10:00",
        "payment": "Convênio",
        "clinic_id": 2,
        "specialist_id": 2,
        "patient_id": 2,
        "created_at": "2024-03-24T03:08:49.000000Z",
        "updated_at": "2024-03-24T03:28:09.000000Z"
    }
}
```

#### Delete Schedule

- **Request:**
- **Method:** DELETE
- **URL:** `http://127.0.0.1:8000/api/schedules/1`
- **Headers:** None
- **Body:** None

- **Response:**
- **Status:** OK (200)
- **Headers:**
  - Host: 127.0.0.1:8000
  - Connection: close
  - X-Powered-By: PHP/8.2.12
  - Cache-Control: no-cache, private
  - Date: Sun, 24 Mar 2024 03:28:42 GMT
  - Content-Type: application/json
  - Access-Control-Allow-Origin: *
- **Body:**
```json
{
    "message": "Agenda deletada com sucesso"
}
```