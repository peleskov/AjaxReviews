<form>
    <input type="hidden" name="user_id" value="2">
    <div class="row mb-md-4">
        <div class="col-7 form-group mb-md-0">
            <label class="mb-2" for="reviewTitle">Заголовок</label>
            <input type="text" name="title" class="form-control"/>
        </div>
        <div class="col-5 form-group mb-md-0">
            <label class="control-label">Оценка</label>
            <input type="hidden" name="rating"/>
            <div class="d-flex">
                <div class="d-flex review-rating-set mr-2">
                    <span data-rating="1" data-description="Bad"></span>
                    <span data-rating="2" data-description="Not good"></span>
                    <span data-rating="3" data-description="Medium"></span>
                    <span data-rating="4" data-description="Good"></span>
                    <span data-rating="5" data-description="Excellent"></span>
                </div>
                <div class="review-rating-description"></div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col form-group mb-0">
            <label class="mb-2" >Текст отзыва</label>
            <textarea name="content" class="form-control textarea" rows="8"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </div>
    <div id="ec-form-success-{$fid}"></div>
</form>