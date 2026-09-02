<?php

// Include database connection
require "db.php";

// Handle Delete operation
if (isset($_GET["delete"])) {

    $id = (int) $_GET["delete"];

    $stmt = mysqli_prepare($conn, "DELETE FROM contacts WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: view.php");
    exit;
}

// Handle Update operation
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update"])) {

    $id = (int) $_POST["id"];
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($name !== "" && $email !== "" && $message !== "") {

        $stmt = mysqli_prepare(
            $conn,
            "UPDATE contacts SET name = ?, email = ?, message = ? WHERE id = ?"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "sssi",
            $name,
            $email,
            $message,
            $id
        );

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    header("Location: view.php");
    exit;
}

// Read all contact records
$result = mysqli_query(
    $conn,
    "SELECT id, name, email, message FROM contacts ORDER BY id DESC"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f4f4f4;
        }

        h1 {
            text-align: center;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #333;
            color: white;
        }

        .form-box {
            background: white;
            padding: 20px;
            margin-bottom: 30px;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin: 6px 0 12px;
            box-sizing: border-box;
        }

        button {
            padding: 8px 15px;
            cursor: pointer;
        }

        .delete {
            color: red;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Contact Messages</h1>

    <?php if (isset($_GET["edit"])): ?>

        <?php

        $editId = (int) $_GET["edit"];

        $editResult = mysqli_query(
            $conn,
            "SELECT id, name, email, message
             FROM contacts
             WHERE id = $editId"
        );

        $editContact = mysqli_fetch_assoc($editResult);

        ?>

        <?php if ($editContact): ?>

            <div class="form-box">

                <h2>Update Message</h2>

                <form method="POST" action="view.php">

                    <input
                        type="hidden"
                        name="id"
                        value="<?php echo $editContact["id"]; ?>"
                    >

                    <label>Name:</label>

                    <input
                        type="text"
                        name="name"
                        value="<?php echo htmlspecialchars($editContact["name"]); ?>"
                        required
                    >

                    <label>Email:</label>

                    <input
                        type="email"
                        name="email"
                        value="<?php echo htmlspecialchars($editContact["email"]); ?>"
                        required
                    >

                    <label>Message:</label>

                    <textarea
                        name="message"
                        rows="5"
                        required
                    ><?php echo htmlspecialchars($editContact["message"]); ?></textarea>

                    <button type="submit" name="update">
                        Update Message
                    </button>

                </form>

            </div>

        <?php endif; ?>

    <?php endif; ?>


    <h2>Saved Messages</h2>

    <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>

            <tr>

                <td>
                    <?php echo $row["id"]; ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row["name"]); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row["email"]); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row["message"]); ?>
                </td>

                <td>

                    <a href="view.php?edit=<?php echo $row["id"]; ?>">
                        Edit
                    </a>

                    |

                    <a
                        class="delete"
                        href="view.php?delete=<?php echo $row["id"]; ?>"
                        onclick="return confirm('Are you sure you want to delete this message?');"
                    >
                        Delete
                    </a>

                </td>

            </tr>

        <?php endwhile; ?>

        </tbody>

        <tfoot>
            <tr>
                <td colspan="5">
                    Total contact messages:
                    <?php echo mysqli_num_rows($result); ?>
                </td>
            </tr>
        </tfoot>

    </table>

    <p>
        <a href="index.html">← Back to Portfolio</a>
    </p>

</div>

</body>
</html>

<?php

// Close database connection
mysqli_close($conn);

?>