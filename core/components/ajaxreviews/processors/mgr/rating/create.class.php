<?php

class AjaxReviewsItemCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'Rating';
    public $classKey = 'Rating';
    public $languageTopics = ['ajaxreviews'];
    //public $permission = 'create';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $user_id = trim($this->getProperty('user_id'));
        $rating = trim($this->getProperty('rating'));
        if ($this->modx->getCount($this->classKey, ['user_id' => $user_id])) {
            $this->failure($this->modx->lexicon('ajaxreviews_rating_err_user_id'));
        }
        if ($rating <= 0 || $rating > 5 ) {
            $this->failure($this->modx->lexicon('ajaxreviews_rating_err_rating'));
        }
        return parent::beforeSet();
    }

}

return 'AjaxReviewsItemCreateProcessor';