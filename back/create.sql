-- Crear taula 'butacas'
CREATE TABLE butacas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ocupacion VARCHAR(255) DEFAULT 'libre',
    precio DECIMAL(8, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Crear taula 'compras'
CREATE TABLE compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sesion_id INT,
    butaca_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (sesion_id) REFERENCES sessions(id),
    FOREIGN KEY (butaca_id) REFERENCES butacas(id)
);
