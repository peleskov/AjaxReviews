<?php

class AjaxReviewsItemUpdateProcessor extends modObjectUpdateProcessor
{
    public $objectType = 'Rating';
    public $classKey = 'Rating';
    public $languageTopics = ['ajaxreviews'];
    //public $permission = 'save';


    /**
     * We doing special check of permission
     * because of our objects is not an instances of modAccessibleObject
     *
     * @return bool|string
     */
    public function beforeSave()
    {
        if (!$this->checkPermissions()) {
            return $this->modx->lexicon('access_denied');
        }

        return true;
    }


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $id = (int)$this->getProperty('id');
        $user_id = trim($this->getProperty('user_id'));
        $rating = trim($this->getProperty('rating'));
        if (empty($id)) {
            return $this->modx->lexicon('ajaxreviews_item_err_ns');
        }
        if ($this->modx->getCount($this->classKey, ['user_id' => $user_id])) {
            $this->failure($this->modx->lexicon('ajaxreviews_rating_err_user_id'));
        }
        if ($rating <= 0 || $rating > 5 ) {
            $this->failure($this->modx->lexicon('ajaxreviews_rating_err_rating'));
        }
        return parent::beforeSet();
    }
}

return 'AjaxReviewsItemUpdateProcessor';
