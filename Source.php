<?php 


$Token = json_decode(file_get_contents("tg/info.json"),true)['Token'];
$Mix = json_decode(file_get_contents("tg/info.json"),true)['sudo'];

require "tg/function.php";

echo file_get_contents("https://api.telegram.org/bot$Token/setwebhook?url=".$_SERVER['SERVER_NAME']."".$_SERVER['SCRIPT_NAME']);



mkdir("data");
$bot = json_decode(file_get_contents("https://api.telegram.org/bot$TOKEN/getme"),true);
$name_bot = $bot['result']['first_name'];
$type = $update->message->chat->type;
$ids = json_decode(file_get_contents('data/members.json'),true);
$send = json_decode(file_get_contents("data/send.json"),true);
$sudo = [$Mix,$ids['admin']];
if(!in_array($chat_id, $ids['ids']) and $type == "private") {
$ids['ids'][] = "$chat_id";
file_put_contents('data/members.json',json_encode($ids));}
$idss = $ids['ids'];
$count = count($idss);

if($text == "/start" and !in_array($from_id, $sudo)){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"

*♕︙أهلآ بك في بوت $name_bot
♕︙اختصاص البوت حماية المجموعات
♕︙لتفعيل البوت عليك اتباع مايلي ...
♕︙اضف البوت الى مجموعتك
♕︙ارفعه ادمن {مشرف}
♕︙ارسل كلمة { تفعيل } ليتم تفعيل المجموعه
♕︙سيتم ترقيتك منشئ اساسي في البوت
♕︙مطور البوت ← * [ ‏‎‏‏ᐯⅈƦꀎՏ TEAM Ⅱ AX](t.me/alsh_bg) 
*♕︙قناة السورس ← * [ ‏‎‏TEAM Ⅱ AX](t.me/alsh_3k) 
•
",
'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>true,
'reply_to_message_id'=>$message->message_id
]);
}
 
if($text == "/start" and in_array($from_id, $sudo)){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"*
♕︙مرحبا بك في قائمة المطور
♕︙قناة السورس ← * [ ‏‎‏TEAM Ⅱ AX](t.me/alsh_3k) 
•
",
'parse_mode'=>'MARKDOWN',
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎ المشتركين ︙〢','callback_data'=>'m1'],
['text'=>'‎ اذاعه للكل ︙〢','callback_data'=>'send']],
[['text'=>'‎ اضف مطور ︙〢','callback_data'=>'admin'],['text'=>'‎ حذف مطور ︙〢','callback_data'=>'dadmin']],
[['text'=>'‎ اضف قناة ︙〢','callback_data'=>'t.me/alsh_bg'],
['text'=>'‎ حذف قناة ︙〢','callback_data'=>'t.me/alsh_3k']],
]
])
]);
}


if($data == 'dadmin' ){
bot('editmessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'parse_mode'=>'MARKDOWN',
'text'=>"
*♕︙حسنا مطوري الان قم برسال ايدي المطور
♕︙لكي اقوم بحذفه من المطورين  
♕︙قناة السورس ← * [ ‏‎‏TEAM Ⅱ AX](t.me/alsh_3k) 
•
"
]);
$send['send'] = "dadmin";
file_put_contents('data/send.json',json_encode($send));
}


if($text and $send['send'] == 'dadmin' and in_array($text, $ids['admin'])){


$nu = $text;
$null = $ids['admin'] = 'null';
$str = str_replace($nu, $null, $ids);
file_put_contents('data/members.json',json_encode($str));
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
*♕︙حسنا مطوري تم حذف المطور من المطورين
♕︙قناة السورس ← * [ ‏‎‏TEAM Ⅱ AX](t.me/alsh_3k) 
•
",
'parse_mode'=>'MARKDOWN',
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎رجوع︙〢','callback_data'=>'back']]
]
])
]);
$send['send'] = "null";
file_put_contents('data/send.json',json_encode($send));
}


if($data == 'admin' ){
bot('editmessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'parse_mode'=>'MARKDOWN',
'text'=>"
*♕︙حسنا مطوري الان قم برسال ايدي العضو
♕︙لكي اقوم برفعه مطور في البوت 
♕︙قناة السورس ← * [ ‏‎‏TEAM Ⅱ AX](t.me/alsh_3k) 
•
"
]);
$send['send'] = "admin";
file_put_contents('data/send.json',json_encode($send));
}

if($text and $send['send'] == 'admin' and !in_array($text, $ids['admin']) ){
$ids['admin'][] = "$text";
file_put_contents('data/members.json',json_encode($ids));
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
*♕︙حسنا مطوري تم اضافه العضو كمطور
♕︙قناة السورس ← * [ ‏‎‏TEAM Ⅱ AX](t.me/alsh_3k) 
•
",
'parse_mode'=>'MARKDOWN',
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎رجوع︙〢','callback_data'=>'back']]
]
])
]);
$send['send'] = "null";
file_put_contents('data/send.json',json_encode($send));
}

if( $send['send'] == 'admin' and  in_array($text, $ids['admin'])){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
*♕︙عذرا مطوري تم اضافه العضو كمطور بالفعل 
♕︙قناة السورس ← * [ ‏‎‏TEAM Ⅱ AX](t.me/alsh_3k) 
•
",
'parse_mode'=>'MARKDOWN',
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎رجوع︙〢','callback_data'=>'back']]
]
])
]);
$send['send'] = "null";
file_put_contents('data/send.json',json_encode($send));
}

if($data == "m1"){ 
    bot('answercallbackquery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>"
‎ • عدد المشتركين هو » $count « •
‎• عدد المحظورين هو » $bbn « •
        ",
        'show_alert'=>true,
]);
}

if($data == 'send' ){
bot('editmessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"

*♕︙حسنا  مطوري الان اكتب رسالتك  
♕︙قناة السورس ← * [ ‏‎‏TEAM Ⅱ AX](t.me/alsh_3k) 
•
",
'parse_mode'=>'MARKDOWN',
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎رجوع︙〢','callback_data'=>'back']]
]
])
]);
$send['send'] = "send";
file_put_contents('data/send.json',json_encode($send));
}

foreach($idss as $array){
if($text and $send['send'] == 'send'){
bot('sendmessage',[
'chat_id'=>$array,
'text'=>$text 
]);
bot('sendmessage',[
'chat_id'=>$sudo[0],
'text'=>"
*♕︙حسنا  مطوري تم ارسال رسالتك الى $count العضو 
♕︙قناة السورس ← * [ ‏‎‏TEAM Ⅱ AX](t.me/alsh_3k) 
•
" ,
'parse_mode'=>'MARKDOWN',
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'‎رجوع︙〢','callback_data'=>'back']]
]
])
]);
$send['send'] = "null";
file_put_contents('data/send.json',json_encode($send));
}
}
