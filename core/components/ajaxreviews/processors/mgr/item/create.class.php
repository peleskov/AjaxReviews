<?php

class AjaxReviewsItemCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'Review';
    public $classKey = 'Review';
    public $languageTopics = ['ajaxreviews'];
    //public $permission = 'create';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $author_id = trim($this->getProperty('author_id'));
        $user_id = trim($this->getProperty('user_id'));
        $rating = trim($this->getProperty('rating'));
        if (!$this->modx->getCount('modUser', $user_id)) {
            $this->failure($this->modx->lexicon('ajaxreviews_rating_err_nf_user_id'));
        }
        if (!$this->modx->getCount('modUser', $author_id)) {
            $this->failure($this->modx->lexicon('ajaxreviews_rating_err_nf_user_id'));
        }
        if ($rating <= 0 || $rating > 5 ) {
            $this->failure($this->modx->lexicon('ajaxreviews_rating_err_rating'));
        }
        return parent::beforeSet();
    }

}

return 'AjaxReviewsItemCreateProcessor';