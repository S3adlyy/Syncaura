<?php
session_start();

// Database connection
$dsn = "mysql:host=localhost;dbname=users";
$db_user = "root";
$db_password = "";

try {
    $connect = new PDO($dsn, $db_user, $db_password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle Delete Action
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $connect->prepare("DELETE FROM client WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: users.php");
        exit();
    }

    // Handle Lock Account (status = 0)
    if (isset($_GET['action']) && $_GET['action'] == 'lock' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $connect->prepare("UPDATE client SET status = 0 WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: users.php");
        exit();
    }

    // Handle Unlock Account (status = 1)
    if (isset($_GET['action']) && $_GET['action'] == 'unlock' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $connect->prepare("UPDATE client SET status = 1 WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: users.php");
        exit();
    }

    // Set filters in session if they are set from GET request
    if (isset($_GET['username'])) $_SESSION['usernameFilter'] = $_GET['username'];
    if (isset($_GET['email'])) $_SESSION['emailFilter'] = $_GET['email'];
    if (isset($_GET['gender'])) $_SESSION['genderFilter'] = $_GET['gender'];
    if (isset($_GET['status'])) $_SESSION['statusFilter'] = $_GET['status'];
    if (isset($_GET['phone'])) $_SESSION['phoneFilter'] = $_GET['phone'];

    // Use session filters if available
    $usernameFilter = isset($_SESSION['usernameFilter']) ? $_SESSION['usernameFilter'] : '';
    $emailFilter = isset($_SESSION['emailFilter']) ? $_SESSION['emailFilter'] : '';
    $genderFilter = isset($_SESSION['genderFilter']) ? $_SESSION['genderFilter'] : '';
    $statusFilter = isset($_SESSION['statusFilter']) ? $_SESSION['statusFilter'] : '';
    $phoneFilter = isset($_SESSION['phoneFilter']) ? $_SESSION['phoneFilter'] : '';

    // Query for filtering clients
    $sql = "SELECT id, username, email, gender, status, phone FROM client WHERE role != 1";

    if ($usernameFilter) {
        $sql .= " AND username LIKE :username";
    }
    if ($emailFilter) {
        $sql .= " AND email LIKE :email";
    }
    if ($genderFilter  ) {
        $sql .= " AND gender = :gender";
    }
    if ($statusFilter !== '') {
        $sql .= " AND status = :status";
    }
    if ($phoneFilter) {
        $sql .= " AND phone LIKE :phone";
    }

    // Prepare and execute query
    $stmt = $connect->prepare($sql);

    // Bind parameters if they are set
    if ($usernameFilter) {
        $stmt->bindValue(':username', "%$usernameFilter%", PDO::PARAM_STR);
    }
    if ($emailFilter) {
        $stmt->bindValue(':email', "%$emailFilter%", PDO::PARAM_STR);
    }
    if ($genderFilter) {
        $stmt->bindValue(':gender', $genderFilter, PDO::PARAM_INT);
    }
    if ($statusFilter !== '') {
        $stmt->bindValue(':status', $statusFilter, PDO::PARAM_INT);
    }
    if ($phoneFilter) {
        $stmt->bindValue(':phone', "%$phoneFilter%", PDO::PARAM_STR);
    }

    $stmt->execute();
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    function exportToCSV($clients, $visibleColumns) {
        // Ensure there are visible columns
        if (empty($visibleColumns)) {
            echo "No columns selected for export!";
            exit();
        }
    
        $filename = "filtered_clients.csv";
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $output = fopen('php://output', 'w');
    
        // Define all possible columns
        $allColumns = [
            'Username',
            'Email',
            'Phone',
            'Gender',
            'Status'
        ];
    
        // Prepare the headers for CSV export based on visible columns
        $headers = [];
        foreach ($visibleColumns as $col) {
            if ($col >= 1 && $col <= count($allColumns)) {
                $headers[] = $allColumns[$col - 1]; // Adjust column index
            }
        }
        fputcsv($output, $headers);
    
        // Add data rows based on visible columns
        foreach ($clients as $client) {
            $row = [];
            foreach ($visibleColumns as $col) {
                if ($col >= 1 && $col <= count($allColumns)) {
                    switch ((int)$col) {
                        case 1: $row[] = $client['username']; break;
                        case 2: $row[] = $client['email']; break;
                        case 3: $row[] = $client['phone']; break;
                        case 4: $row[] = $client['gender'] == 1 ? 'Female' : 'Male'; break;
                        case 5: $row[] = $client['status'] == 1 ? 'Unlocked' : 'Locked'; break;
                    }
                }
            }
            fputcsv($output, $row);
        }
    
        fclose($output);
        exit();
    }
    
    
    
    // Checking if CSV Download action is triggered
    if (isset($_GET['action']) && $_GET['action'] == 'download') {
        // Get the visible columns selected by the user
        $visibleColumns = isset($_GET['visibleColumns']) ? explode(',', $_GET['visibleColumns']) : [1, 2, 3, 4, 5];
    
        // Call the export function with clients and selected visible columns
        exportToCSV($clients, $visibleColumns);
    }
    


} catch (PDOException $e) {
    echo 'Database Error: ' . $e->getMessage();
    exit();
}
?>
<style>
    .hidden {
    display: none;
}

