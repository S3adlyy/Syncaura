<?php

include 'C:/xampp/htdocs/Forum/config.php'; // Inclure la configuration de connexion à la base de données
include 'C:/xampp/htdocs/Forum/Model/questions.php';
//include 'C:/xampp/htdocs/Forum/Model/Reponses.php';

/*try {
    $pdo = new PDO('mysql:host=localhost;dbname=forum', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
    exit;
}

$forumC = new ForumC($pdo);
$list = $forumC->addreponses();*/
?>






<!DOCTYPE php>
<php lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <!-- Fontawesom Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <i class="fa-sharp fa-solid fa-shield-halved"></i>
                        </span>
                        <span class="title brand">SkySchool</span>
                    </a>
                </li>

                <li>
                    <a href="dashboard.php">
                        <span class="icon">
                            <i class="fa-solid fa-gauge"></i>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="enroll.php">
                        <span class="icon">
                            <i class="fas fa-duotone fa-book"></i>
                        </span>
                        <span class="title">Course Enrollemnet</span>
                    </a>
                </li>

                <li>
                    <a href="classes.php">
                        <span class="icon">
                            <i class="fas fa-duotone fa-person-chalkboard"></i>
                        </span>
                        <span class="title">My Classes</span>
                    </a>
                </li>

                <li>
                    <a href="attendence.php">
                        <span class="icon">
                            <i class="fa-solid fa-clipboard-user"></i>
                        </span>
                        <span class="title">Attendence</span>
                    </a>
                </li>

                <li>
                    <a href="assignment.php">
                        <span class="icon">
                            <i class="fa-sharp fa-solid fa-pen-to-square"></i>
                        </span>
                        <span class="title">Assignment</span>
                    </a>
                </li>

                <li>
                    <a href="Forum.php">
                        <span class="icon">
                            <i class="fa-solid fa-square-poll-vertical"></i>
                        </span>
                        <span class="title">Forum</span>
                    </a>
                </li>

                <li>
                    <a href="fee.php">
                        <span class="icon">
                            <i class="fa-solid fa-sack-dollar"></i>
                        </span>
                        <span class="title">Fee</span>
                    </a>
                </li>list

                <li>
                    <a href="login.php">
                        <span class="icon">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
        
        
        <!-- ========================= Main ==================== -->
        <div class="main" id="results">
            <div class="topbar">
                <div class="toggle">
                    <i class="fa-solid fa-list"></i>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>

            

            <!-- Class Fee Details -->

            <div class="results">
                <div class="courseresults">
                    <div class="resultsHeader">
                        <h2>add reponse</h2>
                    </div>
                    
                   


                    <table>
                        <thead>
                            <tr>
                                <td>Id</td>
                                <td>Type</td>
                                <td> Date</td>
                                <th>Actions</th>
                               
                            </tr>
                        </thead>
    
                        <tbody>
    

                            <tr>
                                <td>1</td>
                                <td>computer_science</td>
                                <td>2023/02/26</td>
                                <td>
                                <a href="addreponse.php" class="btn btn-sm btn-primary custom-blue">add</a>
                                


                                  </td>
                            </tr>
    
                            <tr>
                                <td>2</td>
                                <td>Physics</td>
                                <td>2023/02/29</td>
                                <td>
                                <a href="addreponse.php" class="btn btn-sm btn-primary custom-blue">add</a>
                                
                                


                                  </td>
                            </tr>
    
                            <tr>
                                <td>3</td>
                                <td>scientific</td>
                                <td>2023/03/05</td>
                                <td>
                                <a href="addreponse.php" class="btn btn-sm btn-primary custom-blue">add</a>
                                
                                

                                  </td>
                            </tr>
    
                            <tr>
                                <td>4</td>
                                <td>Math</td>
                                <td>2023/03/08</td>
                                <td>
                                <a href="addreponse.php" class="btn btn-sm btn-primary custom-blue">add</a>
                                
                                


                                    
                                    
                                  </td>
                            </tr>
                            
                        </tbody>
                    </table>
                    
                </div>
               
            </div>
                    
        </div>
    </div>

    


    <!-- Scripts -->
    <script src="assets/js/main.js"></script>
</body>

</php>
<style>


/* Bleu personnalisé */
.custom-blue {
    background-color: #007bff; /* Couleur bleu */
    border-color: #007bff;     /* Bordure bleu */
    color: black;
}

.custom-blue:hover {
    background-color: #0056b3; /* Couleur bleu foncé au survol */
    border-color: #0056b3;
}


/* Rouge personnalisé */
.custom-red {
    background-color: #dc3545; /* Couleur rouge */
    border-color: #dc3545;
    color: black;
}

.custom-red:hover {
    background-color: #c82333; /* Couleur rouge foncé au survol */
    border-color: #c82333;
}
</style>