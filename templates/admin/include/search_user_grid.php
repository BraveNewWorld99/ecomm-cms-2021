<?php

$query = filter_var($_POST['query'], FILTER_SANITIZE_STRING);

$user = new User();
$rows = $user->getUserSearchRegData($query);

if ($rows) { // If it ran OK (records were returned), display the records.
    // Table header.
    echo "<table class=\"table table-striped\">" .
        "<tr>" .
        "<th scope=\"col\">Edit</th>" .
        "<th scope=\"col\">Delete</th>" .
        "<th scope=\"col\">Last Name</th>" .
        "<th scope=\"col\">First Name</th>" .
        "<th scope=\"col\">Email</th>" .
        "<th scope=\"col\">Date Registered</th>" .
        "</tr>";
    // Fetch and print all the records:

    //var_dump($rows);
    //exit;

    foreach ($rows as $value) {
        // Remove special characters that might already be in table to
        // reduce the chance of XSS exploits
        $user_id = htmlspecialchars($value['user_id'], ENT_QUOTES);
        $last_name = htmlspecialchars($value['last_name'], ENT_QUOTES);
        $first_name = htmlspecialchars($value['first_name'], ENT_QUOTES);
        $email = htmlspecialchars($value['email'], ENT_QUOTES);
        $registration_date = htmlspecialchars($value['regdat'], ENT_QUOTES);

        //TODO Need to get deleteUser functionality working.

        echo "<tr>" .
            "<td><a href=\"admin.php?action=editUser&id=" . $user_id . "\">Edit</a></td>" .
            "<td><a href=\"admin.php?action=deleteUser&id=" . $user_id . "\">Delete</a></td>" .
            "<td>" . $last_name . "</td>" .
            "<td>" . $first_name . "</td>" .
            "<td>" . $email . "</td>" .
            "<td>" . $registration_date . "</td>" .
            "</tr>";
    }
    echo "</table>"; // Close the table.
} else { // If it did not run OK.

    // Error message:
    echo '<p class="text-center">The current users could not be retrieved. We apologize';
    echo ' for any inconvenience.</p>';
    exit;
} // End of else ($rows)

?>