</style>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Syncora Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="styles/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
       
       <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
           <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../../dash.php">
               <div class="sidebar-brand-icon rotate-n-15">
                   <i class="fas fa-laugh-wink"></i>
               </div>
               <div class="sidebar-brand-text mx-3">Syncora <sup></sup></div>
           </a>
           <hr class="sidebar-divider my-0">
           <li class="nav-item active">
               <a class="nav-link" href="../../dash.php">
                   <i class="fas fa-fw fa-tachometer-alt"></i>
                   <span>Dashboard</span>
               </a>
           </li>
           <hr class="sidebar-divider">
           <div class="sidebar-heading">
               Tables
           </div>
           <li class="nav-item">
           <a class="nav-link" href="users.php">
                   <i class="fas fa-fw fa-cog"></i>
                   <span>Users</span>
               </a>
               <a class="nav-link collapsed" href="../../table_Chatuser.php" data-toggle="collapse" data-target="#collapseTwo"
                   aria-expanded="true" aria-controls="collapseTwo">
                   <i class="fas fa-fw fa-cog"></i>
                   <span>Chat users</span>
               </a>
               <a class="nav-link collapsed" href="../../table_messages.php" data-toggle="collapse" data-target="#collapseTwo"
                   aria-expanded="true" aria-controls="collapseTwo">
                   <i class="fas fa-fw fa-cog"></i>
                   <span>Chat messages</span>
               </a>
               <a class="nav-link collapsed" href="../../fetch.php" data-toggle="collapse" data-target="#collapseTwo"
                   aria-expanded="true" aria-controls="collapseTwo">
                   <i class="fas fa-fw fa-cog"></i>
                   <span>users and messages </span>
               </a>
               <a class="nav-link collapsed" href="../../listPack.php" data-toggle="collapse" data-target="#collapseUtilities"
                   aria-expanded="true" aria-controls="collapseUtilities">
                   <i class="fas fa-fw fa-wrench"></i>
                   <span>Gestion Packs</span>
               </a>
               <a class="nav-link collapsed" href="../../recherche.php" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
               <i class="fas fa-fw fa-wrench"></i>
               <span>recherche  Achats</span>
           </a>
           <a class="nav-link collapsed" href="../../ai pack.php" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
               <i class="fas fa-fw fa-wrench"></i>
               <span>ai description pack</span>
           </a>

           <a class="nav-link collapsed" href="../../send.php" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
               <i class="fas fa-fw fa-wrench"></i>
               <span>Mailing</span>
           </a>
           <a class="nav-link collapsed" href="../../listAchat.php" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
               <i class="fas fa-fw fa-wrench"></i>
               <span>Gestion Achats</span>
           </a>
           <a class="nav-link collapsed" href="../../dashboard.php" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
               <i class="fas fa-fw fa-wrench"></i>
               <span>Blog</span>
           </a>
           <a class="nav-link collapsed" href="dash_support/table_questions.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-question"></i>
                    <span >question support</span>
                </a>

                <a class="nav-link collapsed" href="dash_support/table_reponse.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-reply"></i>
                    <span >response support</span>
                </a>
                <a class="nav-link collapsed" href="../../dash_todo/plandash.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Manage Plans </span>
                </a>
                <a class="nav-link collapsed" href="../../dash_todo/taskdash.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Manage Tasks </span>
                </a>
                <a class="nav-link collapsed" href="../../dash_todo/searchtaskdash.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Search Tasks </span>
                </a>
       </ul>

