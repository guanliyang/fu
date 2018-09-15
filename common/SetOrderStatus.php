<?php
include_once('/data/mgs/inc/global.php');

		function setOrderArri(){
			$db = getDBO();
			
			$result = $db->prepare('SELECT b_id from b_order where o_status=7 AND o_artime<>"" AND IS NOT NULL  AND o_artime<'.time());
			
			$result->execute();
                	$row = getAllD($result);
                	$result->close();
			if($row) {
				$result = $db->prepare('UPDATE b_order SET o_status = 9 WHERE o_status=7 AND o_artime<>"" AND o_artime<'.time());
			$result->execute();
			}
			$result->close();
			$db->close();
		}

setOrderArri();
echo "a";
