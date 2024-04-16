<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "libros";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {
        $codigo = $_POST['codigo_libro'];
        $stmt = $conn->prepare("DELETE FROM libros WHERE codigo_libro = ?");
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        $stmt->close();
    } else {
        $codigo = $_POST['codigo_libro'];
        $nombre = $_POST['nombre_libro'];
        $autor = $_POST['autor'];
        $fecha = $_POST['fecha_edicion'];
        $precio = $_POST['precio'];

        $stmt = $conn->prepare("INSERT INTO libros (codigo_libro, nombre_libro, autor, fecha_edicion, precio) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssds", $codigo, $nombre, $autor, $fecha, $precio);
        if ($stmt->execute()) {
            echo "<p style='color: green;'>Nuevo libro agregado exitosamente</p>";
        } else {
            echo "<p style='color: red;'>Error al agregar libro: " . htmlspecialchars($stmt->error) . "</p>";
        }
        $stmt->close();
    }
}

$result = $conn->query("SELECT * FROM libros");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Librería</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px 0 rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn-delete {
            color: white;
            background-color: red;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Gestión de Libros en la Librería</h2>
        <form method="post" action="">
            <input type="text" name="codigo_libro" placeholder="Código del libro" required>
            <input type="text" name="nombre_libro" placeholder="Nombre del libro" required>
            <input type="text" name="autor" placeholder="Autor" required>
            <input type="date" name="fecha_edicion" placeholder="Fecha de Edición" required>
            <input type="text" name="precio" placeholder="Precio" required>
            <button type="submit">Agregar Libro</button>
        </form>
        <br>
        <table>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Autor</th>
                <th>Fecha de Edición</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                          <td>" . htmlspecialchars($row['codigo_libro']) . "</td>
                          <td>" . htmlspecialchars($row['nombre_libro']) . "</td>
                          <td>" . htmlspecialchars($row['autor']) . "</td>
                          <td>" . htmlspecialchars($row['fecha_edicion']) . "</td>
                          <td>" . htmlspecialchars($row['precio']) . "</td>
                          <td>
                              <form method='post' action=''>
                                  <input type='hidden' name='codigo_libro' value='" . htmlspecialchars($row['codigo_libro']) . "'>
                                  <button type='submit' name='delete' class='btn-delete'>Eliminar</button>
                              </form>
                          </td>
                      </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No hay libros registrados.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
<?php
$conn->close();
?>