<?php include '../../admin_header.php'; ?>

        <div class="container-fluid" style="background-color: white;">
            <!-- Filter Form -->
            <div class="row my-3">
                <div class="col-md-3">
                    <input type="text" id="usernameFilter" class="form-control" placeholder="Filter by Username" value="<?php echo htmlspecialchars($usernameFilter); ?>">
                </div>
                <div class="col-md-3">
                    <input type="text" id="emailFilter" class="form-control" placeholder="Filter by Email" value="<?php echo htmlspecialchars($emailFilter); ?>">
                </div>
                <div class="col-md-2">
                    <select id="genderFilter" class="form-control">
                        <option value="">Filter by Gender</option>
                        <option value="1" <?php echo $genderFilter == '1' ? 'selected' : ''; ?>>Female</option>
                        <option value="0" <?php echo $genderFilter == '0' ? 'selected' : ''; ?>>Male</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select id="statusFilter" class="form-control">
                        <option value="">Filter by Status</option>
                        <option value="1" <?php echo $statusFilter == '1' ? 'selected' : ''; ?>>Unlocked</option>
                        <option value="0" <?php echo $statusFilter == '0' ? 'selected' : ''; ?>>Locked</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="text" id="phoneFilter" class="form-control" placeholder="Filter by Phone" value="<?php echo htmlspecialchars($phoneFilter); ?>">
                </div>
            </div>

           <!-- CSV Download Button -->
<a id="downloadCSV" href="#" class="btn btn-primary mb-3" onclick="downloadCSV()">Download CSV</a>
<!-- Add a Save Filters button -->
<button class="btn btn-success" id="saveFiltersButton">Save Filters</button>
<!-- Dropdown to Select Saved Filters -->
<select id="savedFiltersSelect" class="form-control my-2">
    <option value="">Select Saved Filters</option>
</select>
<!-- Button to Delete Selected Filter -->
<button class="btn btn-danger" id="deleteFilterButton">Delete Selected Filter</button>


<script>
    // Function to load saved filters from localStorage
function loadSavedFilters() {
    var savedFilters = JSON.parse(localStorage.getItem('savedFilters')) || [];

    // Populate the saved filters dropdown
    $('#savedFiltersSelect').empty();
    $('#savedFiltersSelect').append('<option value="">Select Saved Filters</option>');
    savedFilters.forEach(function(filter, index) {
        $('#savedFiltersSelect').append('<option value="' + index + '">Filter Set ' + (index + 1) + '</option>');
    });

    // Apply the first saved filter if any
    if (savedFilters.length > 0) {
        applyFilter(savedFilters[savedFilters.length - 1]);
    }
}

// Function to delete the selected filter
$('#deleteFilterButton').on('click', function() {
    var selectedIndex = $('#savedFiltersSelect').val();
    if (selectedIndex === "") {
        alert("Please select a filter to delete.");
        return; // No filter selected
    }

    // Get the saved filters from localStorage
    var savedFilters = JSON.parse(localStorage.getItem('savedFilters')) || [];

    // Remove the selected filter by index
    savedFilters.splice(selectedIndex, 1);

    // Save the updated filters back to localStorage
    localStorage.setItem('savedFilters', JSON.stringify(savedFilters));

    // Reload the saved filters dropdown
    loadSavedFilters();

    // Optionally, show a confirmation message
    alert('Selected filter deleted successfully!');
});

