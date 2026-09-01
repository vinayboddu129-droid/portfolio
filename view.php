<?php
include "db.php";

// UPDATE record
if (isset($_POST["update"])) {

    $id = $_POST["id"];
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    $sql = "UPDATE contacts SET name=?, email=?, message=? WHERE id=?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $message, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<p><strong>Record updated successfully!</strong></p>";
    }

    mysqli_stmt_close($stmt);
}


// DELETE record
if (isset($_POST["delete"])) {

    $id = $_POST["id"];

    $sql = "DELETE FROM contacts WHERE id=?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<p><strong>Record deleted successfully!</strong></p>";
    }

    mysqli_stmt_close($stmt);
}


// Get all records
$result = mysqli_query($conn, "SELECT * FROM contacts");
?>

<!DOCTYPE html>
<html>

<head>

    <title>Contact Messages</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        table {
            border-collapse: collapse;
            width: 90%;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
        }

        th {
            background-color: #f2f2f2;
        }

        input, textarea {
            width: 95%;
            padding: 6px;
        }

        textarea {
            resize: vertical;
        }

        button {
            padding: 7px 12px;
            cursor: pointer;
            margin: 3px;
        }

    </style>

</head>

<body>

<h1>Contact Messages</h1>

<table>

    <tr>

        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Action</th>

    </tr>


    <?php while ($row = mysqli_fetch_assoc($result)) { ?>

    <tr>

        <!-- UPDATE FORM -->

        <form method="POST" action="view.php">

            <td>

                <?php echo $row["id"]; ?>

                <input
                    type="hidden"
                    name="id"
                    value="<?php echo $row["id"]; ?>"
                >

            </td>


            <td>

                <input
                    type="text"
                    name="name"
                    value="<?php echo htmlspecialchars($row["name"]); ?>"
                    required
                >

            </td>


            <td>

                <input
                    type="email"
                    name="email"
                    value="<?php echo htmlspecialchars($row["email"]); ?>"
                    required
                >

            </td>


            <td>

                <textarea
                    name="message"
                    required
                ><?php echo htmlspecialchars($row["message"]); ?></textarea>

            </td>


            <td>

                <button type="submit" name="update">
                    Update
                </button>

        </form>


        <!-- DELETE FORM -->

                <form method="POST" action="view.php"
                      onsubmit="return confirm('Are you sure you want to delete this record?');">

                    <input
                        type="hidden"
                        name="id"
                        value="<?php echo $row["id"]; ?>"
                    >

                    <button type="submit" name="delete">
                        Delete
                    </button>

                </form>

            </td>

    </tr>

    <?php } ?>

</table>

</body>

</html>

<?php
mysqli_close($conn);
?>