<html>
    <head>
        <title>National Hockey League Database (NHL)</title>
    </head>

    <body>
        <h2 style="font-family:verdana;">Reset</h2>
        <p>If you wish to reset the table press on the reset button. If this is the first time you're running this page, you MUST use reset</p>

        <form method="POST" action="playerDemo.php">
            <!-- if you want another page to load after the button is clicked, you have to specify that page in the action parameter -->
            <input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
            <p><input type="submit" value="Reset" name="reset"></p>
        </form>

        <hr />

        <h2 style="font-family:verdana;">Add Information of a new Player</h2>
        <form method="POST" action="playerDemo.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
            Team ID: <input type="text" name="tid"> <br /><br />
            Player ID: <input type="text" name="pid"> <br /><br />
            Name: <input type="text" name="name"> <br /><br />
            Position: <input type="text" name="position"> <br /><br />
            Points: <input type="text" name="point"> <br /><br />
            Goals: <input type="text" name="goal"> <br /><br />
            Assists: <input type="text" name="assist"> <br /><br />
            Shootout: <input type="text" name="shootout"> <br /><br />

            <input type="submit" value="Insert" name="insertSubmit"></p>
        </form>

        <hr />

        <h2 style="font-family:verdana;">Delete information of a Player</h2> 
        <form method="POST" action="playerDemo.php"> <!-- refresh page when submitted -->
            <input type="hidden" id="deleteQueryRequest" name="deleteQueryRequest">
            Name: <input type="text" name="playerName"> <br /><br /> 

            <input type="submit" value="Delete" name="deleteSubmit"></p>
        </form> 



        <hr />

        <h2 style="font-family:verdana;">View All the Players</h2>
        <form method="GET" action="playerDemo.php"> <!--refresh page when submitted-->
            <input type="hidden" id="viewValueRequest" name="viewValueRequest">
            <input type="submit" , value="View", name="viewValues"></p>
        </form>

        <hr />

        <h2 style="font-family:verdana;">View All the Teams</h2>
        <form method="GET" action="playerDemo.php"> <!--refresh page when submitted-->
            <input type="hidden" id="viewTeamRequest" name="viewTeamRequest">
            <input type="submit" , value="View", name="viewTeams"></p>
        </form>

        <hr />

        <h2 style="font-family:verdana;">View Attributes Name of the two tables</h2>
        <form method="GET" action="playerDemo.php"> <!--refresh page when submitted-->
            <input type="hidden" id="viewByAttributeRequest" name="viewByAttributeRequest">

            <div>
            <label>
            <input type="radio" value="PLAYER" name="attribute" />Player</label>
            <label>
            <input type="radio" value="TEAM" name="attribute" />Team</label>
            </div>
           
            <p><input type="submit" , value="View", name="viewByAttribute"></p>
        </form>

        <hr />

        <h2 style="font-family:verdana;">View the Players in a Certain Team </h2>
        <form method="GET" action="playerDemo.php"> <!--refresh page when submitted-->
            <input type="hidden" id="viewCertainValueRequest" name="viewCertainValueRequest">
            Team Name: <input type="text" name="teamName"> <br /><br /> 

            <input type="submit" , value="View", name="viewCertainValues"></p>
        </form>

        <hr />

        <h2 style="font-family:verdana;">Find the Highest Points in Every Team with at least 2 players</h2>
        <form method="GET" action="playerDemo.php"> <!--refresh page when submitted-->
            <input type="hidden" id="viewHighRequest" name="viewHighRequest">
            <input type="submit" , value="View", name="viewHighValues"></p>
        </form>

        <hr />




        <h2 style="font-family:verdana;">Update Name of a Player</h2>
        <p>The values are case sensitive and if you enter in the wrong case, the update statement will not do anything.</p>

        <form method="POST" action="playerDemo.php"> <!--refresh page when submitted-->
            <input type="hidden" id="updateQueryRequest" name="updateQueryRequest" >
            Old Name: <input type="text" name="oldName"> <br /><br />
            New Name: <input type="text" name="newName"> <br /><br />

            <input type="submit" value="Update" name="updateSubmit"></p>
        </form>

        <hr />

        <h2 style="font-family:verdana;">Count the Tuples in Player</h2>
        <form method="GET" action="playerDemo.php"> <!--refresh page when submitted-->
            <input type="hidden" id="countTupleRequest" name="countTupleRequest">
            <input type="submit" name="countTuples"></p>
        </form>

        <?php
		//this tells the system that it's no longer just parsing html; it's now parsing PHP

        $success = True; //keep track of errors so it redirects the page only if there are no errors
        $db_conn = NULL; // edit the login credentials in connectToDB()
        $show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())

        function debugAlertMessage($message) {
            global $show_debug_alert_messages;

            if ($show_debug_alert_messages) {
                echo "<script type='text/javascript'>alert('" . $message . "');</script>";
            }
        }

        function executePlainSQL($cmdstr) { //takes a plain (no bound variables) SQL command and executes it
            //echo "<br>running ".$cmdstr."<br>";
            global $db_conn, $success;

            $statement = OCIParse($db_conn, $cmdstr);
            //There are a set of comments at the end of the file that describe some of the OCI specific functions and how they work

            if (!$statement) {
                echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
                $e = OCI_Error($db_conn); // For OCIParse errors pass the connection handle
                echo htmlentities($e['message']);
                $success = False;
            }

            $r = OCIExecute($statement, OCI_DEFAULT);
            if (!$r) {
                echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
                $e = oci_error($statement); // For OCIExecute errors pass the statementhandle
                echo htmlentities($e['message']);
                $success = False;
            }

			return $statement;
		}

        function executeBoundSQL($cmdstr, $list) {
            /* Sometimes the same statement will be executed several times with different values for the variables involved in the query.
		In this case you don't need to create the statement several times. Bound variables cause a statement to only be
		parsed once and you can reuse the statement. This is also very useful in protecting against SQL injection.
		See the sample code below for how this function is used */

			global $db_conn, $success;
			$statement = OCIParse($db_conn, $cmdstr);

            if (!$statement) {
                echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
                $e = OCI_Error($db_conn);
                echo htmlentities($e['message']);
                $success = False;
            }

            foreach ($list as $tuple) {
                foreach ($tuple as $bind => $val) {
                    //echo $val;
                    //echo "<br>".$bind."<br>";
                    OCIBindByName($statement, $bind, $val);
                    unset ($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
				}

                $r = OCIExecute($statement, OCI_DEFAULT);
                if (!$r) {
                    echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
                    $e = OCI_Error($statement); // For OCIExecute errors, pass the statementhandle
                    echo htmlentities($e['message']);
                    echo "<br>";
                    $success = False;
                }
            }
        }

        function printResult($result) { //prints results from a select statement
            echo "<table>";
            echo "<tr><th>Team ID</th><th>Player ID</th><th>Player Name</th><th>Position</th><th>Points</th><th>Goals</th><th>Assists</th><th>Shootout</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . 
                $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . 
                $row[5] . "</td><td>" . $row[6] . "</td><td>" . $row[7] ."</td><tr>"; //or just use "echo $row[0]"
            }

            echo "</table>";
        }

        function printTeamResult($result) {
            echo "<table>";
            echo "<tr><th>Team ID</th><th>Rank</th><th>Value</th><th>Name</th><th>Founded Year</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . 
                $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] ."</td><tr>"; 
            }

            echo "</table>";

        }

        function printHighestResult($result) { //prints results from a select statement
            echo "<table>";
            echo "<tr><th>Team ID</th><th>Points</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1]  ."</td><tr>"; //or just use "echo $row[0]"
            }

            echo "</table>";
        }

        function connectToDB() {
            global $db_conn;

            // Your username is ora_(CWL_ID) and the password is a(student number). For example,
			// ora_platypus is the username and a12345678 is the password.
            $db_conn = OCILogon("ora_taodingr", "a78034089", "dbhost.students.cs.ubc.ca:1522/stu");

            if ($db_conn) {
                debugAlertMessage("Database is Connected");
                return true;
            } else {
                debugAlertMessage("Cannot connect to Database");
                $e = OCI_Error(); // For OCILogon errors pass no handle
                echo htmlentities($e['message']);
                return false;
            }
        }

        function disconnectFromDB() {
            global $db_conn;

            debugAlertMessage("Disconnect from Database");
            OCILogoff($db_conn);
        }

        function handleUpdateRequest() {
            global $db_conn;

            $old_name = $_POST['oldName'];
            $new_name = $_POST['newName'];

            // you need the wrap the old name and new name values with single quotations
            executePlainSQL("UPDATE Player SET playerName='" . $new_name . "' WHERE playerName='" . $old_name . "'");
            OCICommit($db_conn);
        }

        function handleResetRequest() {
            global $db_conn;
            // Drop old table
            executePlainSQL("DROP TABLE Player");
            

            // Create new table
            echo "<br> Reloading original Player table <br>";
            OCICommit($db_conn);
        }

        function handleInsertRequest() {
            global $db_conn;


            //Getting the values from user and insert data into the table
            $tuple = array (
                ":bind1" => $_POST['tid'],
                ":bind2" => $_POST['pid'],
                ":bind3" => $_POST['name'],
                ":bind4" => $_POST['position'],
                ":bind5" => $_POST['point'],
                ":bind6" => $_POST['goal'],
                ":bind7" => $_POST['assist'],
                ":bind8" => $_POST['shootout']
            );

            $alltuples = array (
                $tuple
            );

            executeBoundSQL("insert into Player values (:bind1, :bind2, :bind3, :bind4, :bind5, :bind6, :bind7, :bind8)", $alltuples);
            OCICommit($db_conn);
        }

        function viewByAttributeRequest() {
            global $db_conn;

            $attribute = $_GET['attribute'];
            

            $result = executePlainSQL("SELECT column_name FROM USER_TAB_COLUMNS WHERE table_name = '".$attribute."' ");
           
         
            
            echo "<table>";
            echo "<tr><th>Column Names</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] ."</td><tr>"; 
            }

            echo "</table>";
            
            OCICommit($db_conn);

        }

        function handleCountRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT Count(*) FROM Player");

            if (($row = oci_fetch_row($result)) != false) {
                echo "<br> The number of tuples in Player: " . $row[0] . "<br>";
            }
        }

        function handleDeleteRequest() {
            global $db_conn;

            $playerName = $_POST['playerName'];

            executePlainSQL("DELETE FROM Player WHERE playerName = '" . $playerName . "' ");
            OCICommit($db_conn);

        }

        function handleViewRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT * FROM Player");

            echo "<br>All Players in NHL<br>";
            echo printResult($result);
        }

        function handleViewTeamsRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT * FROM Team");
            
            echo "<br>All Teams in NHL<br>";
            echo printTeamResult($result);

        }

        function handleViewHighRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT tid, max(points) FROM Player GROUP BY tid HAVING count(*) > 1");
            
            echo "<br>Highest Points in Every Team<br>";
            echo printHighestResult($result);
        }

        function handleViewCertainRequest() {
            global $db_conn;

            $teamName = $_GET['teamName'];
            $result = executePlainSQL("SELECT * FROM Player P, Team T WHERE T.name = '" . $teamName . "' AND P.tid = T.id");

            echo "<br>All Players in Team : " . $teamName. "<br>";
            echo printResult($result);

        }

        // HANDLE ALL POST ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handlePOSTRequest() {
            if (connectToDB()) {
                if (array_key_exists('resetTablesRequest', $_POST)) {
                    handleResetRequest();
                } else if (array_key_exists('updateQueryRequest', $_POST)) {
                    handleUpdateRequest();
                } else if (array_key_exists('insertQueryRequest', $_POST)) {
                    handleInsertRequest();
                } else if (array_key_exists('deleteQueryRequest', $_POST)) {
                    handleDeleteRequest();
                } 

                disconnectFromDB();
            }
        }

        // HANDLE ALL GET ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handleGETRequest() {
            if (connectToDB()) {
                if (array_key_exists('countTuples', $_GET)) {
                    handleCountRequest();
                } else if (array_key_exists('viewValues', $_GET)) {
                    handleViewRequest();
                } else if (array_key_exists('viewCertainValues', $_GET)) {
                    handleViewCertainRequest();
                } else if (array_key_exists('viewHighValues', $_GET)) {
                    handleViewHighRequest();
                } else if (array_key_exists('viewTeams', $_GET)) {
                    handleViewTeamsRequest();
                } else if (array_key_exists('viewByAttribute', $_GET)) {
                    viewByAttributeRequest();
                } 

                disconnectFromDB();
            }
        }

		if (isset($_POST['reset']) || isset($_POST['updateSubmit']) || isset($_POST['insertSubmit']) || isset($_POST['deleteSubmit'])) {
            handlePOSTRequest();
        } else if (isset($_GET['countTupleRequest']) || isset($_GET['viewValueRequest']) || isset($_GET['viewCertainValueRequest']) || isset($_GET['viewByAttributeRequest'])
        || isset($_GET['viewHighRequest']) || isset($_GET['viewTeamRequest'])) {
            handleGETRequest();
        }
		?>
	</body>
</html>