function downloadCSV() {
    var visibleColumns = [];
    
    // Collect checked columns from the checkboxes
    for (var i = 1; i <= 5; i++) {
        if (document.getElementById('option' + i).checked) {
            visibleColumns.push(i);
        }
    }

    // Build the query string for the download URL
    var url = '?action=download&username=<?php echo urlencode($usernameFilter); ?>&email=<?php echo urlencode($emailFilter); ?>&gender=<?php echo urlencode($genderFilter); ?>&status=<?php echo urlencode($statusFilter); ?>&phone=<?php echo urlencode($phoneFilter); ?>&visibleColumns=' + visibleColumns.join(',');

    // Redirect to the download URL
    window.location.href = url;
}
</script>

            <table class="table table-bordered">
            <!-- Form with checkboxes -->
            <form>
    <div>
        <label><input type="checkbox" name="option1" id="option1" onclick="toggleColumn(1)" checked> Username</label><br>
        <label><input type="checkbox" name="option2" id="option2" onclick="toggleColumn(2)" checked> Email</label><br>
        <label><input type="checkbox" name="option3" id="option3" onclick="toggleColumn(3)" checked> Phone</label><br>
        <label><input type="checkbox" name="option4" id="option4" onclick="toggleColumn(4)" checked> Gender</label><br>
        <label><input type="checkbox" name="option5" id="option5" onclick="toggleColumn(5)" checked> Status</label><br>
    </div>
