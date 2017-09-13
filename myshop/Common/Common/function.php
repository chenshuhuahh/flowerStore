<?php

function encrypt($a){
	return md5($a);
}

function che(){
	return encrypt(cookie('con_name').cookie('con_id').C('COO_KIE')) === cookie('key');
}
?>