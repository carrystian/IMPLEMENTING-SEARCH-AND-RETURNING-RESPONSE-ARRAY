<?php
require_once('./models/applicant.php');
$applicant = new Applicant();

// Handle search queries
$searchResults = [];
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $searchResults = $applicant->search($searchQuery);
}

// Handle record deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteButton'])) {
    $idToDelete = $_POST['id'];
    $applicant->delete($idToDelete);
}

// Handle update form display
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateButton'])) {
    $applicantId = $_POST['id'];
    $userDetails = $applicant->getUserById($applicantId); // Fetch the user details by ID
}

// Handle update form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['saveButton'])) {
    $formData = [
        'id' => $_POST['id'],
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'phone_number' => $_POST['phone_number'],
        'birthdate' => $_POST['birthdate'],
        'gender' => $_POST['gender'],
        'location' => $_POST['location'],
        'years_of_experience' => $_POST['years_of_experience'],
        'education_level' => $_POST['education_level'],
        'job_title' => $_POST['job_title'],
    ];

    // Call the update method to save the data
    $applicant->update($formData);
}


// Handle Application form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registerButton'])) {
    // Store form data into an array
    $formData = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'phone_number' => $_POST['phone_number'],
        'birthdate' => $_POST['birthdate'],
        'gender' => $_POST['gender'],
        'location' => $_POST['location'],
        'years_of_experience' => $_POST['years_of_experience'],
        'education_level' => $_POST['education_level'], 'job_title' => $_POST['job_title'],
    ];

    // Call the store method to save the data
    $applicant->store($formData);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Software Engineer Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        h2 {
            color: #2a2a2a;
            text-align: center;
        }

        form {
            background-color: white;
            padding: 20px;
            margin: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: inline-block;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e2e2e2;
        }

        .search-form {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-form input[type="text"] {
            width: 30%;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .actions input[type="submit"] {
            width: 80px;
        }

    </style>
</head>

<body>
    <header>
        <h1>Cyber Security Job Application System</h1>
    </header>

    <div class="search-form">
        <form action="index.php" method="GET">
            <label for="search">Search Applicants:</label>
            <input type="text" id="search" name="search" placeholder="Search here...">
            <input type="submit" value="Search">
        </form>
    </div>

    <?php if (!isset($userDetails)): ?>
        <h2>Software Engineer Application Form</h2>
        <form action="index.php" method="POST">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required><br><br>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number"><br><br>

            <label for="birthdate">Birthdate:</label>
            <input type="date" id="birthdate" name="birthdate"><br><br>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
                <option value="Prefer not to say">Prefer not to say</option>
            </select><br><br>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location"><br><br>

            <label for="years_of_experience">Years of Experience:</label>
            <input type="number" id="years_of_experience" name="years_of_experience" required><br><br>

            <label for="education_level">Education Level:</label>
            <select id="education_level" name="education_level">
                <option value="High School">High School</option>
                <option value="Bachelor">Bachelor</option>
                <option value="Master">Master</option>
                <option value="PhD">PhD</option>
                <option value="Other">Other</option>
            </select><br><br>

            <label for="job_title">Job Title:</label>
            <input type="text" id="job_title" name="job_title" required><br><br>

            <input type="submit" name="registerButton" value="Register">
        </form>
    <?php endif; ?>

    <?php if (isset($userDetails)): ?>
        <h2>Update User Details</h2>
        <form action="index.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $userDetails['id']; ?>">

            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo $userDetails['first_name']; ?>" required><br><br>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo $userDetails['last_name']; ?>" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $userDetails['email']; ?>" required><br><br>

            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" value="<?php echo $userDetails['phone_number']; ?>"><br><br>

            <label for="birthdate">Birthdate:</label>
            <input type="date" id="birthdate" name="birthdate" value="<?php echo $userDetails['birthdate']; ?>"><br><br>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender">
                <option value="Male" <?php if ($userDetails['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if ($userDetails['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                <option value="Other" <?php if ($userDetails['gender'] == 'Other') echo 'selected'; ?>>Other</option>
                <option value="Prefer not to say" <?php if ($userDetails['gender'] == 'Prefer not to say') echo 'selected'; ?>>Prefer not to say</option>
            </select><br><br>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location" value="<?php echo $userDetails['location']; ?>"><br><br>

            <label for="years_of_experience">Years of Experience:</label>
            <input type="number" id="years_of_experience" name="years_of_experience" value="<?php echo $userDetails['years_of_experience']; ?>" required><br><br>

            <label for="education_level">Education Level:</label>
            <select id="education_level" name="education_level">
                <option value="High School" <?php if ($userDetails['education_level'] == 'High School') echo 'selected'; ?>>High School</option>
                <option value="Bachelor" <?php if ($userDetails['education_level'] == 'Bachelor') echo 'selected'; ?>>Bachelor</option>
                <option value="Master" <?php if ($userDetails['education_level'] == 'Master') echo 'selected'; ?>>Master</option>
                <option value="PhD" <?php if ($userDetails['education_level'] == 'PhD') echo 'selected'; ?>>PhD</option>
                <option value="Other" <?php if ($userDetails['education_level'] == 'Other') echo 'selected'; ?>>Other</option>
            </select><br><br>

            <label for="job_title">Job Title:</label>
            <input type="text" id="job_title" name="job_title" value="<?php echo $userDetails['job_title']; ?>" required><br><br>

            <input type="submit" name="saveButton" value="Save Changes">
        </form>
    <?php endif; ?>

    <h2>Applicant List</h2>
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($searchResults as $applicantData): ?>
            <tr>
                <td><?php echo $applicantData['first_name']; ?></td>
                <td><?php echo $applicantData['last_name']; ?></td>
                <td><?php echo $applicantData['email']; ?></td>
                <td><?php echo $applicantData['phone_number']; ?></td>
                <td>
                    <form action="index.php" method="POST" class="actions">
                        <input type="hidden" name="id" value="<?php echo $applicantData['id']; ?>">
                        <input type="submit" name="updateButton" value="Edit">
                        <input type="submit" name="deleteButton" value="Delete" onclick="return confirm('Are you sure you want to delete this applicant?');">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>
