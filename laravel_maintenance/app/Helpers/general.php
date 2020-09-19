<?php

use Illuminate\Support\Facades\Cache;
use App\Model\User;
use App\Model\ContactUs;
use App\Model\AccessControl;
use App\Model\Setting;
use App\Model\Photos;
use App\Model\Pages;
use App\Model\Comment;
use App\Model\CampaignD;

function getData($column){
    $setting = Setting::where('name',$column)->get();
    return $setting[0]->value;
}

function getUserAccess($id){
	$access_control = AccessControl::with('module')->where('user_level_id', $id)->get();
	$role = [];
	foreach ($access_control as $data):
		$role[$data->user_level_id][$data->module->slug] = $data->content;
	endforeach;
	return $role;
}

function getMediaCount($id){
	$total = 0;
    $count_user = User::where('avatar_id',$id)->where('active', '!=', 0)->count();
    $count_photos = Photos::where('image_id',$id)->where('active', '!=', 0)->count();
    $count_pages = Pages::where('featured_image',$id)->where('active', '!=', 0)->count();
	$total = $count_user + $count_photos + $count_pages; 
	return $total;
}

function getInboxCount(){
	$total = 0;
	$count_inbox = ContactUs::where('read',1)->count();
	return $count_inbox;
}

function getComment($id){
	$data_comment = Comment::select('comment.*', DB::raw('IFNULL(assignee.name, "njing") as name'))
	->leftJoin('assignee','comment.username','=','assignee.name')
    ->where('comment.ticket_id','=', $id)
    ->orderBy('comment.id', 'ASC')
	->get();

	return $data_comment;
}


function getJawab($id){
	$data = CampaignD::where('campaign_id', $id)->where('answer','<>',99)->groupBy('user')->get();
	return $data->count();
}

function getTotal($id){
	$data = CampaignD::where('campaign_id', $id)->groupBy('user')->get();
	return $data->count();
}

function getCategory($id){
	$data = CampaignD::where('campaign_id', $id)->groupBy('category')->get();
	return $data;
}

function getValue($id, $category){
	$value = 0;
	$list = 1;
	$data = CampaignD::where('campaign_id', $id)->where('category', $category)->where('answer','<>',99)->get();
	if ($data->count()){
		$list = $data->count();
		$data = CampaignD::select([DB::raw('sum(answer) as answer')])->where('campaign_id', $id)->where('category', $category)->where('answer','<>',99)->groupBy('category')->get();
		$value = $data[0]->answer;
	}
	return $value / $list;
}

function getValueTotal($id){
	$value = 0;
	$list = 0;
	$data = CampaignD::where('campaign_id', $id)->where('answer','<>',99)->get();
	if ($data->count()){
		$list = $data->count();
		$data = CampaignD::select([DB::raw('sum(answer) as answer')])->where('campaign_id', $id)->where('answer','<>',99)->groupBy('campaign_id')->get();
		$value = $data[0]->answer;
	}
	return $value / $list;
}