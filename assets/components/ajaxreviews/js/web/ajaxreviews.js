$(document).ready(() => {
    /* Звездочки в отзыве */
    var stars = $('.review-rating-set>span');
    stars.on('touchend click', function(e){
        var starDesc = $(this).data('description');
        $(this).parent().parent().find('.review-rating-description').html(starDesc).data('desc', starDesc);
        $(this).parent().children().removeClass('active');
        $(this).prevAll().addClass('active');
        $(this).addClass('active');
        $('[name="rating"]').val($(this).data('rating'));
    });
    stars.hover(
        // hover in
        function() {
            var descEl = $(this).parent().parent().find('.review-rating-description');
            descEl.data('desc', descEl.html());
            descEl.html($(this).data('description'));
            $(this).addClass('activeh');
            $(this).prevAll().addClass('activeh');
            $(this).nextAll().removeClass('activeh');
        },
        // hover out
        function(){
            var descEl = $(this).parent().parent().find('.review-rating-description');
            descEl.html(descEl.data('desc'));
            $(this).parent().children().removeClass('activeh');
        }
    );
    /* Звездочки в отзыве */

});


(function () {

    const result = {

        init: function () {

            this.eventSubscription()

        },

        eventSubscription: function () {

            $(document).on('af_complete', $.proxy(this.eventAfComplete, this))
        },

        eventAfComplete: function (event, response) {
            if ('service' in response.data && response.data.service == 'ajaxreviews') {
                this.cleanDOM(response)
                this.offLibraries(response)
                this.getService(response)
            }
        },

        cleanDOM: function (response) {

            $('.is-invalid').removeClass('is-invalid')
            $('.invalid-feedback').remove()
            $('.alert').hide()

        },

        offLibraries: function (response) {

            response.message = '';

        },

        getService: function (response) {
            let modalID, alertClass
            let alert = response.form.find('.alert')

            if ('modalID' in response.data) {
                modalID = response.data.modalID
            }

            if (response.data.result) {
                if ('location' in response.data) {
                    if (modalID){
                        if (response.data.editButtonID && response.data.redirectEdit) {
                            $('#' + response.data.editButtonID).attr('href', response.data.redirectEdit)
                        }
                        $('#' + modalID).on('hidden.bs.modal', function (e) {
                            window.location.href = response.data.location;
                        })
                    } else {
                        window.location = response.data.location
                    } 
                }
                alertClass = 'alert-success'
            } else {
                alertClass = 'alert-danger'
                $.each(response.data.errors, (i, msg) => {
                    response.form.find('[name="' + i + '"]')
                        .addClass('is-invalid').parent()
                        .append($('<span class="invalid-feedback">' + msg + '</span>'))
                    if (response.form.attr('id')) {
                        $('body').find('[form="' + response.form.attr('id') + '"][name="' + i + '"]')
                            .addClass('is-invalid').parent()
                            .append($('<span class="invalid-feedback">' + msg + '</span>'))
                    }
                })
            }
            if (modalID) {
                $('.modal').modal('hide')
                $('#' + modalID).modal('show')
            }
            if (alert.length > 0 && response.data.message) {
                alert.show().attr('class', alert.attr('class').replace(/\balert-\w*\b/g, '')).addClass(alertClass).text(response.data.message)
            }
        }
    }

    result.init()

})()