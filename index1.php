<?php

require './simple_html_dom.php';
$html = file_get_html('http://coder.awas.vn/Home/MemberList/811.aspx');
$html = $html->find("table tbody table tbody tr:nth-child(3) table tbody tr td table tbody tr:nth-child(3)", 0);
print_r($html);
//foreach ($html as $value) {
//    print_r($value);
//}
//print_r($html);
//$matches = [];
//
//preg_match("/[a-zA-Z0-9.-_]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+/", $html, $matches);
//
//print_r($matches);