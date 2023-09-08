# 1. Intro
## 1.1. Content
Content:
- [1. Intro](#1-intro)
  - [1.1. Content](#11-content)
  - [1.2. DB Table](#12-db-table)
    - [1.2.1. USERS](#121-users)
    - [1.2.2. ROLES](#122-roles)
    - [1.2.3. CARDS](#123-cards)
    - [1.2.4. CITYS](#124-citys)


## 1.2. DB Table
4 Tabel = `users` `cards` `roles` `citys`
### 1.2.1. USERS

| Column   | Type  |
| :------- | :---: |
| id       | uniq  |
| email    |       |
| username |       |
| password |       |

### 1.2.2. ROLES

| Column  |         Type         |
| :------ | :------------------: |
| id      |         uniq         |
| user_id | foreignId->id->users |
| role    |         JSON         |

### 1.2.3. CARDS

| Column     |     Type     |
| :--------- | :----------: |
| id         |     uniq     |
| patient_id | string, uniq |
| nama       |              |
| alamat     |              |
| no_telp    |              |
| rt_rw      |              |
| kelurahan  |              |
| tgl_lahir  |              |
| gender     |              |

### 1.2.4. CITYS

| Column    | Type  |
| :-------- | :---: |
| id        | uniq  |
| provinsi  |       |
| kabupaten |       |
| desa      |       |