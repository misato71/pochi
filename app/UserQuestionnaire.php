<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserQuestionnaire extends Model
{
//退会アンケート
    public function questionnaire($id, $questionnaire, $content){
        $user = new self();
        $user->user_id = $id;
        $user->questionnaire = $questionnaire;
        $user->content = $content;
        $user->save();
    }
    
}
