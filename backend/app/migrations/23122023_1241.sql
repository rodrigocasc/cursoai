CREATE DATABASE IF NOT EXISTS cursoai;

USE cursoai;

CREATE TABLE users (
    id BIGINT AUTO_INCREMENT,
    is_administrator BOOLEAN NOT NULL,
    full_name TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    login TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    birth DATE NOT NULL,
    phone TEXT NOT NULL,
    address TEXT NOT NULL,
    cep TEXT NOT NULL,
    district TEXT NOT NULL,
    city TEXT NOT NULL,
    state TEXT NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME, 
    deleted_at DATETIME,
    PRIMARY KEY (id)
);

CREATE TABLE courses (
    id BIGINT AUTO_INCREMENT,
    name TEXT NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME, 
    deleted_at DATETIME,
    PRIMARY KEY (id)
);

CREATE TABLE courses_users (
    user_id BIGINT NOT NULL,
    course_id BIGINT NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME, 
    deleted_at DATETIME,
    FOREIGN KEY (course_id) REFERENCES courses(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE sessions (
    user_id BIGINT NOT NULL,
    token TEXT NOT NULL,
    created_at DATETIME NOT NULL,
    expired_at DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
