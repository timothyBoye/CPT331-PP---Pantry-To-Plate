/* checkboxes */
$(document).ready(function(){
    $('.icheck-field').each(function(){
        var self = $(this),
            label = self.next(),
            label_text = label.text();

        label.remove();
        self.iCheck({
            checkboxClass: 'icheckbox_line-green',
            radioClass: 'iradio_line-green',
            insert: '<div class="icheck_line-icon"></div>' + label_text
        });
    });
});