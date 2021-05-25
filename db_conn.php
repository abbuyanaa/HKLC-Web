<?php

include 'db.php';

$dict=$conn->prepare("select korean.kr_w,mongol.mn_w,kr_sentence.sentence from kr_mn inner join korean on kr_mn.k_id=korean.id inner join kr_sentence on kr_mn.id=kr_sentence.kr_mn_id inner join mongol on kr_mn.m_id = mongol.id");
$dict->execute();

$sentence=$conn->prepare("select korean.kr_w,kr_sentence.sentence from kr_sentence inner join kr_mn on kr_sentence.kr_mn_id = kr_mn.id 
	inner join korean on kr_mn.k_id=korean.id ");
$sentence->execute();

?>