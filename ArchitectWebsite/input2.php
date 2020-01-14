<!DOCTYPE html>
<html>

<head>
    <title> Connecting to Oracle! </title>
    <meta charset="utf-8" />

    <?php
       ini_set('display_errors', 1);
       error_reporting(E_ALL);
    ?>

    <link href=
        "http://nrs-projects.humboldt.edu/~st10/styles/normalize.css"
        type="text/css" rel="stylesheet" />

    <link href="try-oracle.css" type="text/css"   
          rel="stylesheet" />
</head>

<body>
<h1> Connecting PHP to Oracle </h1>

<?php
// do you need to ask for username and password?

    if ( ! array_key_exists("username", $_POST) )
    {
        // no username in $_POST? they need a login
        //     form!
        ?>
  
        <form method="post" 
              action="<?= htmlentities($_SERVER['PHP_SELF'], 
                                        ENT_QUOTES) ?>">
        <fieldset>
            <legend> Please enter Oracle username/password: 
                </legend>

            <label for="username"> Username: </label>
            <input type="text" name="username" id="username" /> 

            <label for="password"> Password: </label>
            <input type="password" name="password" 
                   id="password" />

            <div class="submit">
                <input type="submit" value="Log in" />
            </div>
        </fieldset>
        </form>
    <?php
	}
	
	else
	{
		// being paranoid, I am stripping tags from
        //    the username, just in case

        $username = strip_tags($_POST["username"]);

        // the ONLY thing I am doing with the given password
        //    is using it to try to log into Oracle - SO
        //    I hope this is OK:

        $password = $_POST["password"];

        $db_conn_str = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)
                                    (HOST = cedar.humboldt.edu)
                                    (PORT = 1521))
                               (CONNECT_DATA = (SID = STUDENT)))";

        $conn = oci_connect($username, $password, $db_conn_str);

        // exit if could not connect

		$arch_stmt = oci_parse($conn, OCI_DEFAULT);
		
        if (! $conn)
		{
        ?>
            <p> Could not log into Oracle, sorry </p>

            <?php
            require_once("328footer.html");
            exit;
        }
		
		// if I reach here -- I connected!!

		
		if(isset($_POST['name'])){
		$name = $_POST['name'];
		$phone_num = $_POST['number'];
		$location = $_POST['location'];
		$building = $_POST['building'];
		$bedroom = $_POST['bedroom'];
		$bathroom = $_POST['bathroom'];
		$sqr_foot = $_POST['big'];
		$price = $_POST['price'];
		
		$arch_query_str = "INSERT INTO 
					Architect {arch_name,
							phone_num,
							location,
							type_build,
							bedrooms,
							bathrooms,
							square_foot,
							price_range,
							} VALUES {
							:name,
							:phone_num,
							:location,
							:building,
							:bedroom,
							:bathroom,
							:big,
							:price
							)";
		
		oci_bind_by_name($arch_query_str, ':name', $name);
		oci_bind_by_name($arch_query_str, ':phone_num', $phone_num);
		oci_bind_by_name($arch_query_str, ':location', $location);
		oci_bind_by_name($arch_query_str, ':building', $building);
		oci_bind_by_name($arch_query_str, ':bedroom', $bedroom);
		oci_bind_by_name($arch_query_str, ':bathroom', $bathroom);
		oci_bind_by_name($arch_query_str, ':big', $sqr_foot);
		oci_bind_by_name($arch_query_str, ':price', $price);
		oci_execute($arch_query_str);
		
		$arch_query_str = ("SELECT * FROM ARCHITECT");
		
		$arch_stmt = oci_parse($conn, $arch_query_str);
		oci_execute($arch_stmt, OCI_DEFAULT);

		?>
		<table>
        <caption> Architect information </caption>
        <tr> <th scope="col"> Architect Name </th>
             <th scope="col"> Phone Number </th>
             <th scope="col"> Location </th>
             <th scope="col"> Building </th>
			 <th scope="col"> Bedrooms </th>
			 <th scope="col"> Bathrooms </th>
			 <th scope="col"> Square Foot </th>
			 <th scope="col"> Price Range </th>
			 
		</tr>

	<?php
        while (oci_fetch($arch_stmt))
        {
            $curr_arch_name = oci_result($arch_stmt, "arch_name");
            $curr_arch_phone = oci_result($arch_stmt, "phone_num");
            $curr_arch_loc = oci_result($arch_stmt, "location");
            $curr_arch_build = oci_result($arch_stmt, "building");
			$curr_arch_bed = oci_result($arch_stmt, "bedroom");
			$curr_arch_bath = oci_result($arch_stmt, "bathroom");
			$curr_arch_sqr = oci_result($arch_stmt, "sqr_foot");
			$curr_arch_price = oci_result($arch_stmt, "price");

            ?>

            <tr> <td> <?= $curr_arch_name ?> </td>
                 <td> <?= $curr_arch_phone ?> </td>
                 <td> <?= $curr_arch_loc ?> </td>
                 <td> <?= $curr_arch_build ?> </td>
				 <td> <?= $curr_arch_bed ?> </td>
				 <td> <?= $curr_arch_bath ?> </td>
				 <td> <?= $curr_arch_sqr ?> </td>
				 <td> <?= $curr_arch_price ?> </td>
            </tr>
            <?php
        }
        ?>
        </table>
		
		<?php
        // remember to FREE your statement objects,
        //     and CLOSE YOUR CONNECTION!!!!!!!!!!!!!

        oci_free_statement($arch_stmt);
        oci_close($conn);
		}
	}
		 ?>

    <hr />

    <p>
        Validate by pasting .xhtml copy's URL into<br />
        <a href="https://html5.validator.nu/">
            https://html5.validator.nu/
        </a>
    </p>

    <p>
        <a href=
           "http://jigsaw.w3.org/css-validator/check/referer?profile=css3">
            <img src="http://jigsaw.w3.org/css-validator/images/vcss"
                 alt="Valid CSS3!" height="31" width="88" />
        </a>
    </p>

</body>
</html>