</form>


        </table>
            <!-- Table -->
            <table class="table table-bordered"  id="myTable">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($client['username']); ?></td>
                            <td><?php echo htmlspecialchars($client['email']); ?></td>
                            <td><?php echo htmlspecialchars($client['phone']); ?></td>
                            <td><?php echo $client['gender'] == 1 ? 'Female' : 'Male'; ?></td>
                            <td><?php echo $client['status'] == 1 ? 'Unlocked' : 'Locked'; ?></td>
                            <td>
                                <a href="?action=delete&id=<?php echo $client['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                <?php if ($client['status'] == 1): ?>
                                    <a href="?action=lock&id=<?php echo $client['id']; ?>" class="btn btn-secondary btn-sm">Lock</a>
                                <?php else: ?>
                                    <a href="?action=unlock&id=<?php echo $client['id']; ?>" class="btn btn-primary btn-sm">Unlock</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Scripts -->
        <script>
           $(document).ready(function() {
    // Load the saved filter sets when the page loads
    function loadSavedFilters() {
        var savedFilters = JSON.parse(localStorage.getItem('savedFilters')) || [];

        // Populate the saved filters dropdown
        $('#savedFiltersSelect').empty();
        $('#savedFiltersSelect').append('<option value="">Select Saved Filters</option>');
        savedFilters.forEach(function(filter, index) {
            $('#savedFiltersSelect').append('<option value="' + index + '">Filter Set ' + (index + 1) + '</option>');
        });

        // Apply the first saved filter if any
        if (savedFilters.length > 0) {
            applyFilter(savedFilters[savedFilters.length - 1]);
        }
    }

    // Apply the selected saved filter
    $('#savedFiltersSelect').on('change', function() {
        var selectedIndex = $(this).val();
        if (selectedIndex === "") return; // If no filter is selected, do nothing

        var savedFilters = JSON.parse(localStorage.getItem('savedFilters')) || [];
        var filterSet = savedFilters[selectedIndex];

        // Apply the selected filter set
        applyFilter(filterSet);
    });

    // Function to apply the filter settings
    function applyFilter(filterSet) {
        $('#usernameFilter').val(filterSet.username);
        $('#emailFilter').val(filterSet.email);
        $('#genderFilter').val(filterSet.gender);
        $('#statusFilter').val(filterSet.status);
        $('#phoneFilter').val(filterSet.phone);

        // Apply the column visibility based on saved visibility
        for (var i = 1; i <= 5; i++) {
            if (filterSet['column' + i] === false) {
                $('#option' + i).prop('checked', false);
                toggleColumn(i); // Hide the column
            } else {
                $('#option' + i).prop('checked', true);
                toggleColumn(i); // Show the column
            }
        }
    }

    // Save the current filter settings to localStorage when the Save button is clicked
    $('#saveFiltersButton').on('click', function() {
        var savedFilters = JSON.parse(localStorage.getItem('savedFilters')) || [];
        
        // Create a new filter set object
        var newFilterSet = {
            username: $('#usernameFilter').val(),
            email: $('#emailFilter').val(),
            gender: $('#genderFilter').val(),
            status: $('#statusFilter').val(),
            phone: $('#phoneFilter').val(),
        };

        // Add column visibility settings
        for (var i = 1; i <= 5; i++) {
            newFilterSet['column' + i] = $('#option' + i).prop('checked');
        }

        // Save the new filter set
        savedFilters.push(newFilterSet);
        localStorage.setItem('savedFilters', JSON.stringify(savedFilters));

        // Reload the saved filters dropdown
        loadSavedFilters();

        // Optionally, show a confirmation message
        alert('Filters saved successfully!');
    });

    // Delete the selected filter
    $('#deleteFilterButton').on('click', function() {
        var selectedIndex = $('#savedFiltersSelect').val();
        if (selectedIndex === "") {
            alert("Please select a filter to delete.");
            return; // No filter selected
        }

        // Get the saved filters from localStorage
        var savedFilters = JSON.parse(localStorage.getItem('savedFilters')) || [];

        // Remove the selected filter by index
        savedFilters.splice(selectedIndex, 1);

        // Save the updated filters back to localStorage
        localStorage.setItem('savedFilters', JSON.stringify(savedFilters));

        // Reload the saved filters dropdown
        loadSavedFilters();

        // Optionally, show a confirmation message
        alert('Selected filter deleted successfully!');
    });

    // Initial load of saved filters
    loadSavedFilters();
});

            $('#saveFiltersButton').on('click', function() {
    // Save the filter values to localStorage when the Save button is clicked
    localStorage.setItem('usernameFilter', $('#usernameFilter').val());
    localStorage.setItem('emailFilter', $('#emailFilter').val());
    localStorage.setItem('genderFilter', $('#genderFilter').val());
    localStorage.setItem('statusFilter', $('#statusFilter').val());
    localStorage.setItem('phoneFilter', $('#phoneFilter').val());

    // Optionally, you can show a confirmation message to the user
    alert('Filters saved successfully!');
});

            $(document).ready(function() {
                // Table Filtering
                $('#usernameFilter').on('keyup', function() {
                    window.location.href = '?username=' + $(this).val();
                });

                $('#emailFilter').on('keyup', function() {
                    window.location.href = '?email=' + $(this).val();
                });

                $('#genderFilter').on('change', function() {
                    window.location.href = '?gender=' + $(this).val();
                });

                $('#statusFilter').on('change', function() {
                    window.location.href = '?status=' + $(this).val();
                });

                $('#phoneFilter').on('keyup', function() {
                    window.location.href = '?phone=' + $(this).val();
                });
            });
            /////////////////////////////////////////////////hide 
            function toggleColumn(columnIndex) {
    var checkbox = document.getElementById("option" + columnIndex); // Get checkbox by ID
    var table = document.getElementById("myTable"); // Get table by ID
    var cells = table.querySelectorAll("td:nth-child(" + columnIndex + "), th:nth-child(" + columnIndex + ")");
    // Get all cells in the column (both <td> and <th> elements for that column)

    if (checkbox.checked) {
        // If the checkbox is checked, remove the 'hidden' class to show the column
        cells.forEach(function(cell) {
            cell.classList.remove("hidden");
        });
    } else {
        // If the checkbox is unchecked, add the 'hidden' class to hide the column
        cells.forEach(function(cell) {
            cell.classList.add("hidden");
        });
    }
}

        </script>
    </div>
</body>
</html> 