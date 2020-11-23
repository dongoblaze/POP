<?php


if( isset($_POST['submit'])){
    $clerkID = htmlspecialchars($_POST['clerkID']);//htmlspecialchars for security purposes
    $constituencyID = htmlspecialchars($_POST['constituencyID']);
    $pdID = htmlspecialchars($_POST['pdID']);
    $pollingstation = htmlspecialchars($_POST['pollingstation']);
    $votesforcandidate1 = htmlspecialchars($_POST['votesforcandidate1']);
    $votesforcandidate2 = htmlspecialchars($_POST['votesforcandidate2']);
    $rejected = htmlspecialchars($_POST['rejected']);
    $totalnumofvotes = htmlspecialchars($_POST['totalnumofvotes']);

    try {
        require_once 'dbconfig.php';
        //making connection to database
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        echo "Connected to $dbname at $host successfully.";
        $conn = null;
    }catch (PDOException $pe) {
        die("Could not connect to the database $dbname :" . $pe->getMessage());
    }
        //inserting into database
        $votes = "INSERT INTO stationvotes (Constituency_id,Clerk_id,Poll_division_id,Polling_stn,Candidate1Votes,Candidate2Votes,RejectedVotes,TotalVotes,recordDigest)
        VALUES ('$constituencyID','$clerkID','$pdID','$pollingstation','$votesforcandidate1','$votesforcandidate2','$rejected','$totalnumofvotes')";
        $stm = $conn->query($votes);

        //selecting elements from database
        $sql = $conn->query("SELECT * FROM representatives");
        $results = $sql ->fetchALL(PDO ::FETCH_ASSOC);

       #display the content of the database as table
       $p1a = '<link rel="stylesheet" type="text/css" href="/Student_ID/styles/p1b.css"/>
        <div>
        <table id="tab">
            <tr>
            <th>Clerk ID:</th><th>Constitnuency ID</th><th>Polling division ID:</th>
            <th>polling station</th><th>Votes for candidate1</th><th>Votes for candidate2</th>
            <th>Rejected Ballots</th><th>Total number of votes</th>
            </tr>';
        foreach ($results as $row) {
            $p1a .=  '<tr><td>' . $row['first_name'] .'</td><td>'. $row['last_name'] . '</td><td>' . $row['constituency'] . '</td><td class="email">' .$row['email'] .'</td><td>'. $row['yrs_service'] .'</td><td>' .$row['password_digest'] .'</td><td>'. $row['salt'] .'</td></tr>';
                                
        }
        $p1a .= '</table></div>'; 
        print($p1a);
        // if ($conn->query($votes) === TRUE) {
        //     echo "New record created successfully";
        //     $conn= null;
        // } else {
        //     echo "Error: "  $votes . "<br>" . $conn->error;
        // }
        // $conn->close();
      
    //  $sql = $conn->query("SELECT * FROM stationvotes");
    //  $results = $sql ->fetchALL(PDO ::FETCH_ASSOC);
     //selecting elements from database
    //  $sql = $conn->query("SELECT * FROM StationVotes");
    //  $results = $sql ->fetchALL(PDO ::FETCH_ASSOC);




}

?>




