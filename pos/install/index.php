<?php 

$opencart_path = realpath(dirname(__FILE__) . '/../../') . '/';

require_once $opencart_path.'config.php';

$connect = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if (!$connect) die("Unable to connect to database: " . mysqli_error($connect));

//check if install 
$result = mysqli_query($connect,"SHOW TABLES LIKE '_pos_withdraw'");
$tableExists = mysqli_num_rows($result) > 0;
$sql1 = '';
if(!$tableExists) {

    // make sql changes 
    $sql = 'CREATE TABLE IF NOT EXISTS `'.DB_PREFIX.'cart_holder` ( `cart_holder_id` int(100) NOT NULL AUTO_INCREMENT,  `user_id` int(100) NOT NULL,  `name` varchar(100) NOT NULL,  `cart` text NOT NULL, `date_created` datetime NOT NULL,  PRIMARY KEY (`cart_holder_id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;';
    mysqli_query($connect, $sql);

    $sql = 'CREATE TABLE IF NOT EXISTS `'.DB_PREFIX.'pos_withdraw` ( `pos_withdraw_id` int(100) NOT NULL AUTO_INCREMENT,  `user_id` int(100) NOT NULL,  `amount` decimal(10,2) NOT NULL,  `date` datetime NOT NULL,  PRIMARY KEY (`pos_withdraw_id`)) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;';
    mysqli_query($connect, $sql);

    $sql = "INSERT INTO `".DB_PREFIX."setting` (`setting_id` ,`store_id` ,`group` ,`key` ,`value` ,`serialized`)VALUES (NULL , '0', 'config', 'pos_status', '1', '0');";
    mysqli_query($connect, $sql);

    //tin_no
    $sql = "INSERT INTO `".DB_PREFIX."setting` (`setting_id` ,`store_id` ,`group` ,`key` ,`value` ,`serialized`)VALUES (NULL , '0', 'config', 'pos_tin_no', '1234', '0');";
    mysqli_query($connect, $sql);

    //show_tin?
    $sql = "INSERT INTO `".DB_PREFIX."setting` (`setting_id` ,`store_id` ,`group` ,`key` ,`value` ,`serialized`)VALUES (NULL , '0', 'config', 'pos_show_tin_no', '1', '0');";
    mysqli_query($connect, $sql);

    //show_store?
    $sql = "INSERT INTO `".DB_PREFIX."setting` (`setting_id` ,`store_id` ,`group` ,`key` ,`value` ,`serialized`)VALUES (NULL , '0', 'config', 'pos_show_store_name', '1', '0');";
    mysqli_query($connect, $sql);
    
    //show_address?
    $sql = "INSERT INTO `".DB_PREFIX."setting` (`setting_id` ,`store_id` ,`group` ,`key` ,`value` ,`serialized`)VALUES (NULL , '0', 'config', 'pos_show_address', '1', '0');";
    mysqli_query($connect, $sql);

    //show_telephone?
    $sql = "INSERT INTO `".DB_PREFIX."setting` (`setting_id` ,`store_id` ,`group` ,`key` ,`value` ,`serialized`)VALUES (NULL , '0', 'config', 'pos_show_telephone', '1', '0');";
    mysqli_query($connect, $sql);
    

    $sql = "ALTER TABLE `".DB_PREFIX."user` ADD `cash` decimal(10,2) NOT NULL DEFAULT '0.000' AFTER `ip` ;";
    mysqli_query($connect, $sql);

    $sql = "ALTER TABLE `".DB_PREFIX."order` ADD `user_id` INT( 100 ) NULL DEFAULT NULL AFTER `customer_id` , ADD `card_no` INT( 10 ) NULL DEFAULT NULL AFTER `user_id`;";
    mysqli_query($connect, $sql);

    $sql = "ALTER TABLE `".DB_PREFIX."user` ADD `card` decimal(10,2) NOT NULL DEFAULT '0.000' AFTER `ip` ;";
    mysqli_query($connect, $sql);

    //add new user_group 
    $permission = 'a:2:{s:4:"name";s:13:"point of sale";s:10:"permission";a:2:{s:6:"access";a:1:{i:0;s:7:"pos/pos";}s:6:"modify";a:1:{i:0;s:7:"pos/pos";}}}';
    mysqli_query($connect, "INSERT INTO " . DB_PREFIX . "user_group SET name = 'point of sale', permission ='".$permission."'");

    $user_group_id = mysqli_insert_id($connect);

    //set pos user_group 
    $sql = "INSERT INTO `".DB_PREFIX."setting` (`setting_id` ,`store_id` ,`group` ,`key` ,`value` ,`serialized`)VALUES (NULL , '0', 'pos', 'pos_user_group_id', '".$user_group_id."', '0');";
    mysqli_query($connect, $sql);

    mysqli_close($connect); 

    //change installed to true - pos/index.php
    $file_index = $opencart_path."pos/index.php";
    $content_index = str_replace("\$installed = false;", "\$installed = true;", file_get_contents($file_index));
    file_put_contents($file_index, $content_index);

    //success 
    echo 'SUCCESS: POS INSTALLED SUCCESSFULLY!';
}else{
    echo 'ALREADY INSTALLED!';
}

//activate vqmod
try{
    rename($opencart_path."vqmod/xml/pos.xml_",$opencart_path."vqmod/xml/pos.xml");
}catch (Exception $e){ }

//function to read files 
function read_file($file){
    if ( ! file_exists($file))
    {
            return FALSE;
    }

    if (function_exists('file_get_contents'))
    {
            return file_get_contents($file);
    }

    if ( ! $fp = @fopen($file, FOPEN_READ))
    {
            return FALSE;
    }

    flock($fp, LOCK_SH);

    $data = '';
    if (filesize($file) > 0)
    {
            $data =& fread($fp, filesize($file));
    }

    flock($fp, LOCK_UN);
    fclose($fp);

    return $data;
}//function read file
