<?php
//Задача 1 (php).
$dbhost ='localhost';
$dbuser='root';
$dbpass='';
$dbname='masive';
$db = mysqli_connect($dbhost,$dbuser,$dbpass) or die("нету подключения");
mysqli_select_db($db,$dbname) or die("не выбрана база");


//require 'db.php';

function render_strngs(array $words, $count)
{
    $massivvsehstrok = array();

    for ($i = 0; $i < $count; $i++)
    {

        shuffle($words);

        $stroka = implode(" ", $words);


        array_push($massivvsehstrok, $stroka);

    }
    return $massivvsehstrok;

}

function get_uniques(array $strings)
{

    $uniqstroki = array();

    foreach ($strings as $value) {
        if (!in_array($value, $uniqstroki)) {
            $uniqstroki[] = $value;
        }
    }

    return $uniqstroki;
}
$words = ['red', 'green', 'yellow', 'blue', 'orange'];


$t = microtime(true);

$strings = render_strngs($words, 100);

echo "T = ".(microtime(true) - $t)."\n";
echo '<br>';
$t = microtime(true);

$uniques = get_uniques($strings);

echo "T = ".(microtime(true) - $t)."\n";

echo '<br>';

//print_r($uniques);

//Задача 2 (php + MySQL).
foreach ($uniques as $key=>$values)
{
    //magic created here
    $sql1= "CREATE TEMPORARY TABLE strings2(strings VARCHAR(100));";
    $sql2 ="INSERT INTO strings2 (`strings`) VALUES ('".$values."');";
    $sql3 = "INSERT INTO strings(`strings`) SELECT `strings` FROM  strings2 where NOT EXISTS (SELECT * from strings WHERE strings.strings = strings2.strings);";

    mysqli_query($db,$sql1);
    mysqli_query($db,$sql2);
    mysqli_query($db,$sql3);


//     print_r($values);
//     return $result;
}

//Задача 3 (MySQL).
//Здесь как варианта чтобы сделать запрос более универсальныым
//более близько подходит функционал баззы данных делать
//выборку  по MONTH, но в phpmyadmin такой функции не предусмотренно,
//поэтому делаем по периодно через простую функцию ------DELETE FROM table WHERE created_at < 'date';---



//Задача 4 (Redis).

/**
 * Creates new user
 *
 * @param array $user_data          User data contains the following fields:
 *                                      - name
 *                                      - email
 *                                      - password_hash
 *
 * @return string                   Returns ID of created user
 *
 * @throws \UserExistsException     Throws exception if user with this email already exists
 *
 */



//DB-connect REDIS
function create_user(array $user_data)
{
    $redis->set(intval($redis->get('lastid')), json_encode(array(
        'name' => $name,
        'email' => $email,
        'password_hash' => $password_hash
    )));
    $redis->incr('lastid');  // your code here
}

/**
 * Finds user by combination of email and password hash
 *
 * @param string $email
 * @param string $password_hash
 *
 * @return string|null                   Returns ID of user or null if user not found
 */
function authorize_user($email, $password_hash)
{
    print_r(json_decode($redis->get($redis->get('lastid')),true));  // your code here
}

