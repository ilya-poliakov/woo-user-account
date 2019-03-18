(function ($, window, document, undefined) {
    $(function () {

        function loginSwitcher() {
            $('#to_register').on('click', function (e) {
                $('#login_form_container').hide();
                $('#register_form_container').show();
            });
            $('#to_login').on('click', function (e) {
                $('#login_form_container').show();
                $('#register_form_container').hide();
            });
        }

        function profileEditor() {
            let submitBtns = $('.userdata-submit');

            $(".account_links_box a").click(function(){
                if($(this).hasClass('account_click_link')){
                    $(".account_box_showed_first").slideToggle("slow");
                }else{
                    $(".account_box_showed_second").slideToggle("slow");
                }
                submitBtns.show();


            });
            $('#data_using').on('change', function (e) {
                submitBtns.show();
            });

        }

        function setSelect2() {
            $('[name="billing_country"]').select2();
        }
        function addCheckedInput() {
            var check_container = $('.acsess_conteiner label')
            if ($('.acsess_conteiner input:checked')) {
                $(check_container).addClass('checked');
            } else {
                $(check_container).removeClass('checked');
            }
            $(check_container).click(function (e) {
                $(this).toggleClass('checked');
            });
        }


        function init() {
            loginSwitcher();
            setSelect2();
            profileEditor();
            addCheckedInput();
        }


        init();


    });
})(jQuery, window, document);