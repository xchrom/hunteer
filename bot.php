<?php
date_default_timezone_set('Asia/Baghdad');
if(!file_exists('config.json')){
	$token = readline('Enter Token: ');
	$id = readline('Enter Id: ');
	file_put_contents('config.json', json_encode(['id'=>$id,'token'=>$token]));
	
} else {
		  $config = json_decode(file_get_contents('config.json'),1);
	$token = $config['token'];
	$id = $config['id'];
}

if(!file_exists('accounts.json')){
    file_put_contents('accounts.json',json_encode([]));
}
include 'index.php';
try {
	$callback = function ($update, $bot) {
		global $id;
		if($update != null){
		  $config = json_decode(file_get_contents('config.json'),1);
		  $config['filter'] = $config['filter'] != null ? $config['filter'] : 1;
      $accounts = json_decode(file_get_contents('accounts.json'),1);
			if(isset($update->message)){
				$message = $update->message;
				$chatId = $message->chat->id;
				$text = $message->text;
				if($chatId == $id){
					if($text == '/start'){
              $bot->sendphoto([ 'chat_id'=>$chatId,
                  'photo'=>"https://t.me/zzbzbzz/2",
                   'caption'=>'تمت البرمجه بواسطه (@H_T_T_3) 💻',
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'تسجيل حساب وهمي في البوت 🏃‍♂','callback_data'=>'login']],
                       [['text'=>"قناة المطوّر 🔥", 'url'=>"https://t.me/S_H_A_D_O_W_TN"]],
                      ]
                  ])
              ]);   
             
             

               
                 $bot->sendvoice([ 'chat_id'=>$chatId,
                  'voice'=>"https://t.me/FOLLOW_NAFSEA/147",
                   'caption'=>'بصمه تعليم السحب ♻️',

                ]);
                
                $bot->sendvoice([ 'chat_id'=>$chatId,
                  'voice'=>"https://t.me/FOLLOW_NAFSEA/160",
                   'caption'=>'بصمه تعليم السحب 2 ♻️',

                ]);

          } elseif($text != null){
          	if($config['mode'] != null){
          		$mode = $config['mode'];
          		if($mode == 'addL'){
          			$ig = new ig(['file'=>'','account'=>['useragent'=>'Instagram 27.0.0.7.97 Android (23/6.0.1; 640dpi; 1440x2392; LGE/lge; RS988; h1; h1; en_US)']]);
          			list($user,$pass) = explode(':',$text);
          			list($headers,$body) = $ig->login($user,$pass);
          			// echo $body;
          			$body = json_decode($body);
          			if(isset($body->message)){
          				if($body->message == 'challenge_required'){
          					$bot->sendMessage([
          							'chat_id'=>$chatId,
          							'text'=>"لقد تم رفض الحساب لانه محظور او انه يطلب مصادقه⚙️"
          					]);
          				} else {
          					$bot->sendMessage([
          							'chat_id'=>$chatId,
          							'text'=>"كلمه السر او اليوزر خطأ🪓"
          					]);
          				}
          			} elseif(isset($body->logged_in_user)) {
          				$body = $body->logged_in_user;
          				preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $headers, $matches);
								  $CookieStr = "";
								  foreach($matches[1] as $item) {
								      $CookieStr .= $item."; ";
								  }
          				$account = ['cookies'=>$CookieStr,'useragent'=>'Instagram 27.0.0.7.97 Android (23/6.0.1; 640dpi; 1440x2392; LGE/lge; RS988; h1; h1; en_US)'];
          				
          				$accounts[$text] = $account;
          				file_put_contents('accounts.json', json_encode($accounts));
          				$mid = $config['mid'];
          				$bot->sendMessage([
          				      'parse_mode'=>'markdown',
          							'chat_id'=>$chatId,
          							'text'=>"*تم اضافه حساب جديد الى الاداه 💣.*\n _Username_ : [$user])(instagram.com/$user)\n_Account Name_ : _{$body->full_name}_",
												'reply_to_message_id'=>$mid		
          					]);
          				$keyboard = ['inline_keyboard'=>[
										[['text'=> "➕ أضافه حساب وهمي جديد",'callback_data'=>'addL']]
									]];
		              foreach ($accounts as $account => $v) {
		                  $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'ddd'],['text'=>"تسجيل الخروج",'callback_data'=>'del&'.$account]];
		              }
		              $keyboard['inline_keyboard'][] = [['text'=>'♻️ الصفحه الرئيسية','callback_data'=>'back']];
		              $bot->editMessageText([
		                  'chat_id'=>$chatId,
		                  'message_id'=>$mid,
		                  'text'=>"اهلا عزيزي ✔️ في الاسفل هي حساباتك الوهميه المسجله في الاداة",
		                  'reply_markup'=>json_encode($keyboard)
		              ]);
		              $config['mode'] = null;
		              $config['mid'] = null;
		              file_put_contents('config.json', json_encode($config));
          			}
          		}  elseif($mode == 'selectFollowers'){
          		  if(is_numeric($text)){
          		    bot('sendMessage',[
          		        'chat_id'=>$chatId,
          		        'text'=>"تم التعديل.",
          		        'reply_to_message_id'=>$config['mid']
          		    ]);
          		    $config['filter'] = $text;
          		    $bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                      'text'=>"صفحه التحكم الخاصه بك عزيزي استمتع مع اسهل طريقه لسحب الحسابات و اقواها
لمراسه المطور - @B_X_X",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'➕ أضافه حساب وهمي جديد','callback_data'=>'login']],
                          [['text'=>'💡 طرق سحب اليوزرات 💡','callback_data'=>'grabber']],
                          [['text'=>'⏸ بدء الصيد','callback_data'=>'run'],['text'=>'▶️ ايقاف الصيد','callback_data'=>'stop']],
                              [['text'=>'🌏 حالة الحسابات الوهمية 🌍','callback_data'=>'status'],['text'=>'قسم خاص ✔','callback_data'=>'otherop']],                      ]
                  ])
                  ]);
          		    $config['mode'] = null;
		              $config['mid'] = null;
		              file_put_contents('config.json', json_encode($config));
          		  } else {
          		    bot('sendMessage',[
          		        'chat_id'=>$chatId,
          		        'text'=>'- يرجى ارسال رقم فقط .'
          		    ]);
          		  }
          		} else {
          		  switch($config['mode']){
          		    case 'search': 
          		      $config['mode'] = null; 
          		      $config['words'] = $text;
          		      file_put_contents('config.json', json_encode($config));
          		      exec('screen -dmS gr php search.php');
          		      break;
          		      case 'followers': 
          		      $config['mode'] = null; 
          		      $config['words'] = $text;
          		      file_put_contents('config.json', json_encode($config));
          		      exec('screen -dmS gr php followers.php');
          		      break;
          		      case 'following': 
          		      $config['mode'] = null; 
          		      $config['words'] = $text;
          		      file_put_contents('config.json', json_encode($config));
          		      exec('screen -dmS gr php following.php');
          		      break;
          		      case 'hashtag': 
          		      $config['mode'] = null; 
          		      $config['words'] = $text;
          		      file_put_contents('config.json', json_encode($config));
          		      exec('screen -dmS gr php hashtag.php');
          		      break;
          		  }
          		}
          	}
          }
				} else {
					$bot->sendphoto([
							'chat_id'=>$chatId,
							'photo'=> "https://t.me/igft7/18",
							 'caption'=>'البوت مدفوع 💲 و ليس مجاني 👁‍🗨
لشراء نسخه مراسلة المطور 👁‍🗨',
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'▫️| KARAR','url'=>'t.me/B_X_X']],

                      ]
                  ])
              ]);   
				}
			} elseif(isset($update->callback_query)) {
          $chatId = $update->callback_query->message->chat->id;
          $mid = $update->callback_query->message->message_id;
          $data = $update->callback_query->data;
          echo $data;
          if($data == 'login'){
              
        		$keyboard = ['inline_keyboard'=>[
									[['text'=>"➕ أضافه حساب وهمي جديد",'callback_data'=>'addL']]
									]];
		              foreach ($accounts as $account => $v) {
		                  $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'ddd'],['text'=>"تسجيل الخروج",'callback_data'=>'del&'.$account]];
		              }
		              $keyboard['inline_keyboard'][] = [['text'=>'♻️ الصفحه الرئيسية','callback_data'=>'back']];
		              $bot->sendMessage([
		                  'chat_id'=>$chatId,
		                  'message_id'=>$mid,
		                   'text'=>"اهلا عزيزي ✔️ في الاسفل هي حساباتك الوهميه المسجله في الاداة",
		                  'reply_markup'=>json_encode($keyboard)
		              ]);
          } elseif($data == 'addL'){
          	
          	$config['mode'] = 'addL';
          	$config['mid'] = $mid;
          	file_put_contents('config.json', json_encode($config));
          	$bot->sendMessage([
          			'chat_id'=>$chatId,
          			'text'=>"  ارسل الحساب بهذا النمط `user:pass`",
          			'parse_mode'=>'markdown'
          	]);
          } elseif($data == 'grabber'){
            
            $for = $config['for'] != null ? $config['for'] : 'حدد الحساب';
            $count = count(explode("\n", file_get_contents($for)));
            $bot->editMessageText([
                'chat_id'=>$chatId,
                'message_id'=>$mid,
                'text'=>"Users collection page. \n - Users : $count \n - For Account : $for",
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>'🗣 بحث كلمات','callback_data'=>'search']],
                        [['text'=>'❗️بحث هاشتاك ','callback_data'=>'hashtag'],['text'=>'📈 من الاكسبلور','callback_data'=>'explore']],
                        [['text'=>'Followers','callback_data'=>'followers'],['text'=>"Following",'callback_data'=>'following']],
                        [['text'=>"الحساب المحدد : $for",'callback_data'=>'for']],
                        [['text'=>'🚸 لستة يوزرات جديده','callback_data'=>'newList'],['text'=>'🚸 لستة يوزرات سابقة','callback_data'=>'append']],
                        [['text'=>'♻️ الصفحه الرئيسية ','callback_data'=>'back']],
                    ]
                ])
            ]);
          } elseif($data == 'search'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"الان قم بأرسال الكلمه التريد البحث عليها و ايضا يمكنك من استخدام اكثر من كلمه عن طريق وضع فواصل بين الكلمات⚔️"
            ]);
            $config['mode'] = 'search';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'followers'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"الان قم بأرسال اليوزر التريد سحب متابعيه و ايضا يمكنك من استخدام اكثر من يوزر عن طريق وضع فواصل بين اليوزرات 🔪"
            ]);
            $config['mode'] = 'followers';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'following'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"الان قم بأرسال اليوزر التريد سحب الذي  متابعهم و ايضا يمكنك من استخدام اكثر من يوزر عن طريق وضع فواصل بين اليوزرات 🔪"
            ]);
            $config['mode'] = 'following';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'hashtag'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"الان قم بأرسال الهاشتاك بدون علامه # يمكنك 🧿استخدام هاشتاك واحد فقط"
            ]);
            $config['mode'] = 'hashtag';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'newList'){
            file_put_contents('a','new');
            $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"تم اختيار 🚸 لستةة يوزرات جديده بنجاح",
							'show_alert'=>1
						]);
          } elseif($data == 'append'){ 
            file_put_contents('a', 'ap');
            $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"تم اختيار 🚸 لستةة يوزرات سابقةة بنجاح",
							'show_alert'=>1
						]);
						
          } elseif($data == 'for'){
            if(!empty($accounts)){
            $keyboard = [];
             foreach ($accounts as $account => $v) {
                $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'forg&'.$account]];
              }
              $bot->editMessageText([
                  'chat_id'=>$chatId,
                  'message_id'=>$mid,
                  'text'=>"اختار الحساب",
                  'reply_markup'=>json_encode($keyboard)
              ]);
            } else {
              $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"اضف حساب بالاول😑",
							'show_alert'=>1
						]);
            }
          } elseif($data == 'selectFollowers'){
            bot('sendMessage',[
                'chat_id'=>$chatId,
                'text'=>'قم بأرسال عدد متابعين .'  
            ]);
            $config['mode'] = 'selectFollowers';
          	$config['mid'] = $mid;
          	file_put_contents('config.json', json_encode($config));
          } elseif($data == 'run'){
            if(!empty($accounts)){
            $keyboard = [];
             foreach ($accounts as $account => $v) {
                $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'start&'.$account]];
              }
              $bot->editMessageText([
                  'chat_id'=>$chatId,
                  'message_id'=>$mid,
                  'text'=>"حدد حساب",
                  'reply_markup'=>json_encode($keyboard)
              ]);
            } else {
              $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"قم بتسجيل حساب اولا 😑",
							'show_alert'=>1
						]);
            }
          }elseif($data == 'stop'){
            if(!empty($accounts)){
            $keyboard = [];
             foreach ($accounts as $account => $v) {
                $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'stop&'.$account]];
              }
              $bot->editMessageText([
                  'chat_id'=>$chatId,
                  'message_id'=>$mid,
                  'text'=>"اختار الحساب",
                  'reply_markup'=>json_encode($keyboard)
              ]);
            } else {
              $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"قم بتسجيل حساب اولا 😑",
							'show_alert'=>1
						]);
            }
          }elseif($data == 'stopgr'){
            shell_exec('screen -S gr -X quit');
            $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"تم الانتهاء من السحب",
						// 	'show_alert'=>1
						]);
						$for = $config['for'] != null ? $config['for'] : 'Select Account';
            $count = count(explode("\n", file_get_contents($for)));
						$bot->editMessageText([
                'chat_id'=>$chatId,
                'message_id'=>$mid,
                'text'=>"Users collection page. \n - Users : $count \n - For Account : $for",
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                       [['text'=>'🗣 بحث كلمات','callback_data'=>'search']],
                        [['text'=>'❗️بحث هاشتاك ','callback_data'=>'hashtag'],['text'=>'📈 من الاكسبلور','callback_data'=>'explore']],
                        [['text'=>'Followers','callback_data'=>'followers'],['text'=>"Following",'callback_data'=>'following']],
                        [['text'=>"الحساب المحدد : $for",'callback_data'=>'for']],
                        [['text'=>'🚸 لستةة يوزرات جديده','callback_data'=>'newList'],['text'=>'🚸 لستةة يوزرات سابقةة','callback_data'=>'append']],
                        [['text'=>'♻️ الصفحه الرئيسية','callback_data'=>'back']],
                    ]
                ])
            ]);
          } elseif($data == 'explore'){
            exec('screen -dmS gr php explore.php');
          } elseif($data == 'status'){
					$status = '';
					foreach($accounts as $account => $ac){
						$c = explode(':', $account)[0];
						$x = exec('screen -S '.$c.' -Q select . ; echo $?');
						if($x == '0'){
				        $status .= "*$account* ~> _Working_\n";
				    } else {
				        $status .= "*$account* ~> _Stop_\n";
				    }
					}
					$bot->sendMessage([
							'chat_id'=>$chatId,
							'text'=>"حاله الحسابات : \n\n $status",
							'parse_mode'=>'markdown'
						]);
						} elseif($data == 'otherop'){
          	$bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                     'text'=> "🔥Let's Gooo🔥",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'شرح المتاحات','callback_data'=>'Shadowx1']],
                          [['text'=>'رابط سحب متاح الهوتميل','callback_data'=>'Shadowx2']],
                          [['text'=>'نقل ملكيه البوت','callback_data'=>'Shadowx3']],
                          [['text'=>'ايديك','callback_data'=>'Shadowx4'],['text'=>'رجوع','callback_data'=>'back']],
                          [['text'=>'المطور❔','url'=>'t.me/B_X_X']],
                      ]
                ])
            ]);				
						
						
						                  } elseif($data == 'Shadowx1'){
          	$bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                     'text'=> "اختراق المتاح :- اختراق حسابات انستغرام المتاحه هوه اختراق غير محدد وينطبق على  حسابات التي تتوفر فيها شروط معينه

 س / ماهو متاح وما هي فكره المتاح

ج /  عندما تنشى حساب انستكرام جديد 
يطلب منك ايميل  هنالك اشخاص تقوم بـ اضافه ايميل وهمي غير مربوط بالجهاز فـ هذه الحساب يسمى متاح 
او
حساب انستكرام مربوط ببريد ياهو او هوتميل لم يفتح صاحبه البريد لمدة سنه كامله
فلذالك قام الياهو او الهوتميل بحذف الحساب من قاعدة بياناته  لاجل توفير مساحه هنالك حسابات متاحه Gmail لكـن جيميل لا يحذف معلومات مستخدم
 في اي حاله كانت


اختراق المتاح :-  بكل سهوله و بساطة تقوم بي. تأكد من نوع متاح هل هول Gmail او hotmail او yahoo او maill اَو غيرها وتقوم بل دخول لي مواقع  انشاء حسابات مثل Gmail  تدخل اظافه حساب وتختار جيميل وتنشئ حساب جديد و تظيف البريد الإلكتروني الخاص بل حساب المتاح و تقوم بي عمل Rest  من الانستغرام و يصل رابط تغير كلمه سر الحساب

الي ميعرف شنو المتاح وشون يخترقه
@B_X_X",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'رجوع','callback_data'=>'otherop']],
                          ]
                  ])
                  ]);
                  
												
						} elseif($data == 'Shadowx2'){
          	$bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                     'text'=> "https://signup.live.com/signup?lcid=1033&wa=wsignin1.0&rpsnv=13&ct=1504132238&rver=6.7.6640.0&wp=MBI_SSL&wreply=https%3A%2F%2Foutlook.live.com%2Fowa%2F%3Fnlp%3D1%26signup%3D1%26authRedirect%3Dtrue%26RpsCsrfState%3Df350c55d-4b3a-b9c7-ed28-dcdf2e9f47f7&id=292841&CBCXT=out&fl=wld&pcexp=false&cobrandid=90015&uaid=130c9ab91ce74ebd97397561ca52fe89&lic=1




اختراق هوتميل مختصر على تحديث القديم اذا تريدة ما يطلب رقم الهاتف بس حوله على الجزائر أو المملكة العربية السعودية ضيف أي رقم عشوائي بعدين أدخل الحروف التي تراها استخدام كابتل 



                     
              @B_X_X  🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥🔥",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'رجوع','callback_data'=>'otherop']],
                          ]
                  ])
                  ]);
                  
						                  } elseif($data == 'Shadowx3'){
          	$bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                     'text'=> "ما ضفتها 😶",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'رجوع','callback_data'=>'otherop']],
                          ]
                  ])
                  ]);
						
						
						
						
			                  } elseif($data == 'Shadowx4'){
          	$bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                     'text'=> "ايديك -> $chatId ",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'رجوع','callback_data'=>'otherop']],
                          ]
                  ])
                  ]);
                  		
						
					
				} elseif($data == 'back'){
          	$bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                     'text'=> "اهلا عزيزي ✔️
في الاسفل هي حساباتك الوهميه المسجله في الاداة",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'➕ أضافه حساب وهمي جديد','callback_data'=>'login']],
                          [['text'=>'💡 طرق سحب اليوزرات 💡','callback_data'=>'grabber']],
                          [['text'=>'⏸ بدء الصيد','callback_data'=>'run'],['text'=>'▶️ ايقاف الصيد','callback_data'=>'stop']],
                         [['text'=>'🌏 حالة الحسابات الوهمية 🌍','callback_data'=>'status'],['text'=>'قسم خاص ✔','callback_data'=>'otherop']],                      ]
                  ])
                  ]);
          } else {
          	$data = explode('&',$data);
          	if($data[0] == 'del'){
          		
          		unset($accounts[$data[1]]);
          		file_put_contents('accounts.json', json_encode($accounts));
              $keyboard = ['inline_keyboard'=>[
							[['text'=>"➕ أضافه حساب وهمي جديد",'callback_data'=>'addL']]
									]];
		              foreach ($accounts as $account => $v) {
		                  $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'ddd'],['text'=>"تسجيل الخروج",'callback_data'=>'del&'.$account]];
		              }
		              $keyboard['inline_keyboard'][] = [['text'=>'♻️ الصفحه الرئيسية','callback_data'=>'back']];
		              $bot->editMessageText([
		                  'chat_id'=>$chatId,
		                  'message_id'=>$mid,
		                    'text'=>"اهلا عزيزي ✔️ في الاسفل هي حساباتك الوهميه المسجله في الاداة",
		                  'reply_markup'=>json_encode($keyboard)
		              ]);
          	} elseif($data[0] == 'moveList'){
          	  file_put_contents('list', $data[1]);
          	  $keyboard = [];
          	  foreach ($accounts as $account => $v) {
                  $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'moveListTo&'.$account]];
              }
              $bot->editMessageText([
                  'chat_id'=>$chatId,
                  'message_id'=>$mid,
                  'text'=>"اختر الحساب الذي تريد نقل اللسته اليه",
                  'reply_markup'=>json_encode($keyboard)
	              ]);
          	} elseif($data[0] == 'moveListTo'){
          	  $keyboard = [];
          	  file_put_contents($data[1], file_get_contents(file_get_contents('list')));
          	  unlink(file_get_contents('list'));
          	  $keyboard['inline_keyboard'][] = [['text'=>'♻️ الصفحه الرئيسية','callback_data'=>'back']];
          	  $bot->editMessageText([
                  'chat_id'=>$chatId,
                  'message_id'=>$mid,
                  'text'=>"تم نقل اللسته الى الحساب ".$data[1],
                  'reply_markup'=>json_encode($keyboard)
	              ]);
          	} elseif($data[0] == 'forg'){
          	  $config['for'] = $data[1];
          	  file_put_contents('config.json',json_encode($config));
              $for = $config['for'] != null ? $config['for'] : 'Select';
              $count = count(file_get_contents($for));
              $bot->editMessageText([
                'chat_id'=>$chatId,
                'message_id'=>$mid,
                'text'=>"Users collection page. \n - Users : $count \n - For Account : $for",
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                            [['text'=>'🗣 بحث كلمات','callback_data'=>'search']],
                        [['text'=>'❗️بحث هاشتاك ','callback_data'=>'hashtag'],['text'=>'📈 من الاكسبلور','callback_data'=>'explore']],
                        [['text'=>'Followers','callback_data'=>'followers'],['text'=>"Following",'callback_data'=>'following']],
                        [['text'=>"For Account : $for",'callback_data'=>'for']],
                        [['text'=>'🚸 لستةة يوزرات جديده','callback_data'=>'newList'],['text'=>'🚸 لستةة يوزرات سابقةة','callback_data'=>'append']],
                        [['text'=>'♻️ الصفحه الرئيسية','callback_data'=>'back']],
                    ]
                ])
            ]);
          	} elseif($data[0] == 'start'){
          	  file_put_contents('screen', $data[1]);
          	  $bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                       'text'=> "اهلا بك مره اخرى عزيزي ✔️
اختر ما تريده من الاسفل 👇",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'➕ أضافه حساب وهمي جديد','callback_data'=>'login']],
                          [['text'=>'💡 طرق سحب اليوزرات 💡','callback_data'=>'grabber']],
                          [['text'=>'⏸ بدء الصيد','callback_data'=>'run'],['text'=>'▶️ ايقاف الصيد','callback_data'=>'stop']],
                         [['text'=>'🌏 حالة الحسابات الوهمية 🌍','callback_data'=>'status'],['text'=>'قسم خاص ✔','callback_data'=>'otherop']],                 
                       ]
                  ])
                  ]);
              exec('screen -dmS '.explode(':',$data[1])[0].' php start.php');
              $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"*بدء الصيد.*\n Account: `".explode(':',$data[1])[0].'`',
                'parse_mode'=>'markdown'
              ]);
              
          	} elseif($data[0] == 'stop'){
          	  $bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                      'text'=>"اهلا بك مره اخرى عزيزي ✔️
اختر ما تريده من الاسفل 👇",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'➕ أضافه حساب وهمي جديد','callback_data'=>'login']],
                          [['text'=>'💡 طرق سحب اليوزرات 💡','callback_data'=>'grabber']],
                          [['text'=>'⏸ بدء الصيد','callback_data'=>'run'],['text'=>'▶️ ايقاف الصيد','callback_data'=>'stop']],
                         [['text'=>'🌏 حالة الحسابات الوهمية 🌍','callback_data'=>'status'],['text'=>'قسم خاص ✔','callback_data'=>'otherop']],                      ]
                    ])
                  ]);
              exec('screen -S '.explode(':',$data[1])[0].' -X quit');
          	}
          }
			}
		}
	};
	$bot = new EzTG(array('throw_telegram_errors'=>false,'token' => $token, 'callback' => $callback));
} catch(Exception $e){
	echo $e->getMessage().PHP_EOL;
	sleep(1);
}