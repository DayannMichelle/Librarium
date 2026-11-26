<?php
require 'database.php';

try {
    // 1. Tabla usuarios
    $conn->exec("CREATE TABLE IF NOT EXISTS usuarios (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        first_name TEXT NOT NULL,
        last_name TEXT NOT NULL,
        email TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL,
        phone TEXT,
        birthdate TEXT,
        gender TEXT
    )");

    // 2. Tabla libros
    $conn->exec("CREATE TABLE IF NOT EXISTS libros (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        titulo TEXT NOT NULL,
        autor TEXT NOT NULL,
        genero TEXT NOT NULL,
        numero_topografico TEXT NOT NULL
    )");

    // 3. Tabla prestamos
    $conn->exec("CREATE TABLE IF NOT EXISTS prestamos (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER NOT NULL,
        libro_id INTEGER NOT NULL,
        estado TEXT NOT NULL DEFAULT 'prestado',
        fecha_prestamo TEXT DEFAULT CURRENT_TIMESTAMP,
        fecha_devolucion TEXT,
        FOREIGN KEY (user_id) REFERENCES usuarios(id),
        FOREIGN KEY (libro_id) REFERENCES libros(id)
    )");

    echo "<h2>¡Tablas creadas con éxito en SQLite!</h2>";
    echo "<p>Ya puedes <a href='signup.php'>crear tu cuenta</a> o <a href='index.php'>ir al inicio</a>.</p>";

} catch (PDOException $e) {
    echo "Error al crear tablas: " . $e->getMessage();
}
?>

