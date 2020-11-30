<?php 

function gregorian_to_jalali($gy,$gm,$gd,$mod=''){
	$g_d_m=array(0,31,59,90,120,151,181,212,243,273,304,334);
	if($gy>1600){
		$jy=979;
		$gy-=1600;
	}else{
		$jy=0;
		$gy-=621;
	}
	$gy2=($gm>2)?($gy+1):$gy;
	$days=(365*$gy) +((int)(($gy2+3)/4)) -((int)(($gy2+99)/100)) +((int)(($gy2+399)/400)) -80 +$gd +$g_d_m[$gm-1];
	$jy+=33*((int)($days/12053)); 
	$days%=12053;
	$jy+=4*((int)($days/1461));
	$days%=1461;
	if($days > 365){
		$jy+=(int)(($days-1)/365);
		$days=($days-1)%365;
	}
	$jm=($days < 186)?1+(int)($days/31):7+(int)(($days-186)/30);
	$jd=1+(($days < 186)?($days%31):(($days-186)%30));
	return($mod=='')?array($jy,$jm,$jd):$jy.$mod.$jm.$mod.$jd;
}

function dateTimeToJalali($datetime) {
	$datetime = explode(' ', $datetime);
	$date = explode('-', $datetime[0]);
	$date = gregorian_to_jalali($date[0],$date[1],$date[2],'/');
	return $date.' '.$datetime[1];
}

// public function jalali_to_gregorian($jy,$jm,$jd,$mod=''){
// 	if($jy>979){
// 		$gy=1600;
// 		$jy-=979;
// 	}else{
// 		$gy=621;
// 	}
// 	$days=(365*$jy) +(((int)($jy/33))*8) +((int)((($jy%33)+3)/4)) +78 +$jd +(($jm<7)?($jm-1)*31:(($jm-7)*30)+186);
// 	$gy+=400*((int)($days/146097));
// 	$days%=146097;
// 	if($days > 36524){
// 		$gy+=100*((int)(--$days/36524));
// 		$days%=36524;
// 		if($days >= 365)$days++;
// 	}
// 	$gy+=4*((int)($days/1461));
// 	$days%=1461;
// 	if($days > 365){
// 		$gy+=(int)(($days-1)/365);
// 		$days=($days-1)%365;
// 	}
// 	$gd=$days+1;
// 	foreach(array(0,31,(($gy%4==0 and $gy%100!=0) or ($gy%400==0))?29:28 ,31,30,31,30,31,31,30,31,30,31) as $gm=>$v){
// 		if($gd<=$v)break;
// 		$gd-=$v;
// 	}
// 	return($mod=='')?array($gy,$gm,$gd):$gy.$mod.$gm.$mod.$gd; 
// }

// public function ConvertToJalali($time) {
// 	date_default_timezone_set("UTC");
// 	$dt = new DateTime('@'.$time);
// 	$dt->setTimeZone(new DateTimeZone('Asia/Tehran'));
// 	$year = $dt->format('Y');
// 	$month = $dt->format('m');
// 	$day = $dt->format('d');
// 	$jalali = $this->gregorian_to_jalali($year,$month,$day);
// 	$date = "(".$dt->format('H:i').") ".$jalali[0]."/".$jalali[1]."/".$jalali[2];
// 	return $date;
// }

// public function login($mobile, $access_level) {
//     $userinfo = array("mobile"=>$mobile, "accesslevel"=>$access_level);
//     Session::put('userinfo', $userinfo);
//     return 1;
// }

function has_children($comments,$id) {
	foreach ($comments as $comment) {
		if ($comment->replay == $id)
			return true;
	}
	return false;
}

function build_menu($comments,$parent=0) {  
	$result = '<ul class="comments-list p-y-1em">';
	foreach ($comments as $comment) {
		if ($comment->replay == $parent){
			$result.= 	'<li>
							<div class="p-y-1em clearfix">
								<div class="comment-avatar">
									<img alt="" class="img-circle" src="'.asset('public/assets/images/items/user.svg').'">
								</div>
								<div class="comment-meta">
									<cite class="comment-author" itemprop="creator" itemscope="itemscope" itemtype="https://schema.org/Person">
										<span class="bold">'. (is_null($comment->name) ? "ناشناس" : $comment->name.' '.$comment->familiy) .'</span>
										<span class="says">می گوید:</span>
									</cite>
									<time class="comment-published" datetime="'.$comment->insert_time.'" title="'.dateTimeToJalali($comment->insert_time).'" itemprop="commentTime">
										<img src="'.asset('public/assets/images/items/calendar.svg').'" alt="calender">
										'.dateTimeToJalali($comment->insert_time).'
									</time>
								</div>
								<div class="comment-content" itemprop="commentText">
									<p>'.nl2br(e($comment->comment)).'</p>
								</div>
								<div class="comment-reply" data-comment="'.$comment->id.'">
									<img src="'.asset('public/assets/images/items/reply.svg').'" alt="reply">
									پاسخ
								</div>
							</div>';
			if (has_children($comments,$comment->id))
				$result.= build_menu($comments,$comment->id);
			$result.= "</li>";
		}
	}
	$result.= "</ul>";
	return $result;
}

function hasGoogle() {
	$hostname = parse_url(request()->headers->get('referer'), PHP_URL_HOST);
	$hostname = strtolower($hostname);
	if (strpos($hostname, 'google.com') !== false)
		return true;
	else
		return false;
}